$(function () {
    let today = new Date();
    let y = today.getFullYear();
    let m = today.getMonth();
    let d = today.getDate();

    // Default view
    // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
    $('#fullcalendar-default').fullCalendar({
        // Bootstrap styling
        themeSystem: 'bootstrap4',
        bootstrapFontAwesome: {
            close: ' ion ion-md-close',
            prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
            next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
            prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
            nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
        },
        header: {
            left: 'title',
            center: 'month,agendaWeek,agendaDay',
            right: 'prev,next today'
        },
        defaultDate: today,
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,
        weekNumbers: true, // Show week numbers
        nowIndicator: true, // Show "now" indicator
        firstDay: 1, // Set "Monday" as start of a week
        editable: false,
        draggable: false,
        eventLimit: true, // allow "more" link when too many events
        droppable: false,
        events: {
            url: '/api/calendars',
            error: function () {
                $('#aviso-view').show();
                $('#fullcalendar-default').hide();
            }
        },
        loading: function (bool) {
            $('#loading-view').toggle(bool);
        },
        eventClick: function (event, jsEvent, view) {
            window.location.href = '/calendars/' + event.id +'.'+ event.slug;
        }
    });

    // List view
    // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
    $('#fullcalendar-list').fullCalendar({
        // Bootstrap styling
        themeSystem: 'bootstrap4',
        bootstrapFontAwesome: {
            close: ' ion ion-md-close',
            prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
            next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
            prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
            nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
        },
        header: {
            left: 'title',
            center: 'listDay,listWeek',
            right: 'prev,next today'
        },
        // customize the button names,
        views: {
            listDay: {
                buttonText: 'list day'
            },
            listWeek: {
                buttonText: 'list week'
            }
        },
        defaultView: 'listWeek',
        defaultDate: today,
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: '/api/calendars',
            error: function () {
                $('#aviso-list').show();
                $('#fullcalendar-list').hide();
            }
        },
        loading: function (bool) {
            $('#loading-list').toggle(bool);
        }
    });
});
