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
<div class=" my-4  rounded-lg shadow-lg">
    <h1 class=" text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Schedules</h1>
    <div class=" bg-white w-full">
        <div class=" border-b-2 py-3 px-10">
            <div class="flex justify-between">
                <div>
                    <span class="bg-[#B7E4FF] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">New</span>
                    <span class="bg-[#DAEFD5] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Complete</span>
                    <span class="bg-[#CFBFE8] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Pending</span>
                    <span class="bg-[#FDD5D7] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Cancel</span>
                    <!-- @if(session('user_details')['user_role'] == 'admin')
                    <div class="inline-block w-[50%]">
                        <select id="userSelect" name="" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <option value="">Users</option>
                            @foreach($allEmployees as $user)
                            <option value="{{$user->id}}" {{$user->id == request()->route('user') ? 'selected' : ''}}>{{$user->name}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif -->
                </div>
                <div>
                    <a href="/calendar">
                        <button id="" class=" float-right bg-[#930027] text-white py-2 px-7 rounded-md hover:bg-red-900 ">Calendar
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-4 flex justify-between gap-10">
            <!-- THE CALENDAR -->
            <div class=" w-[100%]">
                <div id="calendar" data-schedule-assigned="{{ isset($estimate) && $estimate->schedule_assigned == 1 ? 'true' : 'false' }}"></div>
            </div>
            <div id="external-events" class="w-[0%]">
                
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="assignment-work-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addUserToDo" id="assignment-work-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">New Assignment</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class="flex justify-start gap-3 my-2">
                        <label for="task_desc">Task:</label>
                        <input type="text" name="to_do_title" id="task_desc" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" placeholder="Task Description">
                    </div>
                    <div class="flex justify-start gap-3 my-2">
                        <label for="">Who:</label>
                        <select name="assign_work" id="assign_work" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach($allEmployees as $employee)
                                <option value="">{{$employee->name}} {{$employee->last_name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class="flex justify-start gap-3 mb-2">
                        <label for="start_date">Start date:</label>
                        <input type="datetime-local" name="start_date" id="assignment_start_date" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="flex justify-start gap-3 mb-2">
                        <label for="end_date">End date:</label>
                        <input type="datetime-local" name="end_date" id="assignment_end_date" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <textarea placeholder="Note " class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="note" id="note"></textarea>
                    <!-- You can customize this part according to your needs -->
                    <div>
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Set Schedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')

<script src="assets/plugins/fullcalendar/main.js"></script>
<script>
    $(document).ready(function() {
        $('#userSelect').change(function() {
            var userId = $(this).val();
            if (userId) {
                window.location.href = '/schedulesCalendar/' + userId;
            }
        });
    });
</script>
<script>
    $("#editEvent").click(function(e) {
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
    $(document).ready(function() {
        $('#start_date').change(function() {
            // Get the selected start date and time
            var startDateValue = new Date($(this).val());

            // Adjust the end date by adding 1 hour
            var endDateValue = new Date(startDateValue.getTime() + 6 * 60 * 60 * 1000);
            // console.log(endDateValue);
            // Format the end date to match the input type
            var formattedEndDate = endDateValue.toISOString().slice(0, 16);

            // Update the value of the end date input
            $('#end_date').val(formattedEndDate);
        });
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
        var assignmentModal = document.getElementById('assignment-work-modal');
        var assignmentStartDateInput = document.getElementById('assignment_start_date');
        var assignmentEndDateInput = document.getElementById('assignment_end_date');
        var scheduleAssigned = calendarEl.getAttribute('data-schedule-assigned') === 'true';

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

        var userToDos = {!! json_encode($userToDos) !!};
        var estimateToDos = {!! json_encode($estimateToDos) !!};

        // Convert user todos to events
var userEvents = userToDos.map(function(todo) {
    return {
        title: todo.to_do_title,
        start: new Date(todo.start_date), // Adjust the field according to your data
        end: new Date(todo.end_date), // Adjust the field according to your data
        backgroundColor: '#your_color', // Choose a color or generate dynamically
        borderColor: '#your_color' // Choose a color or generate dynamically
    };
});

// Convert estimate todos to events
var estimateEvents = estimateToDos.map(function(todo) {
    return {
        title: todo.to_do_title,
        start: new Date(todo.start_date), // Adjust the field according to your data
        end: new Date(todo.end_date), // Adjust the field according to your data
        backgroundColor: '#your_color', // Choose a color or generate dynamically
        borderColor: '#your_color' // Choose a color or generate dynamically
    };
});
var allEvents = userEvents.concat(estimateEvents);
        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            return `${year}-${month}-${day}`;
        }

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: allEvents,
            editable: true,
            droppable: true,
            drop: function(info) {
                var currentDate = new Date();
                var droppedDate = info.date;

                // Check if the dropped date is before the current date
                if (droppedDate < currentDate) {
                    // Display an alert or perform any other action to notify the user
                    alert('Cannot schedule events on past dates.');

                    // Revert the dragged element to its original position
                    info.revert(); // Revert the drag operation
                    return false; // Prevent the drop if the date is before the current date
                }

                // Continue with your existing logic for handling the drop
                var date = info.date;
                console.log(date);
                var modalId = scheduleAssigned ? 'schedule-work-modal' : 'schedule-estimate-modal';
                var modal = document.getElementById(modalId);
                var modalTitle = document.getElementById('modal-title');
                // var modalStartDateInput = document.getElementById('start_date');
                var modalEndDateInput = document.getElementById('end_date');

                var year = droppedDate.getFullYear();
                var month = (droppedDate.getMonth() + 1).toString().padStart(2, '0');
                var day = droppedDate.getDate().toString().padStart(2, '0');
                var hours = droppedDate.getHours().toString().padStart(2, '0');
var minutes = droppedDate.getMinutes().toString().padStart(2, '0');
var seconds = droppedDate.getSeconds().toString().padStart(2, '0');

var simpleDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

                // alert(simpleDate);
                $('#start_date').val(simpleDateTime);
                $('#end_date').val(simpleDateTime);

                // Set modal title and open modal
                modalTitle.textContent = info.draggedEl.innerText;
                // modalStartDateInput.value = formatDate(date);
                // modalEndDateInput.value = formatDate(date);
                console.log(formatDate(date));
                // alert(modalStartDateInput.value);
                modal.classList.remove('hidden');
            },

            eventClick: function(info) {
                var modal = document.getElementById('modal');
                var modalTitle = document.getElementById('modal-title');
                var modalDescription = document.getElementById('modal-description');
                modalTitle.textContent = info.event.title;
                modalDescription.textContent = info.event.description;
                modal.classList.remove('hidden');
            },
            dateClick: function(info) {
            // Get the clicked date
            var clickedDate = info.date;

            var timezoneOffset = clickedDate.getTimezoneOffset();

            // Adjust the date to local timezone
            clickedDate = new Date(clickedDate.getTime() - timezoneOffset * 60000);

            // Format the adjusted date for input value
            var formattedDate = clickedDate.toISOString().slice(0, 16);

            // Set the start and end date input values to the clicked date
            assignmentStartDateInput.value = formattedDate;
            assignmentEndDateInput.value = formattedDate;

            // Open the modal
            assignmentModal.classList.remove('hidden');
        }
        });

        // var modalClose = document.querySelector('.modal-close');
        // modalClose.addEventListener('click', function() {
        //     var modal = document.getElementById('modal');
        //     modal.classList.add('hidden');
        // });

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
<script>
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#assignment-work-modal").addClass('hidden');
        // $("#schedule-estimate-form")[0].reset()
    });
</script>