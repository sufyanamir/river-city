<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Custom CSS for Work Order */
        *{
            margin: 0;
            padding: 0;
            padding-inline: 3px !important;
            background-color: white;
            box-sizing: border-box;
        }
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}
.p-3 {
    padding: 6px;
}
.m-2 {
    margin: 4px;
}
.mb-2 {
    margin-bottom: 4px;
}
/* .mb-8 {
    margin-bottom: 32px;
}
.py-7 {
    padding-top: 20px;
    padding-bottom: 20px;
} */
.px-4 {
    padding-left: 8px;
    padding-right: 8px;
}
.mt-2 {
    margin-top: 4px;
}
/* .py-4 {
    padding-top: 10px;
    padding-bottom: 10px;
} */
.px-6 {
    padding-left: 15px;
    padding-right: 15px;
}
/* .py-3 {
    padding-top: 8px;
    padding-bottom: 8px;
} */
.m-3 {
    margin: 6px;
}
.ml-2 {
    margin-left: 6px;
}
.my-2 {
    margin-top: 4px;
    margin-bottom: 4px;
}
.mt-1 {
    margin-top: 2px;
}
.pl-2 {
    padding-left: 6px;
}
.py-1 {
    padding-top: 2px;
    padding-bottom: 2px;
}
.my-4 {
    margin: 20px 0;
}

/* Container styles */
/* .my-4 {
    margin: 1.5rem 0;
} */

.bg-white {
    background-color: #fff;
}

table {
    width: 100% !important;
    /* border-collapse: collapse;
    table-layout: fixed; */
}
th, td {
    padding: 2px 8px;
    /* text-align: left; */
    vertical-align: top;
    font-size: 12px;
    word-break: break-word;
    }
/* Column widths */
    .w-70 { width: 70%; }
    .w-30 { width: 30%; text-align: center; }
/*
th, td {
    border: 1px solid #ddd;
    padding: 6px;
    word-wrap: break-word;
} */

.full-width {
    width: 100%;
}

.rounded-2xl {
    border-radius: 1rem;
}

.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Header section */
.flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.p-3 {
    padding: 4px;
}

.bg-\[\#930027\] {
    background-color: #930027;
}

.text-white {
    color: #fff;
}

.rounded-t-2xl {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}

.no-print {
    /* This class will be used to hide elements during printing if needed */
}

.text-xl {
    font-size: 1.25rem;
}

.font-semibold {
    font-weight: 600;
}

/* Button styles */
a {
    text-decoration: none;
}

button {
    cursor: pointer;
    border: none;
    font-weight: 500;
}

.rounded-md {
    border-radius: 0.375rem;
}

/* .ml-2 {
    margin-left: 0.5rem;
}

.py-1 {
    padding-top: 4px;
    padding-bottom: 4px;
} */

.grid {
    display: grid;
}

.sm\:grid-cols-10 {
    grid-template-columns: repeat(10, minmax(0, 1fr));
}

.col-span-8 {
    grid-column: span 8 / span 8;
}

.col-span-2 {
    grid-column: span 2 / span 2;
}

.text-\[\#F5222D\] {
    color: #F5222D;
}

.text-\[\#323C47\] {
    color: #323C47;
}

.text-lg {
    font-size: 14px;
}
.text-18 {
    font-size: 18px;
}

.font-bold {
    font-weight: 700;
}

.font-medium {
    font-weight: 500;
}

/* .my-2 {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.mt-2 {
    margin-top: 0.5rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.pl-2 {
    padding-left: 0.5rem;
} */

.bg-gray-300 {
    background-color: #D1D5DB;
}

.hr {
    height: 1px;
    border: none;
}

.text-right {
    text-align: right;
}

/* Items section */
/* .ml-2 {
    margin-left: 0.5rem;
} */

.overflow-auto {
    overflow: auto;
}

.rounded-lg {
    border-radius: 0.5rem;
}

/* .border-\[\#0000004D\] {
    border: 1px solid rgba(0, 0, 0, 0.3);
} */

/* .m-3 {
    margin: 0.75rem;
} */

/* Group section */
.group-section {
    margin-bottom: 1.5rem;
}

/* .group-header {
    background-color: #930027;
    color: white;
} */

