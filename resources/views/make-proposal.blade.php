@include('layouts.header')
<style>
    .photos {
        /* width: 100%;
        aspect-ratio: 3/2; */
        height: 70%;
    }
</style>
<form action="/sendProposal" method="post" id="sendProposalForm">
    @csrf
    <div class="my-4">
        <div class="bg-white w-full overflow-auto rounded-lg shadow-lg">
            <div class="grid grid-cols-12 p-5">
                <div class="col-span-6 p-4 ">
                    <div class="projectLogo ">
                        <img class="w-[288px] h-[73px]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                    </div>
                    <div class="mt-12 p-4">
                        <p class="text-[22px]/[25.78px] font-bold text-[#323C47]">River City Painting, Inc</p>
                        <p class=" mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            @if($customer->branch == 'wichita')
                            4425 W Walker St<br>
                            Wichita Kansas 67209 <br>
                            @elseif($customer->branch == 'kansas')
                            12022 Blue Valley Pkwy<br>
                            Overland Park, Ks 66213 <br>
                            @endif
                        info@paintwichita.com <br>
                        (316) 262-3289
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
                <div class=" col-span-12 mx-auto">
                    <div class=" flex gap-6">
                        <div>
                            <img src="{{asset('assets/images/PCA-Logo-RGB .png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/2023BOW_GoldWInner.png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/Lead-Safe-EPA-Certified-Firm .png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/workmanship.png')}}" class=" photos" alt="image">
                        </div>
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
                        <div class="py-1" id="printableArea">
                            <div class="col-span-10  pl-2 ">
                                <div class="grid sm:grid-cols-10">
                                    <div class="col-span-8 p-3">
                                        <p class="text-[#F5222D] text-xl font-bold">
                                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                                        </p>
                                        <p class="text-[#323C47] text-lg font-semibold">
                                            {{ $customer->customer_project_name }}
                                        </p>
                                        <p class="mt-2 flex text-[#323C47] font-medium">
                                            <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                                            <span class="pl-2">{{ $customer->customer_primary_address }}</span>
                                        </p>
                                        <p class="mt-1 flex text-[#323C47] font-medium">
                                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                                            <span class="pl-2">Project Owner: {{ $customer->owner }}
                                            </span>
                                        </p>
                                        <hr class="bg-gray-300 my-2 w-full">
                                        <p class="mt-1 flex text-[#323C47] font-medium">
                                            <img src="{{ asset('assets/icons/page-icon.svg') }}" alt="">
                                            <span class="pl-2">Estimate Pending Schedule
                                            </span>
                                        </p>
                                        {{-- <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                                        <span class="pl-2 flex">{{ $customer->owner }} Assigned To Schedule Estimate On <span class="pl-2 text-[#31A613] flex">
                                                <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}" alt="">
                                                {{ $customer->created_at }}</span>
                                        </span>
                                        </p> --}}
                                    </div>
                                    <div class=" col-span-2 p-3 text-right">
                                        <p class="text-lg font-bold text-[#323C47]">
                                            Estimate
                                            <br>
                                            <span>{{ $estimate->project_name }}</span>
                                        </p>
                                        <p class="mt-[2px] text-[#323C47]">
                                            {{ $estimate->project_number }}
                                        </p>
                                        <p class="text-[#323C47]">
                                            {{ $estimate->estimate_status }}
                                        </p>
                                        <p class="text-[#323C47]">
                                            {{ date('d, F Y', strtotime($estimate->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                                                        <!-- <th scope="col" class="px-6 py-3">

                                                        </th> -->
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
                                                        <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                            <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                            <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                        </th> -->
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
                                                            ${{ $item->item_total }}
                                                        </td>
                                                        <!-- @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
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
                                                </tr> -->
                                                        @php
                                                        $subTotal += $item->item_total; // Add item price to total
                                                        @endphp
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                                                    <!-- <th scope="col" class="px-6 py-3">Check</th> -->
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
                                                    <!-- <td class="px-6 py-4">
                                                        <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                        <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                    </td> -->
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
                                                        <label class="text-lg font-semibold text-[#323C47]" for="">${{ $item['item_price'] }}</label>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <label class="text-lg font-semibold text-[#323C47]" for="">${{ $item['item_total'] }}</label>
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
                            @if(count($upgrades) > 0)
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
                                                    <!-- <th scope="col" class="px-6 py-3">

                                                    </th> -->
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
                                                @foreach($upgrades as $upgrade)
                                                <tr class="bg-white border-b">
                                                    <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                        <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                        <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                    </th> -->
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
                                                        ${{ $upgrade->item_total }}
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
                                                @php
                                                $subTotal += $upgrade->item_total; // Add item price to total
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
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
                                        ${{ number_format($subTotal + ($subTotal * $customer->tax_rate) / 100, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-span-12 p-4">
                    <div class=" mt-5">
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Required Deposit
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            A nonrefundable 1/3 deposit is required for all projects due at the time of scheduling to secure your spot on our schedule. The remaining balance will be due upon completion.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Final Walkthrough
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            If final walkthrough is unable to be done within 3 days of project completion then customer will be sent final invoice for full amount and payment is due.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Color Policy
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            Please list all color numbers and names with specified areas to be painted and email to <a class="text-blue-400" href="https://paintwichita.com/">info@paintwichita.com</a> no later than three days before your projected start date. You may also call (316) 262-3289 to list your colors. Prices may vary for multiple color schemes , deep colors, and accent walls that are not noted on your estimate.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Paint Samples
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            Sample colors can be done at the request of customer when project starts but before full paint quantities have been purchased. If customer requests samples to be painted prior to work beginning then customer will be charged one additional labor hour rate of $48 per hour. If full paint quantities have been purchased and customer requests to make a color change, customer will be billed AT COST for purchase of paint as large paint orders cannot be returned.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Professional Standards
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            Our company follows professional standards from guidelines of the “Painting Contractors of America” for all touch-ups and damage repair, please refer to PCA P1-92. Inspection of completed work will be done by the customer according to PCA Standards (Painting Contractors of America) which states: “In order to determine whether a surface has been “properly painted” it shall be examined without magnification at a distance of thirty-nine (39) inches or one (1) meter, or more, under finished lighting conditions and from a normal viewing position.”
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Quality Standards
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            We will only use the finest quality products as an investment in your property. NOTE: some degree of yellowing must be expected with the aging of all paints. Rework caused by others will be completed at an hourly rate of $95.00 per hour, with a minimum of two hours. Change Order: Any changes from original will need to be brought to the attention of Project Manager of River City Painting office so that a change order can be completed and approved by customer. We will not deviate from original work order unless all items and pricing have been approved.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Photographs
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            River City Painting, Inc. assumes the right to take photographs of all work performed on your site to use in our advertising and marketing efforts.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            General
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            An area in the garage or a place to park the River City Painting trailer may be needed to store materials, tools, and equipment during the course of your project. River City Painting would like permission to set a yard sign during work. Any damage such as dry rot, termites, mold, etc. may not be apparent during initial inspection for a variety of reasons. Any damage or additional work required that was not on the original estimate will be discussed with the homeowner prior to any repairs being completed. The job site will be kept clean and debris will be hauled away upon completion. The customer shall not directly or indirectly interfere with River City Painting crew members in any way during the project. This stops the flow of the painter and disrupts the pattern and final outcome. Customer interference may result in additional labor and/or material charges. We cannot be held responsible for after-the-fact items, which could result in us having to stop in the middle of a project. We have an Office staff as well as a project manager staffed during business hours to assist you with anything you need, so feel free to give us a call. Customer agrees to allow access to project area of customers’ home between the hours of 8:30am - 5:00pm, Mon-Fri from the start of the project through completion. Hours/days spent at customer home can vary due to a number of variables. Employee and/or contractor may come and go during the above hours/days, according to what is most efficient each day to complete the job correctly. Sometimes there are circumstances that arise where we may ask to work outside of the above hours but we will always receive your permission before doing so. We do our best to keep you informed of the process but you are always welcome to check with your project manager or the office anytime you have questions. River City Painting, Inc. is a member of the Wichita Executives Association, Painting Contractors of America, and The Better Business Bureau. We are fully insured for your protection! ESTIMATES ARE FOR COMPLETING THE JOB AS DESCRIBED IN THE ESTIMATE. IT IS A SET PRICE PER JOB AND IS BASED UPON OUR EVALUATION. IT DOES NOT INCLUDE INCREASES FOR ADDITIONAL LABOR OR MATERIALS WHICH MAY BE REQUIRED SHOULD UNFORESEEN PROBLEMS ARISE. ALL WORKMANSHIP IS GUARANTEED FOR THREE YEARS WITH THE EXCEPTION OF DECK PAINTING/STAINING AND GENERAL STAINING WHICH IS NOT WARRANTIED. THE PRICES INCLUDED IN YOUR ESTIMATE ARE FOR COMPLETE JOB BOOKING. SHOULD YOU DECIDE ON ONLY A PORTION OF THE ESTIMATE, PRICING MAY VARY, AS WE GIVE PRICE BREAKS ON LARGER ESTIMATES. Any changes to the specifications above must be requested by the Client and approved by the Project Manager. Additional charges may apply and will be payable upon completion. All agreements are contingent based upon weather changes during and prior to your project that is outside of our control.
                        </p>
                        <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                            Acceptance
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            The above prices, specifications, and conditions are satisfactory and are hereby accepted. You are authorized to do the work as specified. Payment will be made as outlined above. Both parties agree to a three-day (3) right to cancel on all signed/dated contracts. "YOU THE BUYER, MAY CANCEL THIS TRANSACTION AT ANY TIME PRIOR TO MIDNIGHT OF THE THIRD BUSINESS DAY AFTER THE DATE OF THIS TRANSACTION. SEE THE ATTACHED NOTICE OF CANCELLATION FORM FOR AN EXPLANATION OF THIS RIGHT." For purposes of the required notices under this section, the term "buyer" shall have the same meaning as the term "consumer" Final Payment Terms The customer agrees to pay the entire remaining balance owed for their project on the day of completion/installation. Failure to do so will result in a 10% weekly late fee for the first six weeks and an 18% monthly interest fee from six weeks (added to the balance owed), until paid in full. The customer will also be responsible for all attorney/ legal/court/lien fees paid by the contractor to collect payment.
                        </p>
                        <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                            Compensation
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            Client shall pay as set forth in this document. Price is subject to change, with customer’s
                            approval
                        </p>
                        <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                            Invoicing & Payment
                        </p>
                        <p class="text-[#858585] pt-2 text-justify">
                            Invoice will be issued to Client upon Completion of the work client shall pay
                            invoice within 10 days of client’s receipt of the invoice. Client shall also pay a late charge
                            of 1-1/2% per month
                            on all balances unpaid 30 days after the invoice date.
                        </p>
                    </div>

                </div>
                @if ($user_details['user_role'] != 'crew')
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="customer_email" value="{{ $customer->customer_email }}">
                <input type="hidden" name="estimate_total" value="{{ $subTotal + ($subTotal * $customer->tax_rate) / 100 }}">
                <div class="col-span-12 p-4 flex justify-end mt-10">
                    <button class="bg-[#930027] text-white p-2 rounded-md hover:bg-red-900 " id="sendProposal-btn">Send Proposal</button>
                </div>
                @else
                @endif
            </div>
        </div>
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="sendProposal-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                </div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal content here -->
                        <div class=" flex justify-between border-b-2">
                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Please Add Your Signature!</h2>
                            <button class="modal-close" type="button">
                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                        <!-- task details -->
                        <div class=" grid grid-cols-2 gap-4 my-2">
                            <input type="hidden" name="email_id" id="email_id">
                            <div>
                                <label for="email_title">Email title:</label>
                                <input type="text" name="email_title" id="email_title" value="Proposal Email" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div>
                                <label for="email_to">Email to:</label>
                                <input type="text" name="email_to" id="email_to" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $customer->customer_email }}">
                            </div>
                            <div class=" col-span-2">
                                <label for="email_subject">Email Subject:</label>
                                <textarea name="email_subject" id="email_subject" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">Proposal Mail</textarea>
                            </div>
                            <div class=" col-span-2">
                                <label for="email_body">Email body:</label>
                                <textarea name="email_body" id="email_body" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" rows="10">Hello! {{$customer->customer_first_name}} {{$customer->customer_last_name}} We are pleased to present our proposal for your review. You may access the proposal via the following link. We eagerly await your feedback and hope to have the opportunity to further discuss and potentially move forward with this proposal.
                                </textarea>
                            </div>
                        </div>
                        <div class="">
                            <button onclick="return confirmSendProposal()" id="saveButton" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md">
                                <div class=" text-center hidden spinner" id="spinner">
                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                </div>
                                <div class="text" id="text">
                                    Send
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
@include('layouts.footer')
@php
$exsistingProposals = $existing_proposals;
@endphp
<script>
    function confirmSendProposal() {
        var existingProposals = @json($exsistingProposals); // Assuming you pass this variable from your controller

        if (existingProposals.length > 0) {
            var userResponse = confirm(
                "If you make this proposal, all the previous proposals of this estimate will be canceled! Do you want to proceed?"
            );

            if (userResponse) {
                return true; // Proceed with form submission
                $('#sendProposalForm').submit();
            } else {
                return false; // Cancel form submission
            }
        }

        return true; // No existing proposals, proceed with form submission
    }
</script>
<script>
    $("#sendProposal-btn").click(function(e) {
        e.preventDefault();
        $("#sendProposal-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#sendProposal-modal").addClass('hidden');
        $("#formData")[0].reset()
    });
</script>