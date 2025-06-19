@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Items List</h4>
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
                                @elseif($item['estimate']->estimate_status == 'paid')
                                    <td>
                                        <span
                                            class="bg-green-100 text-green-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-green-600/20 ">Paid</span>
                                    </td>
                                @endif
                                {{-- <td>
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                                </td> --}}
                                <td>{{ $item['schedule_estimate']->start_date }}</td>
                                <td>{{ $item['schedule_estimate']->end_date }}</td>
                                <td>
                                    <div class="flex justify-between">
                                        <div class=" inline-block">
                                        <a href="/estimates/getChatMessage/{{$item['estimate']->estimate_id}}">
                                            <button type="button"
                                                class="inline-flex w-full text-white justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold shadow-sm hover:bg-[#930017]">
                                                <i class="fa-brands fa-rocketchat"></i>
                                            </button>
                                        </a>
                                        </div>
                                        <div class=" inline-block">
                                            <a href="/viewEstimateMaterials/{{ $item['schedule_estimate']->estimate_id }}">
                                                <div class="inline-block items-center align-middle" id="">
                                                    <button class="">
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

