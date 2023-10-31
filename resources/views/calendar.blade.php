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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="updateevent-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Coyne Development Corp - Steve</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">65 Water St, Newburyport, MA, 01950</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">tom.droste-sc@gmail.com</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">949-300-9632 c</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: Tom D</p>
                        </div>
                        <div id="dropdown-div" class="hidden">
                            <p class=" font-medium items-center">Who will complete estimate?</p>
                            <label for="userDropdown">User</label>
                            <select id="customer" name="customer" autocomplete="customer-name" class=" ml-12 pl-2 w-[70%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Select</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                            <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <p class=" se_date text-[#858585]">2023-10-04</p>
                        <input type="date" name="startDate" id="startDate" autocomplete="given-name" class=" se_date hidden w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <p class=" se_date text-[#858585]">2023-10-04</p>
                        <input type="date" name="fendDate" id="fendDate" autocomplete="given-name" class=" se_date hidden w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <textarea placeholder="Note " disabled class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="" id="noteText"></textarea>
                    <!-- task details -->
                    <p class="text-sm mb-4" id="modal-description"></p>
                    <!-- You can customize this part according to your needs -->
                    <div>
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button type="button" id="editEvent" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Edit
                            <svg width="27" height="27" class=" inline-block" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0425 17.5989L16.6252 11.6726C16.8743 11.353 16.9628 10.9835 16.8798 10.6073C16.8079 10.2653 16.5976 9.94009 16.2821 9.69339L15.5128 9.08226C14.8431 8.54962 14.0129 8.60569 13.5369 9.21682L13.0222 9.88458C12.9557 9.96812 12.9723 10.0915 13.0554 10.1588C13.0554 10.1588 14.356 11.2016 14.3837 11.224C14.4722 11.3081 14.5387 11.4203 14.5553 11.5548C14.5829 11.8183 14.4003 12.065 14.1291 12.0987C14.0018 12.1155 13.88 12.0763 13.7915 12.0034L12.4244 10.9157C12.358 10.8658 12.2584 10.8764 12.203 10.9437L8.95418 15.1487C8.74387 15.4123 8.67191 15.7543 8.74387 16.0851L9.15897 17.8848C9.1811 17.9801 9.26412 18.0474 9.36375 18.0474L11.1902 18.025C11.5223 18.0194 11.8322 17.868 12.0425 17.5989ZM14.5997 17.0384H17.5779C17.8685 17.0384 18.1048 17.2778 18.1048 17.5722C18.1048 17.8671 17.8685 18.106 17.5779 18.106H14.5997C14.3092 18.106 14.0728 17.8671 14.0728 17.5722C14.0728 17.2778 14.3092 17.0384 14.5997 17.0384Z" fill="white" />
                            </svg>
                        </button>
                        <button id="updateEvent" class=" hidden float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="assets/plugins/fullcalendar/main.js"></script>

<script>
    $("#editEvent").click(function (e) { 
        e.preventDefault();
        $("#estimators").toggleClass('hidden');
        $("#dropdown-div").toggleClass('hidden');
        $(".se_date").toggleClass('hidden');
        $("#noteText").removeAttr('disabled');
        $("#editEvent").addClass('hidden');
        $("#updateEvent").removeClass('hidden');
        $(".modalClose-btn").text('Cancel');
    });
</script>
<script>
    $(function() {
        // Initialize the external events
        function ini_events(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text())
                }
                $(this).data('eventObject', eventObject)
            })
        }

        ini_events($('#external-events div.external-event'))

        // Initialize the calendar
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

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
            events: [{
                    title: 'Coyne Development Corp - Steve',
                    description: 'there can be som description about the event.',
                    start: new Date(y, m, 1),
                    backgroundColor: '#B7E4FF', //red
                    borderColor: '#B7E4FF', //red
                    color: '#000',
                    allDay: true
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, 5),
                    end: new Date(y, m, d - 23),
                    backgroundColor: '#DAEFD5', //yellow
                    borderColor: '#DAEFD5' //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, 10),
                    allDay: true,
                    backgroundColor: '#CFBFE8', //Blue
                    borderColor: '#CFBFE8' //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, 15),
                    allDay: true,
                    backgroundColor: '#FDD5D7', //Info (aqua)
                    borderColor: '#FDD5D7' //Info (aqua)
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
            droppable: true,
            drop: function(info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventClick: function(info) {
                var modal = document.getElementById('modal');
                var modalTitle = document.getElementById('modal-title');
                var modalDescription = document.getElementById('modal-description');
                modalTitle.textContent = info.event.title;
                modalDescription.textContent = info.event.description;
                modal.classList.remove('hidden');
            }
        });

        var modalClose = document.querySelector('.modal-close');
        modalClose.addEventListener('click', function() {
            var modal = document.getElementById('modal');
            modal.classList.add('hidden');
        });

        calendar.render();

        var currColor = '#3c8dbc'
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            currColor = $(this).css('color')
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })

        $('#add-new-event').click(function(e) {
            e.preventDefault()
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#000'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)
            ini_events(event)
            $('#new-event').val('')
        })
    });
</script>
@include('layouts.footer')