$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-0d'
    });

    var renderCalendar = function() {
        $('#calendar').monthly({
            weekStart: 'Mon',
            dataType: 'json',
            jsonUrl: 'inventory',
            eventList: false,
            disablePast: true
        });
    }

    var enableIndividualInventoryEditing = function() {
        $('.monthly-indicator-wrap').click(function(evt) {
            var params = $(evt.target).parent().data('eventid');
            
            if (!params) {
                return false;
            }

            var $modal = $('#edit-modal').modal();

            $.get('/inventory/find?' + params).done(function(data) {
                $modal.find('.modal-title').html(data.modal_header);
                $modal.find('.modal-body').html(data.modal_body);
                $modal.parent().attr('action', '/inventory/update/' + data.room_id);
            });
        });
    };

    renderCalendar();
    enableIndividualInventoryEditing();

    $('#modal-form').submit(function(evt) {
        evt.preventDefault();

        var request = $(this).serialize();
        var action = $(this).attr('action');

        $.post(action, request).done(function (data) {
            $('#calendar').empty();
            renderCalendar();

            $('#modal-submit-btn').notify('Room Data Updated!', {
                className: 'success',
                position: 'bottom center',
                autoHideDelay: 1500
            });

            enableIndividualInventoryEditing();
        });
    })

    $('#update_inventory').submit(function(evt) {
        evt.preventDefault();

        var request = $(this).serialize();
        var action = $(this).attr('action');

        $.post(action, request).done(function (data) {
            $('#calendar').empty();
            renderCalendar();

            $('#submit-btn').notify('Calendar Updated!', {
                className: 'success',
                position: 'right center',
                autoHideDelay: 1500
            });
        }).error(function(data) {
            $('#submit-btn').notify(data.responseText, {
                className: 'error',
                position: 'right center',
                autoHideDelay: 3500
            });
        });
    });
});
