@include('layouts.header')

<style>
input[type=checkbox]+label:before{
    background: white;
}
</style>

@php
$userPrivileges = session('user_details')['user_privileges'];
$userRole = session('user_details')['user_role'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex flex-col sm:flex-col md:flex-row lg:flex-row justify-between items-center p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold mb-3 sm:mb-3 md:mb-0 lg:mb-0">
                <h4>Estimates List</h4>
            </div>
            <div class="">
                <div class=" inline-block mb-2 sm:mb-2 md:mb-0 lg:mb-0">
                    <select id="branch-filter" class="inline-block rounded-lg bg-[#930027] text-white px-3 py-1.5 text-sm font-semibold shadow-sm hover:bg-[#930017] mr-1">
                        <option value="">All Branches</option>
                        @foreach($branches as $branch)
                        <option value="{{ strtolower($branch->branch_name) }}" {{ request('branch') == strtolower($branch->branch_name) ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="javascript:void(0)" class="pending-filter"><x-add-button :title="'Pending'" :class="''" :id="''"></x-add-button></a>
                <a href="javascript:void(0)" class="complete-filter"><x-add-button :title="'Completed'" :class="''" :id="''"></x-add-button></a>
                <a href="javascript:void(0)" class="paid-filter"><x-add-button :title="'Paid'" :class="''" :id="''"></x-add-button></a>
                <a href="javascript:void(0)" class="cancel-filter"><x-add-button :title="'Cancel'" :class="''" :id="''"></x-add-button></a>
                @if($userRole == 'scheduler')
                <a href="javascript:void(0)" class="view-all-filter"><x-add-button :title="'View All'" :class="''" :id="''"></x-add-button></a>
                <a href="javascript:void(0)" class="view-assigned-filter"><x-add-button :title="'View Assigned'" :class="''" :id="''"></x-add-button></a>
                @endif
                @if ($userRole == 'admin')
                <x-add-button :title="'+ Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                @endif
                @if (isset($userPrivileges->estimate) && isset($userPrivileges->estimate->add) && $userPrivileges->estimate->add === 'on')
                <x-add-button :title="'+ Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                @endif
            </div>
        </div>
        <div class="py-4 overflow-x-auto">
            <div class="">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone Number/Address</th>
                            <th>Branch</th>
                            <th>Type</th>
                            <th>Schedular Assigned</th>
                            <th>Crew Leader</th>
                            <th>Total/Paid</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" universalTableBody text-sm">
                        @foreach ($estimates as $item)
                        <tr>
                            <td>{{$item->estimate_id}}</td>
                            <td>{{ date('m/d/y', strtotime($item->created_at)) }}</td>
                            <td>
                                <a href="/viewCustomerDetails/{{ $item->customer_id }}" class=" text-[#930027] hover:border-b hover:border-[#930027]">
                                    {{ ucwords($item->customer_name) }} {{ ucwords($item->customer_last_name) }} {{ isset($item->customer->customer_company_name) ? '('.$item->customer->customer_company_name.')' : '' }}
                                </a>
                            </td>
                            <td style=" width:50px;">
                                {{ $item->customer_phone }}
                                <br>
                                <a href="https://maps.google.com/?q={{ $item->customer_address }} "
                                target="_blank" class="text-[#930027]">
                                    {{ $item->customer_address }}
                                </a>
                            </td>
                            <td style=" width:50px;">
                                {{ ucfirst($item->customer?->branch) }}
                            </td>
                            <td>
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($item->project_type)
                                <p class="font-medium">Project Type:</p>
                                {{ ucwords($item->project_type) }}
                                @endif
                                @if ($item->building_type)
                                <p class="font-medium">Building Type:</p>
                                {{ ucwords($item->building_type) }}
                                @endif
                                </p>
                            </td>
                            <td>
                                @if($item->schedulers && $item->schedulers->count())
                                    @foreach($item->schedulers as $scheduler)
                                        {{ $scheduler->name . ' ' . $scheduler->last_name }}, <br>
                                    @endforeach
                                @else
                                    Not Assigned
                                @endif
                            </td>
                            <td>{{ $item->crew ? $item->crew->name . ' ' . $item->crew->last_name : 'Not Assigned' }}</td>
                            <td>
                                ${{number_format($item->estimate_total, 2)}}/${{number_format($item->invoice_paid_total, 2)}}
                            </td>
                            @if ($item->estimate_status == 'pending')
                            <td>
                                <span class="bg-gray-100 text-gray-800 text-sm font-medium px-2 py-1 rounded ring-1 ring-inset ring-gray-600/20">Pending</span>
                            </td>
                            @elseif($item->estimate_status == 'complete')
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Complete</span>
                            </td>
                            @elseif($item->estimate_status == 'paid')
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Paid</span>
                            </td>
                            @elseif($item->estimate_status == 'cancel')
                            <td>
                                <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">Canceled</span>
                            </td>
                            @endif
                            <td>
                                <div class=" flex justify-evenly gap-2">
                                    <div class=" my-auto">
                                        <a href="/estimates/getChatMessage/{{$item->estimate_id}}">
                                            <button id="" class="inline-flex w-full text-white justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold shadow-sm hover:bg-[#930017]" data-target="#chat-modal{{ $item->estimate_id }}" data-estimate-id="{{ $item->estimate_id }}">
                                                <i class="fa-brands fa-rocketchat"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <!-- <div class=" my-auto">
                                        <button type="button"
                                        class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                                        id="estimateDetails" aria-expanded="true" aria-haspopup="true">
                                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                            </button>
                                        </div> -->
                                    <!-- {{-- <div class=" my-auto">
                                        <a href="/viewEstimate/{{ $item->customer_id }}">
                                    <button class=" px-2 py-2">
                                        <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                    </button>
                                    </a>
                                </div> --}} -->
                                    <div class=" my-auto">
                                        <div class="relative inline-block text-left">
                                            <div>
                                                <button type="button" class=" inline-flex w-full text-white justify-center gap-x-1.5 rounded-md bg-[#930027] px-2 py-2 text-sm font-semibol shadow-sm hover:bg-[#930017]" id="action-menubutton{{ $item->estimate_id }}" aria-expanded="true" aria-haspopup="true">
                                                    Options
                                                    <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div id="action-menu{{ $item->estimate_id }}" class=" topbar-manuLeaving absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1" role="none">
                                                    <span id="viewEstimate-info{{$item->estimate_id}}" class=" px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-view-icon.svg') }}" alt="icon"> View</span>
                                                    <a href="/viewEstimate/{{ $item->estimate_id }}" class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-edit-icon.svg') }}" alt="icon"> Edit</a>
                                                    <a href="/viewEstimateMaterials/{{ $item->estimate_id }}" class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-report-icon.svg') }}" alt="icon"> Work Order</a>
                                                    <a href="{{'/viewProposal?estimateId=' . $item->estimate_id}}" class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-activity-icon.svg') }}" alt="icon"> Estimate</a>
                                                    <a href="/getEstimateActivity/{{ $item->estimate_id }}" class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-activity-icon.svg') }}" alt="icon"> Activity</a>
                                                    <a href="/viewGallery{{ $item->estimate_id }}" class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-gallery-icon.svg') }}" alt="icon"> Gallery</a>
                                                    <form action="/cancelEstimate/{{$item->estimate_id}}" method="post">
                                                        @csrf
                                                        <button class=" w-full">
                                                            <p class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-cross-icon.svg') }}" alt="icon"> Cancel</p>
                                                        </button>
                                                    </form>
                                                    <form action="/deleteEstimate/{{$item->estimate_id}}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class=" w-full">
                                                            <p class="  px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-del-icon.svg') }}" alt="icon"> Delete</p>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var menubutton = document.getElementById('action-menubutton{{ $item->estimate_id }}');
                                var menu = document.getElementById('action-menu{{ $item->estimate_id }}');

                                menubutton.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    menu.classList.toggle('topbar-menuEntring');
                                    menu.classList.toggle('topbar-manuLeaving');
                                });

                                document.addEventListener('click', function(e) {
                                    if (!menubutton.contains(e.target) && !menu.contains(e.target)) {
                                        menu.classList.add('topbar-manuLeaving');
                                        menu.classList.remove('topbar-menuEntring');
                                    }
                                });
                            });
                        </script>
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
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Coyne Development
                            Corp - Steve</h2>
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
                        <input type="number" step="any" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water
                            St, Newburyport, MA, 01950</p>
                    </div>
                    <div class=" my-2">
                        <img class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}" alt="icon">
                        <input type="number" step="any" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water
                            St, Newburyport, MA, 01950</p>
                    </div>
                    <div class=" my-2">
                        <img class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}" alt="icon">
                        <input type="number" step="any" name="departement" id="departement" placeholder="gal" autocomplete="given-name" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <p class=" font-medium inline-block items-center bg-[#EBEAEB] py-1 px-2 rounded-lg">65 Water
                            St, Newburyport, MA, 01950</p>
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
<!-- add estimate -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="viewEstimate-info-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" flex justify-between">
                    <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Estimate Details</h2>
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <!-- task details -->
                <div class=" mb-5 bg-white text-white">
                    <div class="col-span-10  pl-2 ">
                        <div class="grid sm:grid-cols-10">
                            <div class="col-span-8 p-3">
                                <p id="invoiceCustomerName" class="text-[#F5222D] text-xl font-bold">
                                    Customer Name
                                </p>
                                <p id="invoiceProjectName" class="text-[#323C47] text-lg font-semibold">
                                    Project Name
                                </p>
                            </div>
                            <div class=" col-span-2 p-3 text-right">
                                <p class="text-lg font-bold text-[#323C47]">
                                    Estimate
                                </p>
                                <p id="invoiceEstimateDate" class="text-[#323C47]">
                                    Date
                                </p>
                            </div>
                        </div>
                        <div class=" flex justify-evenly gap-3">
                            <p id="invoiceTotal" class="mt-1 text-red-900">
                                Total: $0.00
                            </p>
                            <p id="invoiceInvoiced" class="flex justify-end text-blue-900">
                                Invoiced: $0.00
                            </p>
                            <p id="invoicePaid" class="flex justify-end text-green-900">
                                Paid: $0.00
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tax
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Due
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBody">
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Date
                                </th>
                                <td class="px-6 py-4">
                                    invoice name
                                </td>
                                <td class="px-6 py-4">
                                    tax rate
                                </td>
                                <td class="px-6 py-4">
                                    invoice total
                                </td>
                                <td class="px-6 py-4">
                                    invoice due
                                </td>
                                <td class="px-6 py-4">
                                    invoice status
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- add estimate -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEstimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg">
            <form action="/addEstimate" method="post" id="addEstimate-form">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Add Customer</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class=" flex justify-between border-b-2 mb-2 col-span-full mt-4">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Contact</h2>
                        </div>
                        <div class="col-span-full">
                            <select name="customer_id" id="customer_id" class=" mb-2 w-full outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">New Client</option>
                                @foreach ($customers as $item)
                                <option value="{{ $item->customer_id }}">{{ $item->customer_first_name }}
                                    {{ $item->customer_last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">First Name</h5>
                            <input type="text" name="first_name" id="first_name" placeholder="First Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Last Name</h5>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Email</h5>
                            <input type="text" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Phone No.</h5>
                            <input type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" autocomplete="given-name" class="mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" pattern="([0-9]{3}-?[0-9]{3}-?[0-9]{4})(/[0-9]{3}-?[0-9]{3}-?[0-9]{4})*" title="Phone number must be in the format XXX-XXX-XXXX or XXXXXXXXXX, separated by slashes" required>
                            <span class=" text-[#930027]" style="font-size:12px;">Please use "/" to add more than one number.</span>
                        </div>
                        <div class=" col-span-full ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Company Name (Optional)</h5>
                            <input type="text" name="company_name" id="company_name" placeholder="Company Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Name (Optional)</h5>
                            <input type="text" name="project_name" id="project_name" placeholder="Project Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="  ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Number (Optional)</h5>
                            <input type="text" step="any" name="project_number" id="project_number" placeholder="Project Number (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Type (Optional)</h5>
                            <input type="text" step="any" name="project_type" id="project_type" placeholder="Project Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="  ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Building Type (Optional)</h5>
                            <select name="building_type" id="building_type" placeholder="Building Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class=" flex justify-between border-b-2 mb-2 col-span-full  mt-1 mb-3">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Address</h2>
                        </div>
                        <div id="address1Div" class="col-span-full">
                            <h5 class="text-gray-600 mb-1 font-medium text-left">Address 1</h5>
                            <input type="text" name="first_address" id="first_address"
                                placeholder="Address 1"
                                class="mb-2 w-full outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset
                                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>

                        <div class=" col-span-full ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address 2 (Optional)</h5>
                            <input type="text" name="second_address" id="second_address" placeholder="Address 2 (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">City</h5>
                            <input type="text" name="city" id="city" placeholder="City" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">State/Province</h5>
                            <input type="text" name="state" id="state" placeholder="State/Province" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Zip/Postal Code</h5>
                            <input type="number" step="any" name="zip_code" id="zip_code" placeholder="Zip/Postal Code" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>

                        <!-- Checkbox -->
                        <div style="border: 2px solid #d1d5db; border-radius: 8px; padding: 12px;" class=" col-span-full">
                        <div class="flex items-center col-span-full  bg-[#930027] text-white p-2 rounded-[8px]">
                            <!-- Hidden field ensures unchecked box submits "0" -->
                            <input type="hidden" name="billing_check" value="0">
                            <input type="checkbox" name="billing_check" id="toggle-address" value="1"
                                class="w-4 h-4 text-white bg-gray-100 border-gray-300 rounded-sm focus:ring-2 focus:ring-blue-500 "
                                {{ old('billing_check', '0') == '1' ? 'checked' : '' }}>

                            <label for="toggle-address" class="ms-2 text-sm font-medium text-white">Billing Address same as Location Address</label>
                        </div>

                        <!-- Additional Inputs (in a single row) -->
                        <div id="additionalInputs" class="hidden col-span-full mt-4">
                            <div class=" col-span-full ">
                                <h5 class="text-gray-600 mb-1  font-medium text-left">Billing Address</h5>
                                <input type="text" name="billing_address" id="billing_address" placeholder="Billing Address" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div class="flex flex-wrap gap-4">
                                <div class="flex-1 min-w-[200px]">
                                    <h5 class="text-gray-600 mb-1 font-medium text-left">City</h5>
                                    <input type="text" name="billing_city" id="billing_city" placeholder="City"
                                        class="mb-2 w-full outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset
                                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <h5 class="text-gray-600 mb-1 font-medium text-left">State/Province</h5>
                                    <input type="text" name="billing_state" id="billing_state" placeholder="State/Province"
                                        class="mb-2 w-full outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset
                                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <h5 class="text-gray-600 mb-1 font-medium text-left">Zip/Postal Code</h5>
                                    <input type="number" step="any" name="billing_zip_code" id="billing_zip" placeholder="Zip/Postal Code"
                                        class="mb-2 w-full outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset
                                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                            </div>
                        </div>
                        </div>


                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Tax</h5>
                            <input type="number" step="any" name="tax_rate" id="tax_rate" placeholder="Tax Rate (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Potential Value</h5>
                            <input type="text" name="potential_value" id="potential_value" placeholder="Potential Value" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Branch</h5>
                            <select name="branch" id="branch" required autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ strtolower($branch->branch_name) }}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-span-full">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Note</h5>
                            <input type="text" name="internal_note" id="internal_note" placeholder="Internal Notes (Optional, only visible to employees)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Source (Optional)</h5>
                            <input type="text" list="sources" name="source" id="source" placeholder="Source (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <datalist id="sources">
                                <option value="Google">Google</option>
                                <option value="Website">Website</option>
                                <option value="Referral">Referral</option>
                                <option value="Returning Customer">Returning Customer</option>
                                <option value="Google LSA">Google LSA</option>
                                <option value="WEA">WEA</option>
                                <option value="Rhoden Roofing">Rhoden Roofing</option>
                                <option value="Steamatic">Steamatic</option>
                                <option value="Billboard">Billboard</option>
                                <option value="Radio">Radio</option>
                                <option value="Television">Television</option>
                            </datalist>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Owner</h5>
                            <select class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" name="owner" id="owner" required>
                                <option>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Add
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
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" flex justify-between">
                    <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Project Chat</h2>
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <div class=" pb-2">
                    <div class=" border rounded-lg h-40 w-full overflow-auto">
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
                        <input type="hidden" name="estimate_id" id="estimate_id" value="">
                        <label for="chat" class="sr-only">Your
                            message</label>
                        <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                            <button type="button" onclick="openFileMenu()" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <input type="file" class="hidden" id="fileInput">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z" />
                                </svg>
                                <span class="sr-only">Upload
                                    image</span>
                            </button>
                            <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                                </svg>
                                <span class="sr-only">Add emoji</span>
                            </button>
                            <textarea id="message" name="chat_message" rows="1" class="message block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                            <div id="userDropdown" class="userDropdown"></div>
                            <button class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                                </svg>
                                <span class="sr-only">Send
                                    message</span>
                            </button>
                        </div>
                        <input type="hidden" name="mentioned_user_ids[]" id="mentioned_user_ids">
                    </form>
                </div>
                <div class=" flex justify-between">
                    <button type="button" id="updateEvent" class=" modal-close mb-2 py-1 px-7 rounded-md border">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        // Add click event listener to all buttons with class 'chat-btn'
        $('.chat-btn').on('click', function() {
            // Get the target modal ID from the 'data-target' attribute
            var targetModalId = $("#chat-modal");

            // Show the modal with the corresponding ID
            $(targetModalId).removeClass('hidden');
        });

        // Add click event listener to close button inside the modal
        $('.modal-close').on('click', function() {
            // Close the modal
            $("#chat-modal").addClass('hidden');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.chat-btn').on('click', function() {
            var targetModalId = $("#chat-modal");
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
                        $("#estimate_id").val(estimateId);
                        $(' .chat-messages-container').html(response.html);
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
    $(document).ready(function() {
        $('body').on('click', '[id^="viewEstimate-info"]', function() {
            var estimateId = $(this).attr('id').split('viewEstimate-info')[1];
            var url = '/getInvoiceDetails' + estimateId;
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var details = response.estimateDetails;
                        $('#invoiceCustomerName').text(details.customer_name);
                        $('#invoiceProjectName').text(details.project_name);
                        $('#invoiceEstimateDate').text(details.scheduled_start_date);
                        $('#invoiceTotal').text('Total: $' + (details.estimate_total ? details.estimate_total : '0.00'));
                        $('#invoiceInvoiced').text('Invoiced: $' + (details.invoiced_payment ? details.invoiced_payment : '0.00'));
                        $('#invoicePaid').text('Paid: $' + (details.invoice_paid_total ? details.invoice_paid_total : '0.00'));
                        var invoices = details.invoices;
                        var invoiceTableBody = '';
                        invoices.forEach(function(invoice) {
                            invoiceTableBody += '<tr class="bg-white border-b">' +
                                '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">' + invoice.complete_invoice_date + '</th>' +
                                '<td class="px-6 py-4">' + invoice.invoice_name + '</td>' +
                                '<td class="px-6 py-4">' + (invoice.tax_rate ? invoice.tax_rate : 'N/A') + '</td>' +
                                '<td class="px-6 py-4">' + invoice.invoice_total + '</td>' +
                                '<td class="px-6 py-4">' + invoice.invoice_due + '</td>' +
                                '<td class="px-6 py-4">' + invoice.invoice_status + '</td>' +
                                '</tr>';
                        });
                        $('#invoiceTableBody').html(invoiceTableBody);
                        $('#viewEstimate-info-modal').removeClass('hidden');
                    } else {
                        alert('Failed to fetch the estimate details.');
                    }
                },
                error: function() {
                    alert('Error in AJAX request.');
                }
            });
        });
        $('.modal-close').click(function() {
            $('#viewEstimate-info-modal').addClass('hidden');
        });
    });