.inline-block {
    display: inline-block;
}

.gap-3 {
    gap: 0.75rem;
}

.my-auto {
    margin-top: auto;
    margin-bottom: auto;
}

.underline {
    text-decoration: underline;
}

.text-\[16px\] {
    font-size: 16px;
}
.repeating-header thead {
    display: table-header-group;
}


/* Table styles */
.relative {
    position: relative;
}

.overflow-x-auto {
    overflow-x: auto;
}

.text-sm {
    font-size: 0.875rem;
}

.text-left {
    text-align: left;
}

.rtl\:text-right {
    text-align: right;
}

.text-gray-500 {
    color: #6B7280;
}

.text-xs {
    font-size: 0.75rem;
}

.text-gray-700 {
    color: #374151;
}

.uppercase {
    text-transform: uppercase;
}

.border-b {
    /* border-bottom: 1px solid #E5E7EB; */
}

.border-gray-500 {
    border-color: #6B7280;
}

.bg-gray-50 {
    background-color: white;
}

/* .px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.py-3 {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
} */

.bg-white {
    background-color: #fff;
}

/* .py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
} */
 .text-10{
    font-size: 10px;
}

.text-12{
    font-size: 12px;
}
.text-14 {
    font-size: 14px;
}

/* .mt-2 {
    margin-top: 0.5rem;
} */

/* Assembly items */
.accordion-collapse-wrapper {
    margin-bottom: 0.5rem;
}

.border-b-2 {
    /* border-bottom: 2px solid #E5E7EB; */
}

.bg-\[\#F5F5F5\] {
    background-color: #F5F5F5;
}

.w-3 {
    width: 0.75rem;
}

.h-3 {
    height: 0.75rem;
}

.rotate-180 {
    transform: rotate(180deg);
}

.shrink-0 {
    flex-shrink: 0;
}

/* Page break for printing */
/* .page-break-header {
    page-break-before: always;
} */

/* Lien release section */
/* .py-7 {
    padding-top: 1.75rem;
    padding-bottom: 1.75rem;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
} */

.text-\[\#6b7280\] {
    color: #6B7280;
}

/* Empty state */
.text-center {
    text-align: center;
}

/* .p-3 {
    padding: 0.75rem;
}

.m-2 {
    margin: 0.5rem;
}
.mb-2 {
    margin-bottom: 0.5rem;
}

.mb-8 {
    margin-bottom: 2rem;
} */

.mt-\[2px\] {
    margin-top: 2px;
}

/* Image styles */
img {
    display: inline-block;
    vertical-align: middle;
}
.text-left{
    text-align: left;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .sm\:grid-cols-10 {
        grid-template-columns: 1fr;
    }

    .col-span-8, .col-span-2 {
        grid-column: 1;
    }

    .text-right {
        text-align: left;
    }

    .flex {
        flex-direction: column;
    }

    .ml-2 {
        margin-left: 0;
        margin-top: 0.5rem;
    }
}


    </style>
</head>
<body>
    <div class="bg-white full-width">
        @if(count($estimate_items) > 0 || count($assemblies) > 0 || count($upgrades) > 0 || count($templates) > 0)
        <div class="py-" id="printableArea">
           <!-- Customer Info Section -->
