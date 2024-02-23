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
    align-items: center; /* Align items vertically */
}

.crew-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    margin-left: 50px;
    object-fit: cover;
}
.crew-name{
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
            <div class=" py-4">
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
<style>
    .crew-rating-container {
        display: flex;
    }
</style>

<script>
    let currentDate = new Date();

    function generateWeek(startDate, crewsData) {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = '';

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const headerCells = document.getElementsByTagName('th');

        // Loop through each crew
        crewsData.forEach(crew => {
            // Create a single row for each crew
            const row = document.createElement('tr');

            // Create a crew cell for crew name and image
            const crewCell = document.createElement('td');

            // Create a container for crew image and name
            const crewContainer = document.createElement('div');
            crewContainer.classList.add('crew-container');

            // Create image element for the crew
            const crewImage = document.createElement('img');
            // Check if crew has an image, if not, set default image path
            crewImage.src = crew.image ? "{{ asset('') }}" + crew.image : "{{ asset('assets/images/demo-user.svg') }}";
            crewImage.alt = crew.name;
            crewImage.classList.add('crew-image');

            // Create a span for crew name
            const crewNameSpan = document.createElement('span');
            crewNameSpan.textContent = crew.name + ' ';
            crewNameSpan.classList.add('crew-name');

            // Append image and name elements to the container
            crewContainer.appendChild(crewImage);
            crewContainer.appendChild(crewNameSpan);

            // Append the container to the crew cell
            crewCell.appendChild(crewContainer);

            // Append the crew cell to the row
            row.appendChild(crewCell);

            // Create a container for crew rating stars
            const crewRatingContainer = document.createElement('div');
            crewRatingContainer.classList.add('crew-rating-container');

            // Check if crew has a rating
            if (crew.rating) {
                // Create rating star images based on the crew's rating
                for (let i = 0; i < crew.rating; i++) {
                    const ratingStar = document.createElement('img');
                    ratingStar.src = "{{ asset('assets/icons/rating-star.svg') }}"; // Path to rating star image
                    ratingStar.alt = 'rating-star';
                    ratingStar.classList.add('rating-star');
                    crewRatingContainer.appendChild(ratingStar);
                }
            }

            // Append the rating stars container to the crew container
            crewContainer.appendChild(crewRatingContainer);

            // Loop through each day of the week
            for (let i = 0; i < 7; i++) {
                const loopDate = new Date(startDate);
                loopDate.setDate(startDate.getDate() + i);
                const day = daysOfWeek[loopDate.getDay()];
                const date = loopDate.getDate();

                headerCells[i + 1].textContent = day + ' ' + date;

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
                        const badge = document.createElement('button');
                        badge.className = 'badge';
                        badge.textContent = estimate.estimate.customer_name + (estimate.estimate.project_name ? ' (' + estimate.estimate.project_name + ')' : '');
                        // badge.href = '/viewEstimate/' + estimate.estimate_id; // Set the URL here
                        badge.id = 'viewEstimate' + estimate.estimate_id;
                        badges.push(badge);
                    }
                });

                // Create a cell for each day
                const cell = document.createElement('td');

                // If badges exist for the current day, append them to the cell
                if (badges.length > 0) {
                    badges.forEach(badge => {
                        cell.appendChild(badge);
                    });
                }

                // Append the cell to the row
                row.appendChild(cell);
            }

            // Append the row to the table body
            tableBody.appendChild(row);
        });
    }

    // Data retrieved from the Laravel backend
    const estimates = {!! json_encode($estimates) !!};
    const crewData = {!! json_encode($crew) !!};

    // Transform data to match the structure expected by generateWeek function
    const crewsData = crewData.map(crew => ({
        name: crew.name + ' ' + crew.last_name,
        image: crew.user_image,
        rating: crew.rating,
        estimates: estimates.filter(estimate => estimate.work_assign_id === crew.id)
    }));

    // Usage:
    generateWeek(currentDate, crewsData);

    document.getElementById('nextBtn').addEventListener('click', function() {
        currentDate.setDate(currentDate.getDate() + 7);
        generateWeek(currentDate, crewsData);
    });

    document.getElementById('prevBtn').addEventListener('click', function() {
        currentDate.setDate(currentDate.getDate() - 7);
        generateWeek(currentDate, crewsData);
    });
</script>
@include('layouts.footer')
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

    $("#editEvent").click(function (e) {
        e.preventDefault();
        $('#start_date').toggleClass('hidden');
        $('#end_date').toggleClass('hidden');
        $('#startDate').toggleClass('hidden');
        $('#fendDate').toggleClass('hidden');
        $('#editEvent').toggleClass('hidden');
        $('#updateEvent').toggleClass('hidden');
    });
</script>
