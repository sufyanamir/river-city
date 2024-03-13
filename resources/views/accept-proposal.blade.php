<!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
<script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
@vite('resources/css/app.css')
<link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
<form action="/acceptProposal/{{ $estimate->estimate_id }}" method="post">
    @csrf
    <div class="my-4">
        <div class="bg-white w-full overflow-auto rounded-lg shadow-lg">
            <div class="grid grid-cols-12 p-5">
                <div class="col-span-6 p-4 ">
                    <div class="projectLogo ">
                        <img class="w-[288px] h-[73px]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                    </div>
                    <div class="mt-12 p-4">
                        <p class="text-[22px]/[25.78px] font-bold text-[#323C47]">River City Painting Pro Demo</p>
                        <p class=" mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            222 Merrimac ST <br>
                            Newburyport, Massachusetts 01950 <br>
                            Support@rivercitypainting.com <br>
                            978-379-7979
                        </p>
                    </div>
                </div>
                <div class="col-span-6 p-4">
                    <div class="">
                        <p class=" text-end text-[30px]/[35.16px] font-bold text-[#323C47]">Estimate</p>
                        <p class=" text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_project_number }} <br>
                            {{ $estimate->created_at }}
                        </p>
                    </div>
                    <div class="mt-12">
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_primary_address }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_city }} {{ $customer->customer_state }}
                            {{ $customer->customer_zip_code }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_email }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_phone }}
                        </p>
                        <br>
                        <p class="text-end mt-8 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_project_name }}
                        </p>
                        <p class=" text-end mt-2 font-bold text-[17px]/[19.92px] text-[#323C47] location">
                            {{ $customer->customer_primary_address }}, {{ $customer->customer_city }},
                            {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}
                        </p>
                    </div>
                </div>
                <div class="col-span-12 p-4">
                    <div class="heading bg-[#930027] ">
                        <p class="text-white  py-2 px-4">
                            <span class="text-[22px]/[25.78px]  font-bold">
                                {{ $customer->customer_project_name }}
                            </span> <br>
                        </p>
                    </div>
                    <div class="text-[#323C47] font-medium mt-4 border-b border-[#323C47] pb-6 border-solid">
                        @php
                        $subTotal = 0;
                        @endphp
                        @php

                        $groupedItems = [];
                        foreach ($estimate_items as $groupItems) {
                        $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
                        $groupedItems[$groupName][] = $groupItems;
                        }
                        @endphp
                        <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                            @if ($estimate_items->count() > 0)
                            @foreach ($groupedItems as $groupName => $itemss)
                            <div class="mb-2 bg-white shadow-xl">
                                <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                                    <div class="inline-block">
                                        <div class="flex gap-3">
                                            <h1 class=" font-medium my-auto p-2">{{$groupName}}</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative overflow-x-auto mb-8">
                                    <div class="itemDiv">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">

                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Item Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Item Description
                                                    </th>
                                                    <th scope="col" class="text-center">
                                                        Item Qty
                                                    </th>
                                                    <th scope="col" class="text-center">
                                                        Item Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($itemss as $item)
                                                <tr class="bg-white border-b">
                                                    <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                        <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                        <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item->item_name }}</label>
                                                    </td>
                                                    <td class="px-6 py-4 w-[30%]">
                                                        <p class="text-[16px]/[18px] text-[#323C47] font">
                                                            @if ($item->item_description)
                                                        <p class="font-medium">Description:</p>
                                                        {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                        <p class="font-medium">Note:</p>
                                                        {{ $item->item_note }}
                                                        @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->item_qty }} <br> {{ $item->item_unit }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->item_total }}
                                                    </td>
                                                    @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                                <tr>
                                                    <td colspan="7">
                                                        <div class="">
                                                            <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                                <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                                    <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                                        <span></span>
                                                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                                        </svg>
                                                                    </button>
                                                                </h2>
                                                                <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5]" aria-labelledby="accordion-collapse-heading-1">
                                                                    <div class="p-2">
                                                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                                                <tr>
                                                                                    <th scope="col" class="px-6 py-3"></th>
                                                                                    <th scope="col" class="px-6 py-3">
                                                                                        Item Name
                                                                                    </th>
                                                                                    <th scope="col" class="px-6 py-3">
                                                                                        Item Description
                                                                                    </th>
                                                                                    <th scope="col" class="text-center">
                                                                                        Item Qty
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($item->assemblies as $assembly)
                                                                                <tr class="bg-white border-b">
                                                                                    <td class="px-6 py-4"></td>
                                                                                    <td class="px-6 py-4">
                                                                                        {{$assembly->est_ass_item_name}}
                                                                                    </td>
                                                                                    <td class="px-6 py-4 w-[30%]">
                                                                                        {{$assembly->ass_item_description}}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{$assembly->ass_item_qty}} <br> {{$assembly->ass_item_unit}}
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @php
                                $subTotal += $item->item_total; // Add item price to total
                                @endphp
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @foreach($templates as $template)
                        <div class="mb-2 p-2 bg-white shadow-xl">
                            <div class=" flex justify-between p-3 bg-[#930027] text-white w-full rounded-t-lg">
                                <h1 class=" font-medium my-auto">{{ $template->item_template_name }}</h1>
                            </div>
                            <div class="relative overflow-x-auto">
                                <div class="itemDiv">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">Check</th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item QTY
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Price
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $templateItems = $template->templateItems; // Fetch related EstimateItemAssembly items
                                            @endphp
                                            @foreach ($templateItems as $item)
                                            @php
                                            $itemName = App\Models\Items::where('item_id', $item->item_id)->first();
                                            @endphp
                                            <tr class="bg-white border-b">
                                                <td class="px-6 py-4">
                                                    <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                    <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $itemName->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_description'] }}</label>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_qty'] }}</label> <br> {{$itemName->item_units}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_price'] }}</label>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_total'] }}</label>
                                                </td>
                                            </tr>
                                            @php
                                            $subTotal += $item['item_total']; // Add item price to total
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="mb-2 bg-white shadow-xl">
                            <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                                <div class="inline-block">
                                    <div class="flex gap-3">
                                        <h1 class=" font-medium my-auto p-2"></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto mb-8">
                                <div class="itemDiv">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">

                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Total
                                                </th>
                                                <th scope="col" class="text-center">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($upgrades as $upgrade)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                    <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $upgrade->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[30%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($upgrade->item_description)
                                                    <p class="font-medium">Description:</p>
                                                    {{ $upgrade->item_description }}
                                                    @endif
                                                    @if ($upgrade->item_note)
                                                    <p class="font-medium">Note:</p>
                                                    {{ $upgrade->item_note }}
                                                    @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $upgrade->item_qty }} <br> {{ $upgrade->item_unit }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $upgrade->item_total }}
                                                    <input type="hidden" id="upgrade_total" value="{{$upgrade->item_total}}">
                                                </td>
                                                <td>
                                                    @if(!session()->has('user_details'))
                                                    @if ($item->upgrade_status != 'accepted')
                                                    <div class=" text-right">
                                                        <input type="radio" name="upgrade_accept_reject" value="accepted" id="upgrade_accept"> Accept
                                                        <input type="radio" name="upgrade_accept_reject" value="rejected" id="upgrade_reject"> Reject
                                                    </div>
                                                    @endif
                                                    @endif
                                                </td>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="">
                                                        <div id="accordion-collapse{{$upgrade->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                                    <span></span>
                                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="accordion-collapse-body{{$upgrade->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5]" aria-labelledby="accordion-collapse-heading-1">
                                                                <div class="p-2">
                                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                                            <tr>
                                                                                <th scope="col" class="px-6 py-3"></th>
                                                                                <th scope="col" class="px-6 py-3">
                                                                                    Item Name
                                                                                </th>
                                                                                <th scope="col" class="px-6 py-3">
                                                                                    Item Description
                                                                                </th>
                                                                                <th scope="col" class="text-center">
                                                                                    Item Qty
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($upgrade->assemblies as $assembly)
                                                                            <tr class="bg-white border-b">
                                                                                <td class="px-6 py-4"></td>
                                                                                <td class="px-6 py-4">
                                                                                    {{$assembly->est_ass_item_name}}
                                                                                </td>
                                                                                <td class="px-6 py-4 w-[30%]">
                                                                                    {{$assembly->ass_item_description}}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{$assembly->ass_item_qty}} <br> {{$assembly->ass_item_unit}}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 font-medium">
                        <div class="flex justify-end gap-6">
                            <div>
                                <p class="italic text-[#323C47]">
                                    Sub Total
                                </p>
                                <p class="italic text-[#323C47]">
                                    Tax
                                </p>
                                <p class="italic text-[#323C47]">
                                    Total
                                </p>
                            </div>
                            <div>
                                <p class="text-[#858585]">
                                    ${{ number_format($subTotal, 2) }}
                                </p>
                                <p class="text-[#858585]">
                                    {{ number_format($customer->tax_rate, 2) }}%
                                </p>
                                <p class="text-[#858585]">

                                    <span id="dynamic-total">{{ number_format($subTotal + ($subTotal * $customer->tax_rate) / 100, 2) }}</span>
                                    <input type="hidden" id="dynamic_total_input" value="{{$subTotal + ($subTotal * $customer->tax_rate) / 100}}">
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-span-12 p-4">
                <div class=" mt-5">
                    <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                        Acceptance
                    </p>
                    <p class="text-[#858585] pt-2">
                        I acknowledge that I have read, understand and agree to what is included in the work described
                        in this
                        document and I agree to the price noted above and the terms and the contract conditions included
                        below.
                    </p>
                    <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                        Compensation
                    </p>
                    <p class="text-[#858585] pt-2">
                        Client shall pay as set forth in this document. Price is subject to change, with customer’s
                        approval
                    </p>
                    <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                        Invocing & Payment
                    </p>
                    <p class="text-[#858585] pt-2">
                        Invoice will be issued to Client upon Completion of the work client shall pay
                        invoice within 10 days of client’s receipt of the invoice. Client shall also pay a late charge
                        of 1-1/2% per month
                        on all balances unpaid 30 days after the invoice date.
                    </p>
                </div>

            </div>
            <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
            <input type="hidden" name="customer_email" value="{{ $customer->customer_email }}">
            <input type="hidden" name="estimate_total" value="{{ $subTotal + ($subTotal * $customer->tax_rate) / 100 }}">
            <div class="col-span-12 p-4 flex justify-end mt-10">
                @if(!session()->has('user_details'))
                @if($estimate->estimate_total == null )
                <button type="button" id="addSign" class="bg-[#930027] text-white p-2 rounded-md hover:bg-red-900 ">I Agree to Pay</button>
                @else
                <div>
                    <div>
                        <img src="{{$estimate->customer_signature}}" alt="Customer Signature">
                    </div>
                    <hr>
                    <div class=" text-center">
                        <p class="text-[#930027]">Proposal Accepted</p>
                    </div>
                </div>
                <!-- <span class="bg-[#930027] text-white p-2 rounded-md">Proposal Accepted</span> -->
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addSign-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Please Add Your Signature!</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-1 gap-2">
                        <div class=" my-2 mx-auto">
                            <canvas id="signatureCanvas" class="border"></canvas>
                        </div>
                    </div>
                    <div class="">
                        <button id=""
                            class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true"
                                    class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
        </div>
    </div>