<table width="100%" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <!-- Left Column -->
        <td width="70%" valign="top" >
            <p style="color:#F5222D; font-size:18px; font-weight:bold; margin:0;">
                {{ ucfirst($customer->customer_first_name) }} {{ ucfirst($customer->customer_last_name) }}
            </p>
            <p class="text-14" style="color:#323C47; font-size:16px; font-weight:600; margin:4px 0;">
                {{ $customer->customer_project_name }}
            </p>
            <p class="text-14" style="margin:6px 0; font-weight:500; display:flex; align-items:center;">
                <img src="{{ public_path('assets/icons/home-icon.svg') }}" alt="" width="14" height="14" style="vertical-align:middle;">
                <span style="padding-left:6px;">{{ $estimate->customer_address }}</span>
            </p>
            <p class="text-14" style="margin:6px 0; font-weight:500; display:flex; align-items:center;">
                <img src="{{ public_path('assets/icons/stat-icon.svg') }}" alt="" width="14" height="14" style="vertical-align:middle;">
                <span style="padding-left:6px;">Project Owner: {{ $customer->owner }}</span>
            </p>
            <p class="text-14" style="margin:6px 0; font-weight:500; display:flex; align-items:center;">
                <img src="{{ public_path('assets/icons/page-icon.svg') }}" alt="" width="14" height="14" style="vertical-align:middle;">
                <span style="padding-left:6px;">Estimate Pending Schedule</span>
            </p>
        </td>

        <!-- Right Column -->
        <td width="30%" valign="top" align="right" >
            <p class="text-14" style="font-weight:bold; margin:0; color:#323C47;">
                Work Order
            </p>
            <p class="text-14" style="margin:2px 0; font-weight:600; color:#323C47;">
                {{ $estimate->project_name }}
            </p>
            <p class="text-14" style="margin:2px 0; color:#323C47;">
                {{ $estimate->project_number }}
            </p>
            <p class="text-14" style="margin:2px 0; color:#323C47;">
                {{ $estimate->estimate_status }}
            </p>
            <p class="text-14" style="margin:2px 0; color:#323C47;">
                {{ date('m/d/y', strtotime($estimate->created_at)) }}
            </p>
        </td>
    </tr>
