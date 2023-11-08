@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Estimates List</h4>
            </div>
            <div>
                <a href="{{url('add-estimate')}}">
                    <x-add-button :title="'+Add Estimates'" :class="''" :id="''"></x-add-button>
                </a>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
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
                        <tr>
                            <td>Sep 23, 2023</td>
                            <td>Client Name</td>
                            <td>123 456 789</td>
                            <td>Town, City, Country</td>
                            <td>user name</td>
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                            </td>
                            <td>
                                <div class=" flex justify-evenly gap-3">
                                    <div class=" my-auto">
                                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="estimateDetails" aria-expanded="true" aria-haspopup="true">
                                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                        </button>
                                    </div>
                                    <div class=" my-auto">
                                        <a href="/estimates/new">
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