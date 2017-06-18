$(window).load(function() {
    $('#calendar').monthly({
        weekStart: 'Mon',
        // mode: 'picker',
        dataType: 'json',
        jsonUrl: 'bookings',
        eventList: false,
        disablePast: true
    });
});