</div>
<input type="hidden" id="drawingData" name="customer_signature">
</form>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/topbar.min.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Signature Canvas
    var canvas = document.getElementById('signatureCanvas');
    var ctx = canvas.getContext('2d');
    var drawing = false;
    var lastX, lastY;

    canvas.addEventListener('mousedown', function(e) {
        drawing = true;
        lastX = e.offsetX;
        lastY = e.offsetY;
    });

    canvas.addEventListener('mousemove', function(e) {
        if (drawing === true) {
            drawLine(ctx, lastX, lastY, e.offsetX, e.offsetY);
            lastX = e.offsetX;
            lastY = e.offsetY;
        }
    });

    canvas.addEventListener('mouseup', function() {
        drawing = false;
    });

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();
        context.strokeStyle = '#000';
        context.lineWidth = 2;
        context.moveTo(x1, y1);
        context.lineTo(x2, y2);
        context.stroke();
        context.closePath();
    }

    // Function to update the hidden input field with the latest drawing data
function updateDrawingData() {
    // Convert canvas to data URL
    var dataURL = canvas.toDataURL();
    // Set the data URL as the value of the hidden input field
    $('#drawingData').val(dataURL);
}

// Event listeners to update drawing data on canvas drawing events
canvas.addEventListener('mousemove', updateDrawingData);
canvas.addEventListener('touchmove', updateDrawingData);
});
</script>
<script>
    $(document).ready(function() {
        var upgradeAcceptRadio = $('#upgrade_accept');
        var upgradeRejectRadio = $('#upgrade_reject');
        var upgradeTotal = $('#upgrade_total');
        var dynamicTotalSpan = $('#dynamic-total');
        var dynamicTotalInput = $('#dynamic_total_input');
        var estimateTotalInput = $('input[name="estimate_total"]');

        // Initial total value

        // console.log(total);
        // Function to update total based on radio button selection
        function updateTotal() {
            if (upgradeAcceptRadio.prop('checked')) {
                var total = parseFloat(dynamicTotalInput.val()) + parseFloat(upgradeTotal.val());
            } else {
                total = parseFloat(dynamicTotalInput.val()) - parseFloat(upgradeTotal.val());
            }
            dynamicTotalSpan.text('$' + total);
            estimateTotalInput.val(total);
            dynamicTotalInput.val(total);
        }

        // Event listener for radio button changes
        upgradeAcceptRadio.on('change', updateTotal);
        upgradeRejectRadio.on('change', updateTotal);
    });
</script>
<script>
    $("#addSign").click(function(e) {
        e.preventDefault();
        $("#addSign-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addSign-modal").addClass('hidden');
        $("#formData")[0].reset()
    });
</script> 