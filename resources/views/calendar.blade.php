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
    /* Custom scrollbar styles */
    .visible-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .visible-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .visible-scrollbar::-webkit-scrollbar-thumb {
        background: #930027;
        border-radius: 4px;
    }

    .visible-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6a001b;
    }
</style>
<style>
    .fc .fc-col-header-cell-cushion {
        border-bottom: 1px solid #ddd;
    }
    .fc .fc-daygrid-day-frame {
        border-right: 1px solid #ddd;
    }
    .fc .fc-timegrid-slot {
        border-bottom: 1px solid #ddd;
    }
    .fc .fc-timegrid-axis-cushion {
        border-right: 1px solid #ddd;
    }
    .fc .fc-timegrid-col-frame {
        border-right: 1px solid #ddd;
    }
</style>
<div class=" my-4  rounded-lg shadow-lg">
    <h1 class=" text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Calendar</h1>
    <div class=" bg-white w-full">
        <div class=" border-b-2 py-3 px-10">
            <div class="flex justify-between">
                <div>
                    <!-- <span class="bg-[#B7E4FF] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">New</span>
                    <span class="bg-[#DAEFD5] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Complete</span>
                    <span class="bg-[#CFBFE8] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Pending</span>
                    <span class="bg-[#FDD5D7] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Cancel</span> -->
                </div>
                <div>
                    <!-- <a href="/schedulesCalendar">
                        <button id="" class=" float-right bg-[#930027] text-white py-2 px-7 rounded-md hover:bg-red-900 ">Other Schedules
                        </button>
                    </a> -->
                </div>
            </div>
        </div>
        <div class="p-4 flex justify-between gap-10">
            <!-- THE CALENDAR -->
            <div class=" w-[80%]">
                <div id="calendar" data-schedule-assigned="{{ isset($estimate) && $estimate->schedule_assigned == 1 ? 'true' : 'false' }}"></div>
            </div>
            <div id="external-events" class="w-[20%]">
            <div class="mt-[100px]">
                <input type="checkbox" name="completed" id="completed">
                <label for="completed" class=" text-gray-500">Completed</label>
            </div>
            <div class=" mt-2 flex">
                <a href="/crewCalendar">
                    <button id="" class="  bg-[#930027] text-white py-1 px-7  hover:bg-red-900 rounded-l-full ">Planner
                    </button>
                </a>
                <a href="/calendar">
                    <button id="" class="  bg-[#930027] text-white py-1 px-7  hover:bg-red-900 rounded-r-full ">Clear
                    </button>
                </a>
            </div>
            <div class="">
                <div class="bg-white rounded-lg mt-[8px] shadow-lg">
                    <div class="bg-[#930027] rounded-t-lg">
                        <p class="p-2 text-center text-white font-medium">Users</p>
                    </div>
                    <div class="pt-3 pb-2 text-center items-center h-40 overflow-auto visible-scrollbar">
                        @foreach($allEmployees as $employee)
                        <div class="flex gap-3 mx-3 px-2 {{ $employee->id == request()->route('id') ? 'bg-[#ffdde4]' : '' }} hover:bg-gray-100 rounded">
                            <div class="my-auto" style="width: 20px; height: 20px; background-color: {{$employee->user_color}};"></div>
                            <a href="/calendar{{$employee->id}}" class="w-full">
                                <div class="p-1">{{$employee->name}} {{$employee->last_name}}</div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
                @if (session('user_details')['user_role'] != 'crew')
                <div class="">
                    <div class=" bg-white rounded-lg mt-2 shadow-lg">
                        <div class=" bg-[#930027] rounded-t-lg">
                            <p class="p-2 text-center text-white font-medium">Pending List</p>
                        </div>
                        <div class=" pt-3 pb-2 flex flex-col items-center">
                            @if(isset($estimate))
                            <div class="external-event bg-[#B7E4FF] text-xs font-medium px-2 py-2 rounded-lg w-32 mb-2 cursor-pointer" id="schedule-estimate">{{ $estimate->customer_name }} {{$estimate->customer_last_name}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</div>
@if(isset($estimate))
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="schedule-estimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/setScheduleEstimate" id="schedule-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{$customer->customer_primary_address}}, {{$customer->customer_city}}, {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}</p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete Estimate?</p>
                            <select name="assign_estimate_completion[]" multiple id="assign_estimate_completion" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach($allEmployees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{$user->last_name}} <sub>({{$user->user_role}})</sub> </option>
                                @endforeach
                            </select>
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button> -->
                        </div>
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="datetime-local" name="start_date" id="start_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="datetime-local" name="end_date" id="end_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
@endif
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
                        <select name="assign_work[]" id="assign_work" multiple
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select Users</option>
                            @foreach($allEmployees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->last_name }}</option>
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
                    <div class="flex justify-start gap-3 mb-2">
                        <label for="end_date">Address:</label>
                        <input type="text" name="address" id="assignment_address" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
