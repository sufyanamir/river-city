@include('layouts.header')
<style>
    /* Your CSS styles here */
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .badge {
        background-color: #007bff;
        color: white;
        border-radius: 10px;
        padding: 2px 8px;
        display: block;
        /* Display badges vertically */
        margin-bottom: 5px;
        width: 100%;
        /* Add some spacing between badges */
    }

    button {
        margin-top: 10px;
    }

    .crew-container {
        display: flex;
        align-items: center;
        /* Align items vertically */
    }

    .crew-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        margin-left: 50px;
        object-fit: cover;
    }

    .crew-name {
        font-weight: 500;
        font-size: large;
    }
</style>
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Crew Calendar</h4>
            </div>
            <div>
                <!-- <x-add-button :title="'+Add Customer'" :class="''" :id="'addCustomer'"></x-add-button> -->
            </div>
        </div>
        <div class=" flex gap-3">
            @if(isset($estimate))
            <div class=" py-4 w-[85%]">
                @else
            <div class=" py-4 w-[100%]">
                @endif
                <div class=" m-2 text-right">
                    <button id="prevBtn" class=" p-2 bg-[#930027] rounded-lg text-white">Previous</button>
                    <button id="nextBtn" class=" p-2 bg-[#930027] rounded-lg text-white">Next</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Crew</th>
                            <th id="mon"></th>
                            <th id="tue"></th>
                            <th id="wed"></th>
                            <th id="thu"></th>
                            <th id="fri"></th>
                            <th id="sat"></th>
                            <th id="sun"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
    
                    </tbody>
                </table>
            </div>
            @if(isset($estimate))
            <div class=" w-[15%]">
                    <div class="">
                        <div class=" bg-white rounded-lg mt-[100px] shadow-lg">
                            <div class=" bg-[#930027] rounded-t-lg">
                                <p class="p-2 text-center text-white font-medium">Pending List</p>
                            </div>
                            <div class=" pt-3 pb-2 flex flex-col items-center">
                                @if ($estimate->schedule_assigned == 1)
                                <div class="external-event bg-[#B7E4FF] text-xs font-medium px-2 py-2 rounded-lg w-32 mb-2 cursor-pointer" id="schedule-work">{{ $estimate->customer_name }} {{$estimate->customer_last_name}}</div>
                                @else
                                <div class="external-event bg-[#B7E4FF] text-xs font-medium px-2 py-2 rounded-lg w-32 mb-2 cursor-pointer" id="schedule-estimate">{{ $estimate->customer_name }} {{$estimate->customer_last_name}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </div>
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="view-customerDetails">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="/updateScheuleWork" method="post">
                    @csrf
                    <input type="hidden" name="estimate_id" id="estimate_id" value="">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal content here -->
                        <div class=" flex justify-between">
                            <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                                First Last
                            </h2>
                            <button class="modal-close" type="button">
                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                        <!-- task details -->
                        <div>
                            <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                            <p id="customer_address" class=" font-medium inline-block items-center">Address,
                                city, state,
                                zip code
                            </p>
                        </div>
                        <div>
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p id="customer_email" class=" font-medium inline-block items-center">Email</p>
                        </div>
                        <div>
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p id="customer_phone" class=" font-medium inline-block items-center">Phone</p>
                        </div>
                        <div>
                            <p class=" font-medium inline-block items-center">When should it be completed?</p>
                        </div>
                        <div class=" flex justify-start gap-3 mb-2">
                            <label>Start date:</label>
                            <p id="start_date" class=" font-semibold">23/5/12</p>
                            <input type="date" name="startDate" id="startDate" autocomplete="given-name" class=" se_date hidden w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" flex justify-start gap-3 mb-2">
                            <label>End date:</label>
                            <p id="end_date" class=" font-semibold">23/5/12</p>
                            <input type="date" name="fendDate" id="fendDate" autocomplete="given-name" class=" se_date hidden w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2 col-span-2 relative">
                            <label for="" class="block text-left mb-1"> Note: </label>
                            <textarea name="note" disabled id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class=" mx-7 my-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button type="button" id="editEvent" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Edit
                            <svg width="27" height="27" class=" inline-block" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0425 17.5989L16.6252 11.6726C16.8743 11.353 16.9628 10.9835 16.8798 10.6073C16.8079 10.2653 16.5976 9.94009 16.2821 9.69339L15.5128 9.08226C14.8431 8.54962 14.0129 8.60569 13.5369 9.21682L13.0222 9.88458C12.9557 9.96812 12.9723 10.0915 13.0554 10.1588C13.0554 10.1588 14.356 11.2016 14.3837 11.224C14.4722 11.3081 14.5387 11.4203 14.5553 11.5548C14.5829 11.8183 14.4003 12.065 14.1291 12.0987C14.0018 12.1155 13.88 12.0763 13.7915 12.0034L12.4244 10.9157C12.358 10.8658 12.2584 10.8764 12.203 10.9437L8.95418 15.1487C8.74387 15.4123 8.67191 15.7543 8.74387 16.0851L9.15897 17.8848C9.1811 17.9801 9.26412 18.0474 9.36375 18.0474L11.1902 18.025C11.5223 18.0194 11.8322 17.868 12.0425 17.5989ZM14.5997 17.0384H17.5779C17.8685 17.0384 18.1048 17.2778 18.1048 17.5722C18.1048 17.8671 17.8685 18.106 17.5779 18.106H14.5997C14.3092 18.106 14.0728 17.8671 14.0728 17.5722C14.0728 17.2778 14.3092 17.0384 14.5997 17.0384Z" fill="white" />
                            </svg>
                        </button>
                        <button id="updateEvent" class=" hidden float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($estimate))
@if ($estimate->schedule_assigned == 1)
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="schedule-work-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/setScheduleWork" id="schedule-work-form">
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
                            <p class=" font-medium items-center">Who will complete work?</p>
                            <select name="assign_work" id="assign_work" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                    <div class="flex justify-start gap-3 mb-2">
                        <label for="start_date">Start date:</label>
                        <input type="datetime-local" name="start_date" id="start_date" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="flex justify-start gap-3 mb-2">
                        <label for="end_date">End date:</label>
                        <input type="datetime-local" name="end_date" id="end_date" autocomplete="given-name" class="se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
@else
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
                            <select name="assign_estimate_completion" id="assign_estimate_completion" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
@endif
    <style>
        .crew-rating-container {
            display: flex;
        }
    </style>

    @include('layouts.footer')
    <script>
    $(document).ready(function() {
        let currentDate = new Date();

        function generateWeek(currentDate, crewsData) {
            const tableBody = $('#table-body');
            tableBody.empty();

            const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const headerCells = $('th');

            // Calculate the start date of the week (Monday)
            const startDate = new Date(currentDate);
            const diff = startDate.getDay() - 1; // Get the difference in days from Monday
            startDate.setDate(startDate.getDate() - diff); // Set the start date to Monday

            // Extract month and year from the start date
            const monthYearString = startDate.toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });

            // Set the month and year in the first header cell
            $(headerCells[0]).text(monthYearString);

            // Loop through each crew
            crewsData.forEach(crew => {
                // Create a single row for each crew
                const row = $('<tr></tr>');

                // Create a crew cell for crew name and image
                const crewCell = $('<td></td>');

                // Create a container for crew image and name
                const crewContainer = $('<div class="crew-container"></div>');

                // Create image element for the crew
                const crewImage = $('<img class="crew-image">');
                crewImage.attr('src', crew.image ? "{{ asset('') }}" + crew.image : "{{ asset('assets/images/demo-user.svg') }}");
                crewImage.attr('alt', crew.name);

                // Create a span for crew name
                const crewNameSpan = $('<span class="crew-name"></span>');
                crewNameSpan.text(crew.name + ' ');

                // Append image and name elements to the container
                crewContainer.append(crewImage);
                crewContainer.append(crewNameSpan);

                // Append the container to the crew cell
                crewCell.append(crewContainer);

                // Append the crew cell to the row
                row.append(crewCell);

                // Create a container for crew rating stars
                const crewRatingContainer = $('<div class="crew-rating-container"></div>');

                // Check if crew has a rating
                if (crew.rating) {
                    // Create rating star images based on the crew's rating
                    for (let i = 0; i < crew.rating; i++) {
                        const ratingStar = $('<img class="rating-star">');
                        ratingStar.attr('src', "{{ asset('assets/icons/rating-star.svg') }}");
                        ratingStar.attr('alt', 'rating-star');
                        crewRatingContainer.append(ratingStar);
                    }
                }

                // Append the rating stars container to the crew container
                crewContainer.append(crewRatingContainer);

                // Loop through each day of the week
                for (let i = 0; i < 7; i++) {
                    const loopDate = new Date(startDate);
                    loopDate.setDate(startDate.getDate() + i);
                    const day = daysOfWeek[loopDate.getDay()];
                    const date = loopDate.getDate();
                    const month = loopDate.toLocaleString('default', {
                        month: 'short'
                    });

                    $(headerCells[i + 1]).text(day + ' ' + date + ' ' + month);

                    // Check if any estimates fall within the current day and crew
                    const badges = [];

                    crew.estimates.forEach(estimate => {
                        const estimateStartDate = new Date(estimate.start_date);
                        const estimateEndDate = new Date(estimate.end_date);

                        if (
                            loopDate.getTime() >= estimateStartDate.getTime() &&
                            loopDate.getTime() <= estimateEndDate.getTime() + (24 * 60 * 60 * 1000) // Add one day to include the end date
                        ) {
                            // Create a clickable badge
                            const badge = $('<button class="badge"></button>');
                            badge.text(estimate.estimate.customer_name + (estimate.estimate.project_name ? ' (' + estimate.estimate.project_name + ')' : ''));
                            badge.attr('id', 'viewEstimate' + estimate.estimate_id);
                            badges.push(badge);
                        }
                    });

                    // Create a cell for each day
                    const cell = $('<td></td>');

                    // If badges exist for the current day, append them to the cell
                    if (badges.length > 0) {
                        badges.forEach(badge => {
                            cell.append(badge);
                        });
                    }

                    // Append the cell to the row
                    row.append(cell);
                }

                // Append the row to the table body
                tableBody.append(row);
            });
        }


        // Data retrieved from the Laravel backend
        const estimates = {!!json_encode($estimates) !!};
        const crewData = {!!json_encode($crew) !!};

        // Transform data to match the structure expected by generateWeek function
        const crewsData = crewData.map(crew => ({
            name: crew.name + ' ' + crew.last_name,
            image: crew.user_image,
            rating: crew.rating,
            estimates: estimates.filter(estimate => estimate.work_assign_id == crew.id)
        }));

        // Usage:
        generateWeek(currentDate, crewsData);

        $('#nextBtn').click(function() {
            currentDate.setDate(currentDate.getDate() + 7);
            generateWeek(currentDate, crewsData);
        });

        $('#prevBtn').click(function() {
            currentDate.setDate(currentDate.getDate() - 7);
            generateWeek(currentDate, crewsData);
        });

        $(".modal-close").click(function(e) {
            e.preventDefault();
            $("#view-customerDetails").addClass('hidden');
            // $("#complete-estimate-form")[0].reset()
            $('#start_date').toggleClass('hidden');
            $('#end_date').toggleClass('hidden');
            $('#startDate').toggleClass('hidden');
            $('#fendDate').toggleClass('hidden');
            $('#editEvent').toggleClass('hidden');
            $('#updateEvent').toggleClass('hidden');
        });

        // Event delegation for dynamic elements
        $('#table-body').on('click', '[id^="viewEstimate"]', function(event) {
            var itemId = $(this).attr('id').replace('viewEstimate', ''); // Extract item ID from button ID
            // Your AJAX request and modal manipulation code here...
            // Make an AJAX request to get item details
            $.ajax({
                url: '/viewDataOnCrewCalendar' + itemId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Populate the modal with the retrieved data
                        var estimate = response.estimate;
                        var estimateSchedule = response.estimateSchedule;
                        var crew = response.crew;
                        console.log(estimate);
                        // Update modal content with item details
                        $('#modal-title').text(estimate.customer_name + ' ' + estimate.customer_last_name);
                        $('#customer_address').text(estimate.customer_address);
                        $('#customer_email').text(estimate.customer_email);
                        $('#customer_phone').text(estimate.customer_phone);
                        $('#start_date').text(estimateSchedule.start_date);
                        $('#end_date').text(estimateSchedule.end_date);
                        $('#note').text(estimateSchedule.note);
                        $('#estimate_id').val(estimateSchedule.estimate_id);
                        // $('#date').val(formatDate(expenseDetail.expense_date));

                        // Open the modal
                        $('#view-customerDetails').removeClass('hidden');
                    } else {
                        // Handle error response
                        console.error('Error fetching item details.');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });

        $("#editEvent").click(function(e) {
            e.preventDefault();
            $('#start_date').toggleClass('hidden');
            $('#end_date').toggleClass('hidden');
            $('#startDate').toggleClass('hidden');
            $('#fendDate').toggleClass('hidden');
            $('#editEvent').toggleClass('hidden');
            $('#updateEvent').toggleClass('hidden');
        });
    });
</script>
    <script>
        $(".modal-close").click(function(e) {
            e.preventDefault();
            $("#view-customerDetails").addClass('hidden');
            // $("#complete-estimate-form")[0].reset()
            $('#start_date').toggleClass('hidden');
            $('#end_date').toggleClass('hidden');
            $('#startDate').toggleClass('hidden');
            $('#fendDate').toggleClass('hidden');
            $('#editEvent').toggleClass('hidden');
            $('#updateEvent').toggleClass('hidden');
        });

        // Event delegation for dynamic elements
        document.getElementById('table-body').addEventListener('click', function(event) {
            if (event.target && event.target.matches('[id^="viewEstimate"]')) {
                var itemId = event.target.id.replace('viewEstimate', ''); // Extract item ID from button ID
                // Your AJAX request and modal manipulation code here...
                // Make an AJAX request to get item details
                $.ajax({
                    url: '/viewDataOnCrewCalendar' + itemId,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Populate the modal with the retrieved data
                            var estimate = response.estimate;
                            var estimateSchedule = response.estimateSchedule;
                            var crew = response.crew;
                            console.log(estimate);
                            // Update modal content with item details
                            $('#modal-title').text(estimate.customer_name + ' ' + estimate.customer_last_name);
                            $('#customer_address').text(estimate.customer_address);
                            $('#customer_email').text(estimate.customer_email);
                            $('#customer_phone').text(estimate.customer_phone);
                            $('#start_date').text(estimateSchedule.start_date);
                            $('#end_date').text(estimateSchedule.end_date);
                            $('#note').text(estimateSchedule.note);
                            $('#estimate_id').val(estimateSchedule.estimate_id);
                            // $('#date').val(formatDate(expenseDetail.expense_date));

                            // Open the modal
                            $('#view-customerDetails').removeClass('hidden');
                        } else {
                            // Handle error response
                            console.error('Error fetching item details.');
                        }
                    },
                    error: function(error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            }
        });

        $("#editEvent").click(function(e) {
            e.preventDefault();
            $('#start_date').toggleClass('hidden');
            $('#end_date').toggleClass('hidden');
            $('#startDate').toggleClass('hidden');
            $('#fendDate').toggleClass('hidden');
            $('#editEvent').toggleClass('hidden');
            $('#updateEvent').toggleClass('hidden');
        });
    </script>
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