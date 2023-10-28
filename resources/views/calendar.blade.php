@include('layouts.header')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- fullCalendar -->
<script src="https://kit.fontawesome.com/4ae3f77a6d.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
<!-- Theme style -->
<!-- <link rel="stylesheet" href="assets/css/calendar.css"> -->
<style>
    .fc-daygrid-day-frame,
    .fc-col-header-cell {
        border: 1px solid #edf2f7;
    }

    .fc-prev-button {
        background: #930027;
        padding: 8px 8px 8px 15px;
        color: white;
        border-radius: 5px 0px 0px 5px;
    }

    .fc-next-button {
        background: #930027;
        padding: 8px 15px 8px 8px;
        color: white;
        border-radius: 0px 5px 5px 0px;
    }

    .fc-prev-button:hover,
    .fc-next-button:hover {
        background: darkred;
    }

    .btn-group {
        display: inline;
    }

    .fc-today-button {
        background: #930027;
        color: white;
        padding: 8px;
        border-radius: 5px;
        display: inline;
    }

    .fc-toolbar-title {
        color: #930027;
    }

    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button {
        background: #930027;
        padding: 8px;
        color: white;
    }

    .fc-dayGridMonth-button:hover,
    .fc-timeGridWeek-button:hover,
    .fc-timeGridDay-button:hover {
        background: darkred;
    }

    .fc-dayGridMonth-button {
        border-radius: 5px 0px 0px 5px;
    }

    .fc-timeGridDay-button {
        border-radius: 0px 5px 5px 0px;
    }
</style>
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Calendar</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" border-b-2 py-3 px-10">
            <span class="bg-[#B7E4FF] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">New</span>
            <span class="bg-[#DAEFD5] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Complete</span>
            <span class="bg-[#CFBFE8] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Pending</span>
            <span class="bg-[#FDD5D7] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Cancel</span>
        </div>
        <div class="p-4">
            <div id="external-events">
                <!-- <div class="external-event bg-success">Lunch</div>
                                <div class="external-event bg-warning">Go home</div>
                                <div class="external-event bg-info">Do homework</div>
                                <div class="external-event bg-primary">Work on UI design</div>
                                <div class="external-event bg-danger">Sleep tight</div>
                                <div class="checkbox">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        remove after drop
                                    </label>
                                </div> -->
            </div>

            <!-- THE CALENDAR -->
            <div id="calendar"></div>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="assets/plugins/fullcalendar/main.js"></script>

<script>
    $(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                // $(this).draggable({
                //     zIndex: 1070,
                //     revert: true, // will cause the event to go back to its
                //     revertDuration: 0 //  original position after the drag
                // })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954', //red
                    allDay: true
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor: '#00c0ef' //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor: '#00a65a' //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'https://www.google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor: '#3c8dbc' //Primary (light-blue)
                }
            ],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        $('#add-new-event').click(function(e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })
    })
</script>
@include('layouts.footer')