<!-- Event Details Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="event-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="editEventForm" method="post">
                @csrf
                <input type="hidden" name="estimate_schedule_id" id="estimate_schedule_id" value="">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class="flex justify-between">
                        <div class=" flex justify-start gap-3">
                            <a id="viewEstimateIcon" class="inline-block" href=""><img src="{{asset('assets/icons/view-icon.svg')}}" alt="view-icon"></a>
                            <h2 class="text-xl font-semibold mb-2 text-[#F5222D]" id=""> View Details</h2>
                        </div>
                        <button class="modal-close" type="button" onclick="clearModalAndClose();">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <div>
                        <span id="event-title" class="text-lg font-semibold mb-2"></span> (<span id="assigned_user"></span>)
                        <h2 id="event-project-name" class="mb-2"></h2>
                        <h2 id="event-project-name" class="mb-2"></h2>
                        <a href="" id="address-link" target="_blank" class=" text-[#930027]"><h2 id="event-customer-address" class="mb-2"></h2></a>
                        <p id="event-note" class="mb-2"></p>
                        <div id="event-title-div" class=" hidden">
                            <div class="flex justify-start gap-3 my-2">
                                <label for="task_desc">Task:</label>
                                <input type="text" name="task_name" id="all-event-title" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" placeholder="Task Description">
                            </div>
                        </div>
                        <div id="assign_work_div" class="flex justify-start gap-3 my-2">
                            <label for="">Who:</label>
                            <select name="assign_work" id="update_assign_work"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Users</option>
                                @foreach($allEmployees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="event-dates" class="hidden">
                            <div class=" flex justify-start gap-3 mb-2">
                                <label>Start date:</label>
                                <input type="datetime-local" name="start_date" id="update_start_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div class=" flex justify-start gap-3 mb-2">
                                <label>End date:</label>
                                <input type="datetime-local" name="end_date" id="update_end_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                        </div>
                        <div id="event-start-end" class="">
                            <p class="mb-2"><strong>Start:</strong> <span id="event-start"></span></p>
                            <p class="mb-2"><strong>End:</strong> <span id="event-end"></span></p>
                        </div>
                        <div id="edit_address_div" class="hidden">
                            <div class="flex justify-start gap-3 mb-2">
                                <label for="end_date">Address:</label>
                                <input type="text" name="address" id="edit_assignment_address" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                        </div>
                        <div class="hidden" id="event-text">
                            <textarea name="note" id="event-textarea" class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="modalClose-btn border border-black font-semibold py-1 px-7 rounded-lg" onclick="clearModalAndClose();">Close</button>
                        <a href="" id="deleteEventLink">
                            <button type="button" class="modalClose-btn border border-black font-semibold py-1 px-7 rounded-lg">Delete</button>
                        </a>
                        <button type="button" id="editUpdateEvent" class="float-right mx-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900">Edit</button>
                        <a href="" id="completeEvent" class="hidden">
                            <button type="button" class="float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900">Complete</button>
                        </a>
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
    $(document).on('click', '#deleteEventLink, #completeEvent', function (e) {
    e.preventDefault(); // Prevent the default anchor behavior

    const url = $(this).attr('href'); // Get the URL from the href attribute

    if (url) {
        // Send an AJAX DELETE request
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                console.log('Delete successful:', response);
                // Reload the page
                location.reload();
            },
            error: function (error) {
                console.error('Error deleting event:', error);
                alert('An error occurred while trying to delete the event. Please try again.');
            }
        });
    } else {
        alert('No URL is set for deletion.');
    }
});

    $("#editUpdateEvent").click(function(e) {
    e.preventDefault();
    if ($(this).text() === 'Edit') {
        $('#event-dates').removeClass('hidden');
        $('#event-start-end').addClass('hidden');
        $('#event-text').removeClass('hidden');
        $('#event-textarea').val($('#event-note').text());
        $('#event-note').addClass('hidden');
        $('#assign_work_div').removeClass('hidden');
        $('#edit_address_div').removeClass('hidden');
        if($('#editEventForm').attr('action') != '/setScheduleEstimate') {
            $('#event-title-div').removeClass('hidden');
            $('#all-event-title').val($('#event-title').text());
            $('#event-title').addClass('hidden');
        }
        $(this).text('Update').attr('type', 'submit');
    } else if ($(this).text() === 'Update') {
        // Optionally set the form's action attribute if needed
        // $('#editEventForm').attr('action', '/update-url');
        
        $('#editEventForm').submit(); // Submit the form
    }
});

