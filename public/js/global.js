$(window).load(function() {
    $('#calendar').monthly({
        weekStart: 'Mon',
        // mode: 'picker',
        dataType: 'json',
        jsonUrl: 'inventory',
        eventList: false,
        disablePast: true
    });
});

$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#update_inventory').submit(function(evt) {
        evt.preventDefault();

        var request = $(this).serialize();
        var action = $(this).attr('action');

        $.post(action, request).done(function (data) {
            console.log(data);
        });
    });
});
