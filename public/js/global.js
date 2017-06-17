$(window).load(function() {
    $('#calendar').monthly({
        weekStart: 'Mon',
        // mode: 'picker',
        dataType: 'json',
        jsonUrl: 'inventory.json',
        eventList: false,
        disablePast: true
    });
});