function clearModalAndClose() {
    $('#event-title').text('');
    $('#assigned_user').text('');
    $('#event-project-name').text('');
    $('#event-customer-address').text('');
    $('#event-note').text('');
    $('#event-start').text('');
    $('#event-end').text('');
    $('#viewEstimateIcon').removeClass('hidden').attr('href', '');
    $('#editUpdateEvent').text('Edit').attr('type', 'button');
    $('#edit_address_div').addClass('hidden');
    $('#event-dates').addClass('hidden');
    $('#event-start-end').removeClass('hidden');
    $('#editEventForm').attr('action', '');
    $('#event-modal').addClass('hidden');
    $('#event-text').addClass('hidden');
    $('#event-textarea').val('');
    $('#event-note').removeClass('hidden');
    $('#event-title-div').addClass('hidden');
    $('#all-event-title').val('');
    $('#completeEvent').addClass('hidden');
    $('#event-title').removeClass('hidden');
    $('#deleteEventLink').attr('');
    let $select = $('#update_assign_work');

    // Destroy Select2 before resetting attributes
    $select.select2('destroy');

    // Reset to original form
    $select.removeAttr('multiple').attr('name', 'assign_work');

    $select.select2({
        placeholder: 'Select Users',
        width: '100%'
    });
    // Optionally reset the selection to default
    $select.val('').trigger('change');

}
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

        @if(isset($crewSchedule) && $crewSchedule === 1)
            var estimateEvent = {!! json_encode($estimates) !!};

            var events = estimateEvent.filter(function(estimate) {
            return !(estimate.estimate_assigned == 1);
            }).map(function(estimate) {
            var startDate = new Date(estimate.start_date);
            var endDate = new Date(estimate.end_date);
            var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;
            return {
                id: estimate.estimate_id,
                title: (estimate.estimate_assigned == 1 ? '✔ ' : '') +  [estimate.estimate.customer_name + ' ' + estimate.estimate.customer_last_name],
                start: startDate,
                end: endDate,
                allDay: isAllDay,
                backgroundColor: estimate.assigned_user ? estimate.assigned_user.user_color : '',
                borderColor: estimate.assigned_user ? estimate.assigned_user.user_color : '',
                extendedProps: {
                type: 'estimate'
                }
            };
            });
        @else
        var estimateEvent = {!! json_encode($estimates) !!};
var filterId = {!! json_encode($filterId) !!}; // Get the filter ID from Laravel

var events = [];

