$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-0d'
    });

    var renderCalendar = function() {
        $('#calendar').monthly({
            weekStart: 'Mon',
            // mode: 'picker',
            dataType: 'json',
            jsonUrl: 'inventory',
            eventList: false,
            disablePast: true
        });
    }

    renderCalendar();

    $('#update_inventory').submit(function(evt) {
        evt.preventDefault();

        var request = $(this).serialize();
        var action = $(this).attr('action');

        $.post(action, request).done(function (data) {
            console.log(data);

            $('#calendar').empty();
            renderCalendar();

            $('#submit-btn').notify('Calendar Updated!', {
                className : 'success',
                position : 'right center',
            });
        });
    });
});
