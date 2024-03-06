@include('layouts.header')
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
                                                </tr>
                                                @php
                                                $subTotal += $item['item_price']; // Add item price to total
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
                @if ($user_details['user_role'] != 'crew')
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="customer_email" value="{{ $customer->customer_email }}">
                <input type="hidden" name="estimate_total" value="{{ $subTotal + ($subTotal * $customer->tax_rate) / 100 }}">
                <div class="col-span-12 p-4 flex justify-end mt-10">
                    <button class="bg-[#930027] text-white p-2 rounded-md hover:bg-red-900 " onclick="return confirmSendProposal()">Send Proposal</button>
                </div>
                @else
                @endif
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