</script>
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
    $(document).ready(function() {
        $('#customer_id').change(function() {
            const selectedCustomerId = $(this).val();

            if (selectedCustomerId) {
                // Fetch customer details using AJAX
                $.ajax({
                    url: `/getCustomerDetails/${selectedCustomerId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Populate input fields with customer details
                        $('#first_name').val(data.customer.customer_first_name);
                        $('#last_name').val(data.customer.customer_last_name);
                        $('#email').val(data.customer.customer_email);
                        $('#phone').val(data.customer.customer_phone);
                        $('#company_name').val(data.customer.customer_company_name);
                        $('#first_address').val(data.customer.customer_primary_address);
                        $('#second_addresss').val(data.customer.customer_secondary_address);
                        $('#city').val(data.customer.customer_city);
                        $('#state').val(data.customer.customer_state);
                        $('#zip_code').val(data.customer.customer_zip_code);
                        $('#tax_rate').val(data.customer.tax_rate);
                        $('#potential_value').val(data.customer.potential_value);
                        $('#internal_note').val(data.customer.internal_note);
                        // billin_Address
                        $('#billing_address').val(data.customer.billing_address);
                        $('#billing_city').val(data.customer.billing_city);
                        $('#billing_state').val(data.customer.billing_state);
                        $('#billing_zip').val(data.customer.billing_zip);
                        // ... populate other fields as needed
                    },
                    error: function(error) {
                        console.error('Error fetching customer details:', error);
                    }
                });
            } else {
                // Clear input fields if no customer is selected
                $('#first_name').val('');
                $('#last_name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#company_name').val('');
                $('#first_address').val('');
                $('#second_address').val('');
                $('#city').val('');
                $('#state').val('');
                $('#zip_code').val('');
                $('#tax_rate').val('');
                $('#potential_value').val('');
                $('#internal_note').val('');
                $('#billing_address').val('');
                $('#billing_city').val('');
                $('#billing_state').val('');
                $('#billing_zip').val('');
                // ... clear other fields as needed
            }
        });
    });
</script>
{{-- <script>
    $("#addEstimate").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
    });
</script> --}}
<script>
    $(".addEstimate").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
    });
</script>
<script>
    // Your list of users with names and ids

    // Get the textarea, user dropdown, and hidden input elements
    const messageTextarea = $(".message");
    const userDropdown = $(".userDropdown");
    const userIdInput = $("#mentioned_user_ids");

    // Append the hidden input to the form
    $("#chat-form").append(userIdInput);

    // Track mentioned user ids
    let mentionedUserIds = [];

    // Event listener for typing '@' in the textarea
    messageTextarea.on("input", function(event) {
        const text = event.target.value;
        const lastIndex = text.lastIndexOf("@");

        if (lastIndex !== -1) {
            const query = text.substring(lastIndex + 1);
            const matchingUsers = Object.entries(users)
                .filter(([id, name]) =>
                    name.toLowerCase().includes(query.toLowerCase())
                );

            // Display matching users in the dropdown
            renderDropdown(matchingUsers);
        } else {
            // Hide the dropdown if '@' is not present
            userDropdown.hide();
        }
    });

    // Function to render the user dropdown
    function renderDropdown(users) {
        if (users.length > 0) {
            const dropdownContent = users.map(([id, name]) => `
            <button type="button" onclick="mentionUser('${name}', '${id}')">${name}</button>
        `).join("");

            userDropdown.html(dropdownContent).show();
        } else {
            userDropdown.hide();
        }
    }

    // Function to handle user selection from the dropdown
    function mentionUser(userName, userId) {
        const currentText = messageTextarea.val();
        const lastIndex = currentText.lastIndexOf("@");
        const newText = currentText.substring(0, lastIndex) + `@${userName} `;

        messageTextarea.val(newText);

        // Add the mentioned user's id to the array
        mentionedUserIds.push(userId);

        // Set the array of mentioned user ids in the hidden input
        userIdInput.val(mentionedUserIds);

        userDropdown.hide();
    }

    // Close the dropdown when clicking outside of it
    $(document).on("click", function(event) {
        if (!$(event.target).closest("#userDropdown").length && !$(event.target).is("#message")) {
            userDropdown.hide();
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Branch filter change event
        $('#branch-filter').on('change', function() {
            var branch = $(this).val();
            var currentUrl = new URL(window.location.href);

            // Add or update the branch parameter
            if (branch) {
                currentUrl.searchParams.set('branch', branch);
            } else {
                currentUrl.searchParams.delete('branch');
            }

            // Redirect to the new URL
            window.location.href = currentUrl.toString();
        });

        // Status filter buttons
        $('.pending-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('status', 'pending');
            window.location.href = currentUrl.toString();
        });

        $('.complete-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('status', 'complete');
            window.location.href = currentUrl.toString();
        });

        $('.paid-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('status', 'paid');
            window.location.href = currentUrl.toString();
        });

        $('.cancel-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('status', 'cancel');
            window.location.href = currentUrl.toString();
        });

        // View filters for scheduler
        $('.view-all-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.delete('type');
            window.location.href = currentUrl.toString();
        });

        $('.view-assigned-filter').on('click', function() {
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('type', 'assigned');
            window.location.href = currentUrl.toString();
        });
    });
</script>
<!-- JavaScript for checkbox -->
   <script>
    const checkbox = document.getElementById('toggle-address');
    const additionalInputs = document.getElementById('additionalInputs');

    // Run on page load
    window.addEventListener('DOMContentLoaded', () => {
        if (checkbox.checked) {
            additionalInputs.classList.add('hidden');
        } else {
            additionalInputs.classList.remove('hidden');
        }
    });

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            additionalInputs.classList.add('hidden');
        } else {
            additionalInputs.classList.remove('hidden');
        }
    });
</script>
{{-- {{ old('first_address', $address1 ?? '') }} --}}
