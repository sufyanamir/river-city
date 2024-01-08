@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Jobs</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Jobs List</h4>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>work start date</th>
                            <th>work end date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class="text-sm">
                        @foreach ($schedule_estimates_with_estimates as $item)
                            <tr>
                                <td>{{ $item['estimate']->created_at }}</td>
                                <td>{{ $item['estimate']->customer_name }} {{ $item['estimate']->customer_last_name }}
                                </td>
                                <td>{{ $item['estimate']->customer_phone }}</td>
                                <td>{{ $item['estimate']->customer_address }}</td>
                                @if ($item['estimate']->estimate_status == 'pending')
                                    <td>
                                        <span
                                            class="bg-gray-100 text-gray-800 text-sm font-medium px-2 py-1 rounded ring-1 ring-inset ring-gray-600/20">Pending</span>
                                    </td>
                                @elseif($item['estimate']->estimate_status == 'complete')
                                    <td>
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                                    </td>
                                @elseif($item['estimate']->estimate_status == 'cancel')
                                    <td>
                                        <span
                                            class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">Cancel</span>
                                    </td>
                                @endif
                                {{-- <td>
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                                </td> --}}
                                <td>{{ $item['schedule_estimate']->start_date }}</td>
                                <td>{{ $item['schedule_estimate']->end_date }}</td>
                                <td>
                                    <div class="flex">
                                        <div class=" inline-block">
                                            <button class="px-2 py-2 chat-btn"
                                                data-target="#chat-modal{{ $item['estimate']->estimate_id }}"
                                                data-estimate-id="{{ $item['estimate']->estimate_id }}">
                                                <img class="w-9"
                                                    src="{{ asset('assets/icons/dropdown-activity-icon.svg') }}"
                                                    alt="icon">
                                            </button>
                                            <!-- chat  modal -->
                                            <div class="fixed z-10 inset-0 overflow-y-auto hidden"
                                                id="chat-modal{{ $item['estimate']->estimate_id }}">
                                                <div
                                                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <!-- Background overlay -->
                                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                                    </div>

                                                    <!-- Modal panel -->
                                                    <div
                                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <!-- Modal content here -->
                                                            <div class=" flex justify-between">
                                                                <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] "
                                                                    id="modal-title">Project Chat</h2>
                                                                <button class="modal-close" type="button">
                                                                    <img src="{{ asset('assets/icons/close-icon.svg') }}"
                                                                        alt="icon">
                                                                </button>
                                                            </div>
                                                            <!-- task details -->
                                                            {{-- <div class=" py-2">
                                                            <label for="underline_select" class="sr-only">Underline
                                                                select</label>
                                                            <select id="underline_select"
                                                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                                <option selected>Mention</option>
                                                                <option value="US">David</option>
                                                                <option value="CA">Tony</option>
                                                                <option value="FR">Jordi</option>
                                                                <option value="DE">Albert</option>
                                                            </select>
                                                        </div> --}}
                                                            <div class=" pb-2">
                                                                <div
                                                                    class=" border rounded-lg h-40 w-full overflow-auto">
                                                                    <div class=" m-2" id="chat-dialog">
                                                                        <div class="pb-2 chat-messages-container">
                                                                            <!-- Chat messages will be dynamically inserted here -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class=" pb-2">
                                                                <form method="POST" action="/sendChat" id="chat-form">
                                                                    @csrf
                                                                    <input type="hidden" name="estimate_id"
                                                                        value="{{ $item['estimate']->estimate_id }}">
                                                                    <label for="chat" class="sr-only">Your
                                                                        message</label>
                                                                    <div
                                                                        class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                                                                        <button type="button" onclick="openFileMenu()"
                                                                            class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                                                            <input type="file" class="hidden"
                                                                                id="fileInput">
                                                                            <svg class="w-5 h-5" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 20 18">
                                                                                <path fill="currentColor"
                                                                                    d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                                                            </svg>
                                                                            <span class="sr-only">Upload
                                                                                image</span>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                                                            <svg class="w-5 h-5" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 20 20">
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                                                                            </svg>
                                                                            <span class="sr-only">Add emoji</span>
                                                                        </button>
                                                                        <textarea id="message" name="chat_message" rows="1"
                                                                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                                            placeholder="Your message..."></textarea>
                                                                        <button
                                                                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                                                            <svg class="w-5 h-5 rotate-90 rtl:-rotate-90"
                                                                                aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor" viewBox="0 0 18 20">
                                                                                <path
                                                                                    d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                                                                            </svg>
                                                                            <span class="sr-only">Send
                                                                                message</span>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class=" flex justify-between">
                                                                <button type="button" id="updateEvent"
                                                                    class="modal-close mb-2 py-1 px-7 rounded-md border">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" inline-block">
                                            <a href="/makeProposal/{{ $item['schedule_estimate']->estimate_id }}">
                                                <div class="inline-block items-center align-middle" id="">
                                                    <button class=" p-2">
                                                        <img class="w-9" src="{{ asset('assets/icons/view-icon.svg') }}"
                                                            alt="icon">
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="estimateDetails-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="estimateDetails-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Coyne Development
                            Corp
                            - Steve</h2>
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
                        <img class=" inline-block" src="{{ asset('assets/icons/phone-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">949-30 0-9632 c</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/estimate-sm-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">Tom D Assigned To Schedule Estimate On <span
                                class=" text-[#31A613]">April 24th, 2019</span></p>
                    </div>
                    <div class=" my-2 text-left">
                        <h3 class=" text-lg font-medium">Items</h3>
                    </div>
                    <div class=" mb-3 border-b-2">
                        <div class=" flex justify-start gap-2">
                            <button type="button" class=" groupDetails">
                                <img src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                            </button>
                            <div>
                                <h3 class=" font-medium text-lg">Item Name</h3>
                                <p>Description about Item</p>
                            </div>
                            <div class=" pl-48 pt-2">
                                <input type="checkbox" name="Edit" id="privilegeUserEdit">
                                <label for="privilegeUserEdit" class=" text-gray-500"></label>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-3 border-b-2">
                        <div class=" flex justify-start gap-2">
                            <button type="button" class=" groupDetails">
                                <img src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                            </button>
                            <div>
                                <h3 class=" font-medium text-lg">Item Name</h3>
                                <p>Description about Item</p>
                            </div>
                            <div class=" pl-48 pt-2">
                                <input type="checkbox" name="Edit" id="privilegeUserEdit1">
                                <label for="privilegeUserEdit1" class=" text-gray-500"></label>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between">
                        <button id="" class=" modal-close mb-2 py-1 px-7 rounded-md border">Cancel
                        </button>
                        <button id="updateEvent"
                            class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#estimateDetails").click(function(e) {
        e.preventDefault();
        $("#estimateDetails-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#estimateDetails-modal").addClass('hidden');
        $("#estimateDetails-form")[0].reset()
    });
</script>
<script>
    $(document).ready(function() {
        $('.chat-btn').on('click', function() {
            var targetModalId = $(this).data('target');
            var estimateId = $(this).data('estimate-id');

            // Make an AJAX request to fetch chat messages
            $.ajax({
                url: '/estimates/getChatMessage/' +
                estimateId, // Adjust the URL based on your route
                type: 'GET',
                success: function(response) {
                    // Check if the request was successful
                    if (response.success) {
                        // Update the modal content with the retrieved chat messages
                        console.log(response.html);
                        $(targetModalId + ' .chat-messages-container').html(response.html);
                    } else {
                        // Handle error, display a message, etc.
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error(error);
                }
            });

            // Show the modal with the corresponding ID
            $(targetModalId).removeClass('hidden');
        });
    });
</script>
<script>
    function openFileMenu() {
        // Trigger click event on the file input element
        document.getElementById('fileInput').click();
    }
</script>