</table>


            @php
            $totalPrice = 0; // Initialize total price variable

            $groupedItems = [];
            foreach ($estimate_items as $groupItems) {
                // Get group name from either estimate group or global group
                $groupName = '';
                $group = null;

                if ($groupItems->estimate_group_id && $groupItems->estimateGroup) {
                    $groupName = $groupItems->estimateGroup->group_name ?? '';
                    $group = $groupItems->estimateGroup;
                    $group->is_estimate_specific = true;
                    // Ensure the group object has the correct ID field for JavaScript compatibility
                    $group->group_id = $group->estimate_group_id;
                } elseif ($groupItems->group_id && $groupItems->globalGroup) {
                    $groupName = $groupItems->globalGroup->group_name ?? '';
                    $group = $groupItems->globalGroup;
                    $group->is_estimate_specific = false;
                }else{
                    $groupName = $groupItems['group']['group_name'] ?? ''; // Use 'Other' if no group is associated
                }

                // Add the group object to the item for use in the view
                $groupItems->group = $group;
                $groupedItems[$groupName][] = $groupItems;
            }
            @endphp

            <!-- Main Items Section -->
            <div class="itemDiv col-span-10 overflow-auto rounded-lg">
                @if ( $estimate_items->count() > 0)

                    @foreach ($groupedItems as $groupName => $itemss)
                    @if (($itemss[0]->group->include_est_total ?? 0) != 0)
                        <div class=" bg-white  group-section">
                        <!-- Group Header - Keep with content if possible -->
                        <div class="p-1 text-black full-width rounded-t-lg group-header">
                            <div class="inline-block">
                                <div class="flex gap-3">
                                    <h1 class="font-medium my-auto p-2 underline text-[16px]">{{$groupName}}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto group-content">
                            <div class="itemDiv">
                                <table class="full-width text-1 text-left rtl:text-right text-gray-500 repeating-header">
                                    <thead class="text-10 text-gray-700 uppercase border-b border-gray-500 bg-gray-50 ">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left w-70">Item Name</th>
                                            <th scope="col" class="text-right w-30">Item Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($itemss as $item)
                                        <tr class="bg-white border-b item-with-description">
                                            <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                <label class="text-14 font-semibold text-[#323C47] underline" for="">{{ $item->item_name }}</label>
                                                <div class="text-[16px]/[18px] text-[#323C47] mt-2">
                                                    @if ($item->item_description)
                                                    <p class="font-medium">Description:</p>
                                                    <p class="text-12">{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}</p>
                                                    @endif

                                                    @if ($item->item_note)
                                                    <p class="font-medium">Note:</p>
                                                    <p class="text-12">{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($item->item_qty, 2) }} <br> {{ $item->item_unit }}
                                            </td>
                                        </tr>

                                        @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                        <tr>
                                            <td colspan="2">
                                                <div class="">
                                                    <div id="" class=" mb-2">
                                                        <div>
                                                            <div class="p-2">
                                                                <table class="full-width text-12 text-left rtl:text-right text-gray-500">
                                                                    <thead class="text-10 text-gray-700 uppercase border-b border-gray-500 bg-gray-50">
                                                                        <tr>
                                                                            <th scope="col" class="px-6 py-3 text-left">Item Name</th>
                                                                            <th scope="col" class="text-right">Item Qty</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($item->assemblies as $assembly)
                                                                        <tr class="bg-white border-b">
                                                                            <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                                                <p>{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}</p>
                                                                                <br>
                                                                                <p class="text-12">{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->ass_item_description) !!}</p>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <p class="text-12">{{number_format($assembly->ass_item_qty, 2)}} <br> {{$assembly->ass_item_unit}}</p>
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

                                        @php
                                        $totalPrice += $item->item_total; // Add item price to total
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                @endif
            </div>

            <!-- Additional Items Section -->
            @php
            $totalPrice = 0; // Initialize total price variable

            $groupedItems = [];
            foreach ($estimateAdditionalItems as $groupItems) {
                // Get group name from either estimate group or global group
                $groupName = '';
                $group = null;

                if ($groupItems->estimate_group_id && $groupItems->estimateGroup) {
                    $groupName = $groupItems->estimateGroup->group_name ?? '';
                    $group = $groupItems->estimateGroup;
                    $group->is_estimate_specific = true;
                    // Ensure the group object has the correct ID field for JavaScript compatibility
                    $group->group_id = $group->estimate_group_id;
                } elseif ($groupItems->group_id && $groupItems->globalGroup) {
                    $groupName = $groupItems->globalGroup->group_name ?? '';
                    $group = $groupItems->globalGroup;
                    $group->is_estimate_specific = false;
                }

                // Add the group object to the item for use in the view
                $groupItems->group = $group;
                $groupedItems[$groupName][] = $groupItems;
            }
            @endphp


                {{-- @if ($estimateAdditionalItems->count() > 0)py-7 px-4 page-break-header --}}
            <div class="">
                {{-- <h1 class="font-bold">Additional Items</h1> --}}
                <div class="itemDiv col-span-10 ml-2 overflow-auto rounded-lg border-[#0000004D] m-3">
                    @if ($estimateAdditionalItems->count() > 0)
                    <h1 class="text-[16px] font-bold">Additional Items</h1>
                        @foreach ($groupedItems as $groupName => $itemss)
                        <div class="mb-2 bg-white group-section">
                            <!-- Group Header - Keep with content if possible -->
                            <div class="p-1 full-width rounded-t-lg group-header">
                                <div class="inline-block">
                                    <div class="flex gap-3">
                                        <h1 class="font-medium my-auto p-2 text-14">{{$groupName}}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="relative overflow-x-auto mb-8 group-content">
                                <div class="itemDiv">
                                    <table class="full-width text-12 text-left rtl:text-right text-gray-500">
                                        <thead class="text-10 text-gray-700 uppercase bg-gray-50 ">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left">Item Name</th>
                                                <th scope="col" class="text-right">Item Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($itemss as $item)
                                            <tr class="bg-white border-b item-with-description">
                                                <td class="px-6 py-4" style="text-align:justify">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item->item_name }}</label>
                                                    <div class="text-12 text-[#323C47] font">
                                                        @if ($item->item_description)
                                                        <p class="font-medium">Description:</p>
                                                        {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}
                                                        @endif
                                                        @if ($item->item_note)
                                                        <p class="font-medium">Note:</p>
                                                        {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    {{ number_format($item->item_qty, 2) }} <br> {{ $item->item_unit }}
                                                </td>
                                            </tr>

                                            @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                            <tr>
                                                <td colspan="2">
                                                    <div class="accordion-collapse-wrapper">
                                                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                            {{-- <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between full-width p-2 text-left rounded-t-lg focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                                    <span></span>
                                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                                    </svg>
                                                                </button>
                                                            </h2> --}}
                                                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5]" aria-labelledby="accordion-collapse-heading-1">
                                                                <div class="p-2">
                                                                    <table class="full-width text-12 text-left rtl:text-right text-gray-500 bg-white">
                                                                        <thead class="text-10 text-gray-700 uppercase">
                                                                            <tr>
                                                                                <th scope="col" class="px-6 py-3 text-left">Item Name</th>
                                                                                <th scope="col" class="text-right">Item Qty</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($item->assemblies as $assembly)
                                                                            <tr class="bg-white border-b">
                                                                                <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}
                                                                                    <br>
                                                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->ass_item_description) !!}
                                                                                </td>
                                                                                <td class="text-right">
                                                                                    {{number_format($assembly->ass_item_qty, 2)}} <br> {{$assembly->ass_item_unit}}
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

                                            @php
                                            $totalPrice += $item->item_total; // Add item price to total
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Templates Section -->
            @foreach($templates as $template)
                <div class="flex justify-between p-3 bg-[#930027] text-white full-widthrounded-t-lg group-header">
                    <h1 class="font-medium my-auto">{{ $template->item_template_name }}</h1>
                </div>
                <div class="relative overflow-x-auto group-content">
                    <div class="itemDiv">
                        <table class="full-width text-12 text-left rtl:text-right text-gray-500">
                            <thead class="text-10 text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Check</th>
                                    <th scope="col" class="px-6 py-3">Item Name</th>
                                    <th scope="col" class="px-6 py-3">Item Description</th>
                                    <th scope="col" class="px-6 py-3">Item QTY</th>
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
                                        <label for="privilegeReportsView" class="text-gray-500"></label>
                                    </td>
                                    <td class="px-6 py-4">
                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $itemName->item_name }}</label>
                                    </td>
                                    <td class="px-6 py-4">
                                        <label class="text-lg font-semibold text-[#323C47]" for="">{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item['item_description']) !!}</label>
                                    </td>
                                    <td class="px-6 py-4">
                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_qty'] }}</label> <br> {{$itemName->item_units}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Upgrades Section -->
            @foreach($upgrades as $upgrade)
            <div class="mb-2 p-2 bg-white group-section page-break-header">
                <div class="flex justify-between p-3 bg-[#930027] text-white full-width rounded-t-lg group-header">
                    <h1 class="font-medium my-auto">{{ $upgrade->item_name }} ({{ $upgrade->upgrade_status }})</h1>
                    <h1 class="font-medium my-auto">QTY: {{ $upgrade->item_qty }}</h1>
                </div>
                <div class="relative overflow-x-auto group-content">
                    <div class="itemDiv">
                        <table class="full-width text-12 text-left rtl:text-right text-gray-500">
                            <thead class="text-10 text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">Check</th>
                                    <th scope="col" class="px-6 py-3 text-center">Item Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $assemblies = $upgrade->assemblies; // Fetch related EstimateItemAssembly items
                                @endphp
                                @foreach ($assemblies as $assembly)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 w-[70%]">
                                        <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                        <label for="privilegeReportsView" class="text-gray-500"></label>
                                    </td>
                                    <td class="px-6 py-4">
                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $assembly['est_ass_item_name'] }}</label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <hr>py-7 px-4 rounded-lg border --}}
             <div class="">
                    <h1 class="font-bold my-2 text-18 text-center">Lien Release</h1>
                    <p class="text-12 text-[#6b7280]  p-3" > The undersigned Lienor, in consideration of the final payment in the amount of <br>
                    $_______________________________, hereby waives and releases its lien and right to claim a lien for <br>
                    labor, services or materials furnished to River City Painting on the job of (Owner of Property):</p>
                    <p class="text-12 text-[#6b7280]  p-3">
                        Project Name: {{$estimate->project_name}}
                    </p>
                    <p class="text-12 text-[#6b7280]  p-3">
                        Job Name: {{$estimate->project_name}}
                    </p>
                    <p class="text-12 text-[#6b7280]  p-3">
                        Job Address: {{$estimate->customer_address}}
                    </p>
                    <p class="text-12 text-[#6b7280]  p-3"> Signature:___________________________________________________Date:__________________________ <br>
                        Printed Name: __________________________________________________________
                    </p>
                </div>
        </div>
        {{-- <hr> --}}
        @else
        <div class="py-1 text-center rounded-2xl">
            <div class="bg-[#F5F5F5] rounded-lg p-3">
                <h1>No Items Right Now!</h1>
            </div>
        </div>
        @endif
    </div>
</div>

</body>
</html>