estimateEvent.forEach(function(estimate) {
    if (estimate.estimate_assigned == 1) {
        return; // Skip this estimate
    }

    var startDate = new Date(estimate.scheduled_start_date);
    var endDate = new Date(estimate.scheduled_end_date);
    var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;

    if (estimate.schedulers && estimate.schedulers.length > 0) {
        estimate.schedulers.forEach(function(scheduler) {
            // If filterId is set, only show matching schedulers
            if (filterId && scheduler.id != filterId) {
                return;
            }

            var eventObj = {
                id: estimate.estimate_id + '-' + scheduler.id,
                title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
                start: startDate,
                end: endDate,
                allDay: isAllDay,
                backgroundColor: scheduler.user_color ? scheduler.user_color : '',
                borderColor: scheduler.user_color ? scheduler.user_color : '',
                extendedProps: {
                    type: 'estimate',
                    scheduler_name: scheduler.name
                }
            };
            events.push(eventObj);
        });
    } else if (estimate.crew != null) {
        // If filterId is set, only show matching crew members
        if (filterId && estimate.crew.id != filterId) {
            return;
        }

        events.push({
            id: estimate.estimate_id,
            title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
            start: startDate,
            end: endDate,
            allDay: isAllDay,
            backgroundColor: estimate.crew.user_color ? estimate.crew.user_color : '',
            borderColor: estimate.crew.user_color ? estimate.crew.user_color : '',
            extendedProps: {
                type: 'estimate'
            }
        });
    } else {
        // Default user color, only show if no filter is applied
        if (!filterId) {
            var userColor = '{{ session('user_details')['user_color'] }}';
            events.push({
                id: estimate.estimate_id,
                title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
                start: startDate,
                end: endDate,
                allDay: isAllDay,
                backgroundColor: userColor ? userColor : '',
                borderColor: userColor ? userColor : '',
                extendedProps: {
                    type: 'estimate'
                }
            });
        }
    }
});

        @endif

        var userToDos = {!! json_encode($userToDos) !!};
        var estimateToDos = {!! json_encode($estimateToDos) !!};
        
        var userEvents = userToDos.filter(function(todo) {
            return todo.to_do_status === null;
        }).map(function(todo) {
            var startDate = new Date(todo.start_date);
            var endDate = new Date(todo.end_date);
            var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;
            var userColor = todo.assigned_to ? todo.assigned_to.user_color : '#your_default_color';
            return {
            id: todo.to_do_id,
            title: (todo.to_do_status == 'completed' ? '✔ ' : '') + todo.to_do_title,
            start: startDate, // Adjust the field according to your data
            end: endDate, // Adjust the field according to your data
            allDay: isAllDay,
            backgroundColor: userColor, // Use the assigned user's color
            borderColor: userColor, // Use the assigned user's color
            extendedProps: {
            type: 'userToDo'
            }
            };
        });

        // Convert estimate todos to events
        var estimateEvents = estimateToDos.filter(function(todo) {
            return todo.to_do_status === 'pending';
        }).map(function(todo) {
            var startDate = new Date(todo.start_date);
            var endDate = new Date(todo.end_date);
            var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;
            var userColor = todo.assigned_by ? todo.assigned_by.user_color : '#your_default_color';
            return {
            id: todo.to_do_id,
            title: (todo.to_do_status == 'completed' ? '✔' : '') + todo.to_do_title,
            start: startDate, // Adjust the field according to your data
            end: endDate, // Adjust the field according to your data
            allDay: isAllDay,
            backgroundColor: userColor, // Use the assigned user's color
            borderColor: userColor, // Use the assigned user's color
            extendedProps: {
            type: 'estimateToDo'
            }
            };
        });
        var allEvents = events.concat(userEvents, estimateEvents);
        $('#completed').change(function() {
    var showCompleted = $(this).is(':checked'); // Check if checkbox is checked

    // If checked, show all todos (both completed and pending)
    var updatedUserEvents = userToDos.filter(function(todo) {
        return showCompleted || todo.to_do_status === null; // Show all if checked
    }).map(function(todo) {
        var startDate = new Date(todo.start_date);
        var endDate = new Date(todo.end_date);
        var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;
        var userColor = todo.assigned_to ? todo.assigned_to.user_color : '#your_default_color';
        return {
            id: todo.to_do_id,
            title: (todo.to_do_status == 'completed' ? '✔ ' : '') + todo.to_do_title,
            start: startDate,
            end: endDate,
            allDay: isAllDay,
            backgroundColor: userColor,
            borderColor: userColor,
            extendedProps: {
                type: 'userToDo'
            }
        };
    });

    var updatedEstimateEvents = estimateToDos.filter(function(todo) {
        return showCompleted || todo.to_do_status === 'pending'; // Show all if checked
    }).map(function(todo) {
        var startDate = new Date(todo.start_date);
        var endDate = new Date(todo.end_date);
        var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;
        var userColor = todo.assigned_by ? todo.assigned_by.user_color : '#your_default_color';
        return {
            id: todo.to_do_id,
            title: (todo.to_do_status == 'completed' ? '✔ ' : '') + todo.to_do_title,
            start: startDate,
            end: endDate,
            allDay: isAllDay,
            backgroundColor: userColor,
            borderColor: userColor,
            extendedProps: {
                type: 'estimateToDo'
            }
        };
    });

    var updatedEvents = [];

estimateEvent.filter(function(estimate) {
    return showCompleted || estimate.estimate_assigned != 1;
}).forEach(function (estimate) {
    var startDate = new Date(estimate.scheduled_start_date);
    var endDate = new Date(estimate.scheduled_end_date);
    var isAllDay = startDate.getHours() == 0 && startDate.getMinutes() == 0 && endDate.getHours() == 0 && endDate.getMinutes() == 0;

    if (estimate.schedulers && estimate.schedulers.length > 0) {
        estimate.schedulers.forEach(function(scheduler) {
            updatedEvents.push({
                id: estimate.estimate_id + '-' + scheduler.id,
                title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
                start: startDate,
                end: endDate,
                allDay: isAllDay,
                backgroundColor: scheduler.user_color ? scheduler.user_color : '',
                borderColor: scheduler.user_color ? scheduler.user_color : '',
                extendedProps: {
                    type: 'estimate',
                    scheduler_name: scheduler.name
                }
            });
        });
    } else if (estimate.crew != null) {
        updatedEvents.push({
            id: estimate.estimate_id,
            title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
            start: startDate,
            end: endDate,
            allDay: isAllDay,
            backgroundColor: estimate.crew.user_color ? estimate.crew.user_color : '',
            borderColor: estimate.crew.user_color ? estimate.crew.user_color : '',
            extendedProps: {
                type: 'estimate'
            }
        });
    } else {
        var userColor = '{{ session('user_details')['user_color'] }}';
        updatedEvents.push({
            id: estimate.estimate_id,
            title: (estimate.estimate_assigned == 1 ? '✔ ' : '') + estimate.customer_name + ' ' + estimate.customer_last_name,
            start: startDate,
            end: endDate,
            allDay: isAllDay,
            backgroundColor: userColor ? userColor : '',
            borderColor: userColor ? userColor : '',
            extendedProps: {
                type: 'estimate'
            }
        });
    }
});


    var allUpdatedEvents = events.concat(updatedUserEvents, updatedEstimateEvents, updatedEvents);


    // Remove all events and re-add updated events
    calendar.removeAllEvents();
    calendar.addEventSource(allUpdatedEvents);
});


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
            initialView: 'timeGridWeek',
            themeSystem: 'bootstrap',
            events: allEvents,
            editable: true,
            droppable: true,
            drop: function(info) {
                var currentDate = new Date();
                var droppedDate = info.date;

                // Check if the dropped date is before the current date
                if (droppedDate < currentDate.setHours(0,0,0,0)) {
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

var simpleDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

// Create a new Date object from droppedDate
var endDate = new Date(droppedDate);

// Add one hour to the Date object
endDate.setHours(endDate.getHours() + 1);

// Format the new date and time
var endYear = endDate.getFullYear();
var endMonth = (endDate.getMonth() + 1).toString().padStart(2, '0');
var endDay = endDate.getDate().toString().padStart(2, '0');
var endHours = endDate.getHours().toString().padStart(2, '0');
var endMinutes = endDate.getMinutes().toString().padStart(2, '0');
var endSeconds = endDate.getSeconds().toString().padStart(2, '0');

var endDateTime = endYear + '-' + endMonth + '-' + endDay + ' ' + endHours + ':' + endMinutes + ':' + endSeconds;

// alert(simpleDate);
$('#start_date').val(simpleDateTime);
$('#end_date').val(endDateTime);

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
            eventClick: function (info) {
                var event = info.event;
                var eventId = event.id; // Assuming your event object has an ID
                var eventType = event.extendedProps.type;

                // Fetch event details from your server or event object
                $.ajax({
                    url: '/getEventDetailOnCalendar',
                    method: 'GET',
                    data:{ id: eventId, type: eventType },
                    success: function (response) {
                        // Populate the modal with event details based on event type
                        if (eventType === 'userToDo' || eventType === 'estimateToDo') {
                            console.log(response);
                            $('#event-title').text(response.to_do_title);
                            $('#assigned_user').text(response.assigned_to.name);
                            $('#event-note').text(response.note);
                            $('#event-start').text(new Date(response.start_date).toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short' }));
                            $('#event-end').text(new Date(response.end_date).toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short' }));
                            $('#viewEstimateIcon').addClass('hidden');
                            // Set start_date and end_date inputs
                            $('#update_start_date').val(response.start_date);
                            $('#update_end_date').val(response.end_date);
                            // Check if 'estimate_id' exists in the response
                             // Populate assigned users in the multi-select dropdown
                            const assignedUsers = Array.isArray(response.to_do_assigned_to)
                                ? response.to_do_assigned_to // Already an array
                                : JSON.parse(response.to_do_assigned_to || '[]'); // Parse if it's a JSON string
                            console.log(assignedUsers);
                            $('#update_assign_work').val(assignedUsers).trigger('change');
                            if (response.estimate_id) {
                                $('#editEventForm').attr('action', '/addToDos');
                                $('#estimate_schedule_id').val(response.to_do_id);
                                $('#deleteEventLink').attr('href', '/deleteToDo' + response.to_do_id);
                                if(response.to_do_status == 'completed') {
                                    $('#completeEvent').addClass('hidden');
                                } else {
                                $('#completeEvent').removeClass('hidden');
                                $('#completeEvent').attr('href', '/completeToDo' + response.to_do_id);
                                }
                            } else {
                                $('#editEventForm').attr('action', '/addUserToDo');
                                $('#estimate_schedule_id').val(response.to_do_id);
                                $('#deleteEventLink').attr('href', '/deleteUserToDo/' + response.to_do_id);
                                $('#event-customer-address').text(response.to_do_address);
                                $('#edit_assignment_address').val(response.to_do_address);
                            $('#address-link').attr('href', 'https://maps.google.com/?q=' + response.to_do_address);
                                if(response.to_do_status == 'completed') {
                                    $('#completeEvent').addClass('hidden');
                                } else {
                                    $('#completeEvent').removeClass('hidden');
                                    $('#completeEvent').attr('href', '/completeUserToDo/' + response.to_do_id);
                                }
                            }
                        } else if (eventType === 'estimate') {
                            console.log(response);
                            $('#event-title').text(response.customer_name + ' ' + response.customer_last_name);
                            if (response.estimate_schedule && response.estimate_schedule.note) {
                                $('#event-note').text(response.estimate_schedule.note);
                            }
                            $('#event-start').text(new Date(response.scheduled_start_date).toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short' }));
                            $('#event-end').text(new Date(response.scheduled_end_date).toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short' }));
                            $('#event-project-name').text(response.project_name);
                            // Set start_date and end_date inputs
                            const assignedUsers = Array.isArray(response.estimate_schedule_assigned_to)
                                ? response.estimate_schedule_assigned_to // Already an array
                                : JSON.parse(response.estimate_schedule_assigned_to || '[]'); // Parse if it's a JSON string
                            console.log(assignedUsers);
                            let $select = $('#update_assign_work');

                            // Destroy Select2 before modifying the select element
                            $select.select2('destroy');

                            // Modify the attributes
                            $select.attr('name', 'assign_work[]').attr('multiple', true);

                            // Reinitialize Select2 with full width
                            $select.select2({
                                width: '100%',  // Ensures full width
                                placeholder: "Select Users"
                            });

                            // Set the selected values
                            $select.val(assignedUsers).trigger('change');
                            $('#update_start_date').val(response.scheduled_start_date);
                            $('#update_end_date').val(response.scheduled_end_date);
                            $('#event-customer-address').text(response.customer_address + ', ' + response.customer.customer_city + ', ' + response.customer.customer_state + ', ' + response.customer.customer_zip_code);
                            $('#address-link').attr('href', 'https://maps.google.com/?q=' + response.customer_address);
                            $('#viewEstimateIcon').attr('href', '/viewEstimate/' + response.estimate_id);
                            $('#editEventForm').attr('action', '/setScheduleEstimate');
                            $('#estimate_schedule_id').val(response.estimate_schedule.estimate_schedule_id);
                            $('#deleteEventLink').attr('href', '/deleteScheduleEstimate/' + response.estimate_schedule.estimate_schedule_id);
                        }

                        // Show the modal
                        $('#event-modal').removeClass('hidden');
                    },
                    error: function (xhr) {
                        alert('Failed to fetch event details: ' + xhr.responseJSON.error);
                    }
                });
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
                'border-color': currColor,
                'color': currColor
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
                'color': currColor
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)
            ini_events(event)
            $('#new-event').val('')
        })
    });
</script>
@include('layouts.footer')
<script>
    $("#schedule-work").click(function(e) {
        e.preventDefault();
        $("#schedule-work-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#schedule-work-modal").addClass('hidden');
        // $("#schedule-work-form")[0].reset()
    });
</script>
<script>
    $("#schedule-estimate").click(function(e) {
        e.preventDefault();
        $("#schedule-estimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#schedule-estimate-modal").addClass('hidden');
        // $("#schedule-estimate-form")[0].reset()
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#assignment-work-modal").addClass('hidden');
        // $("#schedule-estimate-form")[0].reset()
    });
</script>