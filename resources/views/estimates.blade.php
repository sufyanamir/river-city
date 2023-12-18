@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Estimates List</h4>
            </div>
            <div>
                @if($user_details['user_role'] == 'admin')
                <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                @endif
                @if(isset($userPrivileges->estimate) && $userPrivileges->estimate->add === "on")
                <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                @endif
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
                            <th>Edit By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        @foreach($estimates as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $item->customer_phone }}</td>
                            <td>{{ $item->customer_address }}</td>
                            <td>{{ $item->edited_by }}</td>
                            @if($item->estimate_status == 'pending')
                            <td>
                                <span class="bg-gray-100 text-gray-800 text-sm font-medium px-2 py-1 rounded ring-1 ring-inset ring-gray-600/20">Pending</span>
                            </td>
                            @elseif($item->estimate_status == 'complete')
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                            </td>
                            @elseif($item->estimate_status == 'cancel')
                            <td>
                                <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">Cancel</span>
                            </td>
                            @endif
                            <td>
                                <div class=" flex justify-evenly gap-2">
                                    <div class=" my-auto">
                                        <button class=" px-2 py-2" id="chat-btn">
                                            <img class="  w-9" src="{{ asset('assets/icons/dropdown-activity-icon.svg') }}" alt="icon">
                                        </button>
                                    </div>
                                    <div class=" my-auto">
                                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="estimateDetails" aria-expanded="true" aria-haspopup="true">
                                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                        </button>
                                    </div>
                                    <div class=" my-auto">
                                        <a href="/viewEstimate/{{ $item->customer_id }}">
                                            <button class=" px-2 py-2">
                                                <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                            </button>
                                        </a>
                                    </div>
                                    <div class=" my-auto">
                                        <x-action-dropdown></x-action-dropdown>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="estimateDetails-form">
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
                        <img class=" inline-block" src="{{ asset('assets/icons/phone-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">949-30 0-9632 c</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/estimate-sm-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">Tom D Assigned To Schedule Estimate On <span class=" text-[#31A613]">April 24th, 2019</span></p>
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
                        </div>
                    </div>
                    <div class=" flex justify-between">
                        <button id="updateEvent" class=" mb-2 py-1 px-7 rounded-md border">Cancel
                        </button>
                        <button id="updateEvent" class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="groupDetails-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="groupDetails-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Group Details</h2>
                        <button class="groupDetails-modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-lg font-medium">
                        <h3>Group demo name</h3>
                    </div>
                    <div class=" my-2">
                        <img class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}" alt="icon">
                        <input type="number" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water St, Newburyport, MA, 01950</p>
                    </div>
                    <div class=" my-2">
                        <img class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}" alt="icon">
                        <input type="number" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water St, Newburyport, MA, 01950</p>
                    </div>
                    <div class=" my-2">
                        <img class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}" alt="icon">
                        <input type="number" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water St, Newburyport, MA, 01950</p>
                    </div>
                    <div class="my-2">
                        <textarea name="" id="" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                    </div>
                    <div class="my-2">
                        <textarea name="" id="" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                    </div>
                    <div class=" flex justify-between">
                        <button id="updateEvent" class=" mb-2 py-1 px-7 rounded-md border">Cancel
                        </button>
                        <button id="updateEvent" class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- chat  modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="chat-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <form action="" id="chat-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Project Chat</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" py-2">
                        <label for="underline_select" class="sr-only">Underline select</label>
                        <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option selected>Mention</option>
                            <option value="US">David</option>
                            <option value="CA">Tony</option>
                            <option value="FR">Jordi</option>
                            <option value="DE">Albert</option>
                        </select>
                    </div>
                    <div class=" pb-2">
                        <div class=" border rounded-lg h-40 w-full overflow-auto">
                            <div class=" m-2">
                                <div>
                                    <div class=" text-right">
                                        <span class=" text-sm">11/17/2023, 6:20:12</span>
                                    </div>
                                    <div class=" flex justify-start gap-2">
                                        <h6 class=" font-medium text-red-500">David: </h6>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <div>
                                    <div class=" text-right">
                                        <span class=" text-sm">11/17/2023, 6:20:12</span>
                                    </div>
                                    <div class=" flex justify-start gap-2">
                                        <h6 class=" font-medium text-pink-500">Tony: </h6>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                                <div>
                                    <div class=" text-right">
                                        <span class=" text-sm">11/17/2023, 6:20:12</span>
                                    </div>
                                    <div class=" flex justify-start gap-2">
                                        <h6 class=" font-medium text-green-500">You: </h6>
                                        <p>Lorem ipsum dolor sit amet</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" pb-2">
                        <form>
                            <label for="chat" class="sr-only">Your message</label>
                            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                                <button type="button" onclick="openFileMenu()" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                    <input type="file" class="hidden" id="fileInput">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                    </svg>
                                    <span class="sr-only">Upload image</span>
                                </button>
                                <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                                    </svg>
                                    <span class="sr-only">Add emoji</span>
                                </button>
                                <textarea id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                                    </svg>
                                    <span class="sr-only">Send message</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class=" flex justify-between">
                        <button id="updateEvent" class=" mb-2 py-1 px-7 rounded-md border">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- chat  modal -->
<!-- add estimate -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEstimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <form action="" id="addEstimate-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Add Estimate</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->

                </div>
            </form>
        </div>
    </div>
</div>
<!-- add estimate -->

@include('layouts.footer')
<script>
    function openFileMenu() {
        // Trigger click event on the file input element
        document.getElementById('fileInput').click();
    }
</script>
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
    $(".groupDetails").click(function(e) {
        e.preventDefault();
        $("#groupDetails-modal").removeClass('hidden');
    });

    $(".groupDetails-modal-close").click(function(e) {
        e.preventDefault();
        $("#groupDetails-modal").addClass('hidden');
        $("#groupDetails-form")[0].reset()
    });
</script>
<script>
    $("#chat-btn").click(function(e) {
        e.preventDefault();
        $("#chat-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#chat-modal").addClass('hidden');
        $("#chat-form")[0].reset()
    });
</script>
<script>
    $("#addEstimate").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
    });
</script>