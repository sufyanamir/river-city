<!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
<script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
@vite('resources/css/app.css')
<link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
<style>
    .photos {
        /* width: 100%;
        aspect-ratio: 3/2; */
        height: 70%;
    }

    :root {
        --theme-color: #930027;
    }
</style>
@if(isset($success) && !$success)
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">{{$sts}}</h1>
        <h2 class="text-2xl text-gray-600 mb-8">{{$message}}</h2>
        <p class="text-gray-500 mb-6">Sorry, the page you are looking for does not exist.</p>
        <a href="/" class="text-white bg-[color:var(--theme-color)] hover:bg-[color:var(--theme-color)]/90 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Go Home</a>
    </div>
</div>
@else
<div class="text-right my-2">
    <!-- <a href="javascript:void(0);" onclick="printPageArea('printableArea')">
        <button class=" bg-[#930027] p-2 text-white rounded-md">
            Print
        </button>
    </a> -->
    <a href="javascript:void(0);" onclick="downloadAsPDF('printableArea')">
        <button class="bg-[#930027] p-2 text-white rounded-md ml-2">Download as PDF</button>
    </a>
</div>
<form action="/acceptProposal/{{ $estimate['estimate_id'] }}" method="post">
    @csrf
    <div class="my-4" id="printableArea">
        <div class="bg-white w-full overflow-auto rounded-lg shadow-lg">
            <div class="grid grid-cols-12 p-5">
                <div class="col-span-6 p-4 ">
                    <div class="projectLogo ">
                        <img class="w-[288px] h-[73px]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                    </div>
                    <div class="mt-12 p-4">
                        <p class="text-[22px]/[25.78px] font-bold text-[#323C47]">River City Painting, Inc</p>
                        <p class=" mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            @if($customer['branch'] == 'wichita')
                            4425 W Walker St<br>
                            Wichita Kansas 67209 <br>
                            info@paintwichita.com <br>
                            (316) 262-3289
                            @elseif($customer['branch'] == 'kansas')
                            12022 Blue Valley Pkwy<br>
                            Overland Park, Ks 66213 <br>
                            913-660-9099
                            <br>
                            office@rivercitypaintinginc.com <br>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-span-6 p-4">
                    <div class="">
                        <p class=" text-end text-[30px]/[35.16px] font-bold text-[#323C47]">Estimate</p>
                        <p class=" text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_project_number'] }} <br>
                            {{ $estimate['created_at'] }}
                        </p>
                    </div>
                    <div class="mt-12">
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_first_name'] }} {{ $customer['customer_last_name'] }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_primary_address'] }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_city'] }} {{ $customer['customer_state'] }}
                            {{ $customer['customer_zip_code'] }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_email'] }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_phone'] }}
                        </p>
                        <br>
                        <p class="text-end mt-8 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer['customer_project_name'] }}
                        </p>
                        <p class=" text-end mt-2 font-bold text-[17px]/[19.92px] text-[#323C47] location">
                            {{ $customer['customer_primary_address'] }}, {{ $customer['customer_city'] }},
                            {{ $customer['customer_state'] }}, {{ $customer['customer_zip_code'] }}
                        </p>
                    </div>
                </div>
                <div class=" col-span-12 mx-auto">
                    <div class=" flex gap-6">
                        <div>
                            <img src="{{asset('assets/images/PCA-Logo-RGB .png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/RCP Badges-02.png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/Lead-Safe-EPA-Certified-Firm .png')}}" class=" photos" alt="image">
                        </div>
                        <div>
                            <img src="{{asset('assets/images/RCP-Badges-01.png')}}" class=" photos" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-span-12 p-4">
                    <div class="heading bg-[#930027] ">
                        <p class="text-white  py-2 px-4">
                            <span class="text-[22px]/[25.78px]  font-bold">
                                {{ $customer['customer_project_name'] }}
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
                        $groupName = $groupItems['group']['group_name'] ?? ''; // Use 'Other' if no group is associated
                        $groupedItems[$groupName][] = $groupItems;
                        }
                        @endphp
                        <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                            @if (count($estimate_items) > 0)
                            @foreach ($groupedItems as $groupName => $itemss)
                            <div class="mb-2 bg-white shadow-xl">
                                <div class=" group-card p-1 bg-[#930027] text-white w-full rounded-t-lg">
                                    <div class="">
                                        @if($groupName)
                                        <div class="">
                                            @php
                                            $displayedGroups = []; // Array to keep track of displayed groups
                                            @endphp

                                            @foreach($itemss as $item)
                                            @php
                                            $group = $item['group']
                                            @endphp
                                            @if(!empty($group) && !in_array($group['group_id'], $displayedGroups))
                                            <!-- Display edit button only if the group has not been displayed before -->
                                            @php
                                            $displayedGroups[] = $group['group_id']; // Add group to displayed groups
                                            @endphp
                                            @endif
                                            @endforeach
                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <h1 class=" font-medium my-auto p-2">{{$groupName}}</h1>
                                                    <div id="formData{{$item['group_id']}}" class="hidden">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate['estimate_id']}}">
                                                        <input type="hidden" name="group_id" value="{{$item['group_id']}}">
                                                        <input type="hidden" name="type" value="acceptAll">
                                                        <input type="hidden" name="item_status" value="accepted">
                                                        <input type="hidden" name="estimate_item_id" value="">
                                                    </div>
                                                </div>
                                                @if(isset($item->group->include_est_total) && $item->group->include_est_total == 0)
                                                    <div class="my-auto mx-2 text-lg">
                                                        <input required
                                                         type="radio" 
                                                            name="group_accept_reject" 
                                                            value="accepted" 
                                                            id="submitAcceptionRejection{{$item->group_id}}" 
                                                            data-type="acceptAll"
                                                            data-status="accepted"
                                                            {{ $item->upgrade_status == 'accepted' ? 'checked' : '' }}>
                                                        <label for="">Accept</label>
                                                        
                                                        <input required
                                                         type="radio" 
                                                            name="group_accept_reject" 
                                                            value="rejected" 
                                                            id="submitAcceptionRejection{{$item->group_id}}" 
                                                            data-type="rejectAll"
                                                            data-status="rejected"
                                                            {{ $item->upgrade_status == 'rejected' ? 'checked' : '' }}>
                                                        <label for="">Reject</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
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
                                                    <th scope="col" class="text-center">
                                                        Item Qty
                                                    </th>
                                                    <th scope="col" class="text-center">
                                                        Item Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $groupTotal = 0;
                                                $incEstTotal = 0;
                                                @endphp
                                                @foreach ($itemss as $item)
                                                <tr class="bg-white border-b">
                                                    <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                        <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                        <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                    </th> -->
                                                    <td class="px-6 py-4">
                                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_name'] }}
                                                            <!-- <span class="bg-{{ $item['upgrade_status'] == 'accepted' ? 'green' : ($item['upgrade_status'] == 'rejected' ? 'red' : 'gray') }}-100 text-{{ $item['upgrade_status'] == 'accepted' ? 'green' : ($item['upgrade_status'] == 'rejected' ? 'red' : 'gray') }}-800 text-xs font-medium me-2 px-2.5 py-1 rounded-sm dark:bg-{{ $item['upgrade_status'] == 'accepted' ? 'green' : ($item['upgrade_status'] == 'rejected' ? 'red' : 'gray') }}-700 dark:text-{{ $item['upgrade_status'] == 'accepted' ? 'green' : ($item['upgrade_status'] == 'rejected' ? 'red' : 'gray') }}-300">{{ $item['upgrade_status'] }}</span> -->
                                                        </label>
                                                        <p class="text-[16px]/[18px] text-[#323C47] font">
                                                            @if ($item['item_description'])
                                                        <p class="font-medium">Description:
                                                            {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item['item_description']) !!}
                                                        </p>
                                                        @endif
                                                        @if ($item['item_note'])
                                                        <p class="font-medium">Note:
                                                            {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item['item_note']) !!}
                                                        </p>
                                                        @endif
                                                        </p>
                                                    </td>
                                                    @if(isset($item['group']) && $item['group'])
                                                    <td class="text-center">
                                                        @if($item['group']['show_quantity'] == 1)
                                                        {{ number_format($item['item_qty'], 2) }} <br> {{ $item['item_unit'] }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($item['group']['show_total'] == 1)
                                                        ${{ number_format($item['item_total'], 2) }}
                                                        @endif
                                                    </td>
                                                    @else
                                                    <td class="text-center">
                                                        {{ number_format($item['item_qty'], 2) }} <br> {{ $item['item_unit'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        ${{ number_format($item['item_total'], 2) }}
                                                    </td>
                                                    @endif
                                                </tr>
                                                @php
                                                if(isset($item['group']['show_group_total']) && $item['group']['show_group_total'] == 1) {
                                                $groupTotal += $item['item_total']; // Add item price to group total
                                                }
                                                @endphp
                                                @php
                                                if(isset($item['group']['include_est_total']) && $item['group']['include_est_total'] == 1) {
                                                    $incEstTotal = 1;
                                                $subTotal += $item['item_total']; // Add item price to total
                                                }else{
                                                    if($item['upgrade_status'] == 'accepted'){
                                                        $subTotal += $item['item_total'];
                                                    }
                                                }
                                                $acceptorreject = $item['upgrade_status'];
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <th>
                                                        @if($incEstTotal == 0 && $acceptorreject == 'rejected')
                                                        **Not include in Estimate Total**
                                                        @endif
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class=" text-right py-3" colspan="7">
                                                        Group Total: {{ number_format($groupTotal, 2) }}
                                                    </th>
                                                </tr>
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
                                            $itemName = App\Models\Items::where('item_id', $item['item_id'])->first();
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
                                                <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                                    <label for="privilegeReportsView" class=" text-gray-500"></label>
                                                </th> -->
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $upgrade->item_name }}</label>
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($upgrade->item_description)
                                                    <p class="font-medium">Description:</p>
                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}
                                                    @endif
                                                    @if ($upgrade->item_note)
                                                    <p class="font-medium">Note:</p>
                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}
                                                    @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $upgrade->item_qty }} <br> {{ $upgrade->item_unit }}
                                                </td>
                                                <td class="text-center">
                                                    ${{ $upgrade->item_total }}
                                                    <input type="hidden" id="upgrade_total" value="{{$upgrade->item_total}}">
                                                </td>
                                                <td>
                                                    @if(!session()->has('user_details'))
                                                    @if ($item['upgrade_status'] != 'accepted')
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
                                <p class="italic text-[#323C47]">
                                    Discount
                                </p>
                            </div>
                            <div>
                                <p class="text-[#858585]">
                                    ${{ number_format($subTotal, 2) }}
                                </p>
                                <p class="text-[#858585]">
                                    {{ number_format($estimate['tax_rate'], 2) }}%
                                </p>
                                <p class="text-[#858585]">

                                    <span id="dynamic-total">${{ number_format($subTotal + ($subTotal * $estimate['tax_rate']) / 100, 2) }}</span>
                                    <input type="hidden" id="dynamic_total_input" value="{{$subTotal + ($subTotal * $estimate['tax_rate']) / 100}}">
                                </p>
                                @php
                                $estimateTotal = $subTotal;
                                $percentageDiscount = $estimate['percentage_discount'];
                                $priceDiscount = $estimate['price_discount'];

                                if ($percentageDiscount) {
                                $discountedTotal = $estimateTotal - ($estimateTotal * ($percentageDiscount / 100));
                                } elseif($priceDiscount) {
                                $discountedTotal = $estimateTotal - $priceDiscount;
                                }else{
                                $discountedTotal = null;
                                }
                                @endphp
                                <p class="text-[#858585]">
                                    ${{ number_format($discountedTotal, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-span-12 p-4">
                <div class=" mt-5">
                    @isset($terms_and_conditions)
                    {!! $terms_and_conditions !!}
                    @endisset
                </div>

            </div>
            <input type="hidden" name="estimate_id" value="{{ $estimate['estimate_id'] }}">
            <input type="hidden" name="customer_email" value="{{ $customer['customer_email'] }}">
            <input type="hidden" name="estimate_total" value="{{ $subTotal + ($subTotal * $estimate['tax_rate']) / 100 }}">
            <div class="col-span-12 p-4 flex justify-end mt-10">
                @if(!session()->has('user_details'))
                @if($estimate['estimate_total'] == null )
                <button type="button" id="addSign" class="bg-[#930027] text-white p-2 rounded-md hover:bg-red-900 ">Accept</button>
                @else
                <div>
                    <div>
                        @if($estimate['customer_signature'] != null)
                        <img src="{{$estimate['customer_signature']}}" alt="Customer Signature">
                        @endif
                    </div>
                    <hr>
                    <div class=" text-center">
                        <p class="text-[#930027]">Proposal Accepted</p>
                    </div>
                </div>
                <!-- <span class="bg-[#930027] text-white p-2 rounded-md">Proposal Accepted</span> -->
                @endif
                @endif
                @if(session()->has('user_details'))
                @if($estimate['estimate_total'] != null)
                <div>
                    <div>
                        @if($estimate['customer_signature'] != null)
                        <img src="{{$estimate['customer_signature']}}" alt="Customer Signature">
                        @endif
                    </div>
                    <hr>
                    <div class=" text-center">
                        <p class="text-[#930027]">Proposal Accepted</p>
                    </div>
                </div>
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
                    <div class=" text-center grid grid-cols-1 gap-2 bg-gray-200">
                        <div class=" my-2 mx-auto bg-white">
                            <canvas id="signatureCanvas" class="border"></canvas>
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="privileges[estimate][files]" id="Acknowledgement">
                        <label for="Acknowledgement" class=" text-gray-500 text-justify">
                            I hereby acknowledge that I have reviewed and accepted the scope of work detailed in the estimate. I understand that any modifications to the project will constitute a 'Change Order' and could lead to adjustments in the total cost. Additionally, I acknowledge that deposits are non-refundable.
                        </label>
                    </div>
                    <div class="">
                        <button disabled id="saveButton" class=" save-btn mb-2 float-right bg-red-400 text-white py-1 px-7 rounded-md">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#Acknowledgement').change(function() {
            var isChecked = $(this).prop('checked');
            $('#saveButton').prop('disabled', !isChecked);
            if (isChecked) {
                $('#saveButton').removeClass('bg-red-400').addClass('bg-[#930027]');
            } else {
                $('#saveButton').removeClass('bg-[#930027]').addClass('bg-red-400');
            }
        });
        $(document).on('click', '[id^=submitAcceptionRejection]', function() {
            // Extract the ID from the button's ID attribute
            var id = $(this).attr('id').replace('submitAcceptionRejection', '');

            // Find the corresponding formData div
            var formDataDiv = $('#formData' + id);

            // Collect input values from the formData div
            var formData = {};
            formDataDiv.find('input').each(function() {
                formData[$(this).attr('name')] = $(this).val();
            });

            // Get the data-type and data-status values from the clicked button
            var type = $(this).data('type');
            var status = $(this).data('status');

            // Override the type and item_status values in formData
            formData['type'] = type;
            formData['item_status'] = status;

            // Perform the AJAX request
            $.ajax({
                url: '/acceptRejectEstimateItems',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Request successful:', response);
                    location.reload();
                },
                error: function(error) {
                    console.log('Request failed:', error);
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        // Signature Canvas
        var canvas = document.getElementById('signatureCanvas');
        var ctx = canvas.getContext('2d');
        var drawing = false;
        var lastX, lastY;

        // Function to get touch coordinates relative to canvas element
        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }

        // Event listener for touchstart event
        canvas.addEventListener('touchstart', function(e) {
            e.preventDefault();
            var touchPos = getTouchPos(canvas, e);
            lastX = touchPos.x;
            lastY = touchPos.y;
            drawing = true;
        }, false);

        // Event listener for touchmove event
        canvas.addEventListener('touchmove', function(e) {
            e.preventDefault();
            if (drawing) {
                var touchPos = getTouchPos(canvas, e);
                drawLine(ctx, lastX, lastY, touchPos.x, touchPos.y);
                lastX = touchPos.x;
                lastY = touchPos.y;
            }
        }, false);

        // Event listener for touchend event
        canvas.addEventListener('touchend', function() {
            drawing = false;
        }, false);

        // Event listener for mousedown event
        canvas.addEventListener('mousedown', function(e) {
            e.preventDefault();
            drawing = true;
            lastX = e.offsetX || e.clientX - canvas.getBoundingClientRect().left;
            lastY = e.offsetY || e.clientY - canvas.getBoundingClientRect().top;
        });

        // Event listener for mousemove event
        canvas.addEventListener('mousemove', function(e) {
            e.preventDefault();
            if (drawing) {
                var mouseX = e.offsetX || e.clientX - canvas.getBoundingClientRect().left;
                var mouseY = e.offsetY || e.clientY - canvas.getBoundingClientRect().top;
                drawLine(ctx, lastX, lastY, mouseX, mouseY);
                lastX = mouseX;
                lastY = mouseY;
            }
        });

        // Event listener for mouseup event
        canvas.addEventListener('mouseup', function() {
            drawing = false;
        });

        // Function to draw a line on the canvas
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
            var dataURL = canvas.toDataURL();
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
        // $("#formData")[0].reset()
    });

    function printPageArea(areaID) {
        var printContent = document.getElementById(areaID).innerHTML;
        var originalContent = document.body.innerHTML;

        // Create a style tag with the desired background color
        var style = document.createElement('style');
        style.innerHTML = 'body { background-color: white !important; } .group-card { color: black !important;  }';

        // Append the style tag to the head of the document
        document.head.appendChild(style);

        // Set the body content to the print content and print
        document.body.innerHTML = printContent;
        window.print();

        // Restore the original content and remove the added style tag
        document.body.innerHTML = originalContent;
        document.head.removeChild(style);
    }
    function downloadAsPDF(areaID) {
    var element = document.getElementById(areaID);

    var opt = {
        margin: 0.5,
        filename: 'Estimate_{{ $estimate["customer_name"] }}_{{$estimate["customer_last_name"]}}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] } // Improved page-break handling
    };
    

    // Apply styles to fix white space issues
    var style = document.createElement('style');
    style.innerHTML = `
        body { background-color: white !important; font-size: 15px !important; }
        .group-card { background-color: #930027 !important; }
        #grandTotal-card { display: none !important; }
        #grandDiv { font-size: 15px !important; }

        * { word-wrap: break-word; font-size: 15px !important; }

        div, p, span, table, td, tr, th {
            page-break-inside: avoid !important;
        }

        table { page-break-before: auto; page-break-after: auto; }

        /* Fix excessive white space issue */
        .group-card, .item-row {
            page-break-before: avoid !important;
            page-break-after: auto !important;
            display: block !important;
        }
    `;
    document.head.appendChild(style);

    html2pdf().set(opt).from(element).save();
}
</script>
@endif