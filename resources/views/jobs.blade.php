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
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
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
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                            </td>
                            <td>
                                <div class=" inline-block items-center align-middle" id="estimateDetails">
                                    <button>
                                        <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                    </button>
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