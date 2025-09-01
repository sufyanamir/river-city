<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Proposal</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: white;
            color: #333;
            line-height: 1.6;
        }

        /* Form Styles */
        #sendProposalForm {
            width: 100%;
            /* max-width: 1200px;
            margin: 0 auto;
            padding: 20px; */
        }

        .section-spacing {
            /* margin: 20px 0; */
        }

        .bg-white {
            background-color: white;
        }

        .full-width {
            width: 100%;
        }

        .overflow-auto {
            overflow: auto;
        }

        .rounded-lg {
            border-radius: 8px;
        }

        /* Grid System */
        .grid {
            display: grid;
            /* align-items: center; */
        }

        .grid-cols-12 {
            grid-template-columns: repeat(12, 1fr);
        }

        .col-span-6 {
            grid-column: span 6;
        }

        .col-span-12 {
            grid-column: span 12;
        }

        .grid-padding {
            padding: 10px;
        }

        .px-4 {
            padding-left: 16px;
            padding-right: 16px;
        }

        /* Typography */
        .text-10 {
            font-size: 10px;
        }

        .text-12 {
            font-size: 12px;
        }

        .text-14 {
            font-size: 14px
        }

        .text-16 {
            font-size: 16px;
        }

        .text-18 {
            font-size: 18px;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-primary {
            color: #323C47;
        }

        .text-secondary {
            color: #858585;
        }

        .text-right {
            text-align: right;
        }

        .center-margin {
            margin-left: auto;
            margin-right: auto;
        }

        /* Flexbox */
        .flex {
            display: flex;
        }

        .gap-6 {
            gap: 24px;
        }

        .gap-3 {
            gap: 12px;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .justify-between {
            justify-content: space-between;
        }

        .align-center {
            align-items: center;
        }

        /* Spacing */
        .mt-2 {
            margin-top: 4px;
        }

        .mt-5 {
            margin-top: 10px;
        }

        .mt-10 {
            margin-top: 15px;
        }

        .mb-2 {
            margin-bottom: 4px;
        }

        .mb-8 {
            margin-bottom: 20px;
        }

        .py-3 {
            padding-top: 6px;
            padding-bottom: 6px;
        }

        .py-4 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .px-6 {
            padding-left: 18px;
            padding-right: 18px;
        }

        .p-2 {
            padding: 6px;
        }

        .p-4 {
            padding: 10px;
        }

        .pb-6 {
            padding-bottom: 14px;
        }

        .sub_total_p {
            padding: 0px 10px 0px 0px;
            font-size: 14px;
            display: flex;
            justify-content: flex-end;
        }

        /* Borders */
        .border-bottom {
            border-bottom: 1px solid;
        }

        .border-black {
            border-color: black;
        }

        .border-primary {
            border-color: #323C47;
        }

        .border-solid {
            /* border: 1px solid #323C47; */
        }

        .rounded-md {
            border-radius: 6px;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px 6px;
            text-align: left;
        }

        /* thead {
            background-color: #f9f9f9;
        } */

        /* .table-header-bg {
            background-color: #f9f9f9;
        } */

        .uppercase {
            text-transform: uppercase;
        }

        .text-xs {
            font-size: 12px;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        /* .table-border-bottom {
            border-bottom: 1px solid #e5e5e5;
        } */

        /* Specific Components */
        /* .projectLogo img {
            width: 30%;
            height: 20%;
        } */

        .inline-block {
            display: inline-block;
        }

        .relative {
            position: relative;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        /* Buttons */
        button {
            cursor: pointer;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color: #930027;
            color: white;
        }

        .btn-primary:hover {
            background-color: #7a001f;
        }

        .float-right {
            float: right;
        }

        .text_area {
            height: 256px;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        .link-tag-color {
            color: #76a9f9
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            z-index: 10;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            display: none;
        }

        .modal-content {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            min-height: 100vh;
            padding: 16px 16px 80px 16px;
            text-align: center;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: #6b7280;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .modal-panel {
            display: inline-block;
            vertical-align: bottom;
            background-color: white;
            border-radius: 8px;
            text-align: left;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateX(0) translateY(0) rotate(0) skewX(0) skewY(0) scaleX(1) scaleY(1);
            transition: all 0.3s;
            max-width: 512px;
            width: 100%;
        }

        .modal-body {
            padding: 24px;
        }

        /* Input Styles */
        input,
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #0095E5;
            box-shadow: 0 0 0 2px rgba(0, 149, 229, 0.2);
        }

        /* Text Editor */
        .editor-container {
            margin-top: 20px;
            padding-inline: 12px;
            padding: 16px;
            background: white;
            border-radius: 8px
        }

        #editor {
            height: 256px;
            width: 100%;
            padding: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        /* Badges/Logos */
        .badges-container {
            text-align: center;
            margin-top: 20px;
        }

        .badge-item {
            display: inline-block;
            margin: 10px 30px;
            width: 120px;
            height: 120px;
            text-align: center;
            vertical-align: middle;
            line-height: 120px;
        }
        .badge_img_wh{
            width: 100px;
            height: 70px;
        }

        .badge-item img {
            /* max-width: 100px;
            max-height: 100px; */
            vertical-align: middle;
        }

        /* .width_padding{
            padding: 10px;
            width: 60px;
        }
        .table_img{
            width: 100%;
            text-align: center;
            margin-top:10px;
        } */

        .totals-table {
            width: 100%;
            margin-top: 6px;
            border-collapse: collapse;
            font-size: 14px;
        }

        .totals-table td.value-right {
            text-align: right;
            /* align both label and amount to the right */
            /* font-style: italic; */
            color: #333;
            padding: 2px 10px;
            font-size: 12px;
        }

        /*
.totals-table td {
    padding: 6px 12px;
    vertical-align: top;
}

.totals-table .label {
    text-align: left;
    font-style: italic;
    color: #333;
}

.totals-table .value {
    text-align: right;
    color: #555;
    font-weight: 500;
} */



        /* Responsive */
        @media (max-width: 768px) {
            .grid-cols-12 {
                grid-template-columns: 1fr;
            }

            .col-span-6 {
                grid-column: span 12;
            }

            .badges-container {
                flex-wrap: wrap;
                gap: 12px;
            }

            .text-right {
                text-align: left;
            }

            .modal-panel {
                width: 95%;
                margin: 0 auto;
            }
        }

        /* Utility Classes */
        .hidden {
            display: none;
        }

        .text-blue-400 {
            color: #60a5fa;
        }

        .bg-gray-100 {
            background-color: #f5f5f5;
        }

        .border-2 {
            border-width: 2px;
        }

        .w-3 {
            width: 12px;
        }

        .h-3 {
            height: 12px;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .shrink-0 {
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <form action="/sendProposal" method="post" id="sendProposalForm">
        @csrf
        <div class="section-spacing" id="printableArea">
            <div class="bg-white full-width overflow-auto rounded-lg">
                <style>
    .header-table {
        width: 100%;
        max-width: 900px; /* Centered width */
        margin: 0 auto; /* Center align the table */
        border-collapse: collapse;
    }

    .header-table td {
        vertical-align: top;
        padding: 10px;
    }



    .company-info {
        font-size: 12px;
        color: #555;
    }

    .company-info .title {
        font-size: 16px;
        font-weight: bold;
        color: #930027; /* Example primary color */
        margin-bottom: 5px;
    }

    .estimate-title {
        text-align: right;
        font-size: 16px;
        font-weight: bold;
        color: #930027;
    }

    .estimate-info {
        text-align: right;
        font-size: 12px;
        color: #666;
    }

    .customer-info {
        text-align: right;
        font-size: 12px;
        color: #444;
        margin-top: 10px;
    }

       .header-table {
        width: 100%;
        max-width: 900px; /* Centered width */
        margin: 0 auto; /* Center align the table */
        border-collapse: collapse;
    }

    .header-table td {
        vertical-align: top;
        padding: 10px;
    }

    .projectLogo img {
        width: 45%;
        height: 45%;
        /* max-width: 150px; */
        height: auto;
        display: block;
        margin-bottom: 10px;
    }

    .company-info {
        font-size: 12px;
        color: #555;
    }

    .company-info .title {
        font-size: 16px;
        font-weight: bold;
        color: #323C47; /* Example primary color */
        margin-bottom: 5px;
    }

    .estimate-title {
        text-align: right;
        font-size: 16px;
        font-weight: bold;
        color: #323C47;
    }

    .estimate-info {
        text-align: right;
        font-size: 12px;
        color: #666;
    }

    .customer-info {
        text-align: right;
        font-size: 12px;
        color: #444;
        margin-top: 10px;
    }
</style>

<table class="header-table">
    <tr>
        <!-- Left Column -->
        <td width="50%">
            <div class="projectLogo">
                <img src="{{ public_path('assets/images/projectLogo.jpg') }}" alt="Project Logo">
            </div>
            <div class="company-info">
                <p class="title">River City Painting, Inc</p>
                <p>
                    @if ($customer->branch == 'wichita')
                        4425 W Walker St<br>
                        Wichita Kansas 67209 <br>
                        info@paintwichita.com <br>
                        (316) 262-3289
                    @elseif($customer->branch == 'kansas')
                        12022 Blue Valley Pkwy<br>
                        Overland Park, Ks 66213 <br>
                        913-660-9099<br>
                        office@rivercitypaintinginc.com <br>
                    @elseif($customer->branch == 'tulsa')
                        1904 W Iola St unit 101,<br>
                        Broken Arrow, OK 74012 <br>
                        918-973-0242
                    @endif
                </p>
            </div>
        </td>

        <!-- Right Column -->
        <td width="50%">
            <p class="estimate-title">Estimate</p>
            <p class="estimate-info">
                {{ $customer->customer_project_number }} <br>
                {{ $estimate->created_at }}
            </p>
            <div class="customer-info">
                <p>{{ ucfirst($customer->customer_first_name) }} {{ ucfirst($customer->customer_last_name) }}</p>
                <p>{{ $estimate->customer_address }}</p>
                <p>{{ $customer->customer_email }}</p>
                <p>{{ $customer->customer_phone }}</p>
                <br>
                <p>{{ $customer->customer_project_name }}</p>
            </div>
        </td>
    </tr>
</table>

                <div class="grid grid-cols-12 grid-padding">
                    {{-- <div class="col-span-6 px-4">
                        <div class="projectLogo">

                            <img src="{{ public_path('assets/images/projectLogo.jpg') }}" alt="">
                        </div>
                        <div class="px-4">
                            <p class="text-16 font-bold text-primary">River City Painting, Inc</p>
                            <p class="mt-2 font-medium text-12 text-secondary">
                                @if ($customer->branch == 'wichita')
                                    4425 W Walker St<br>
                                    Wichita Kansas 67209 <br>
                                    info@paintwichita.com <br>
                                    (316) 262-3289
                                @elseif($customer->branch == 'kansas')
                                    12022 Blue Valley Pkwy<br>
                                    Overland Park, Ks 66213 <br>
                                    913-660-9099
                                    <br>
                                    office@rivercitypaintinginc.com <br>
                                @elseif($customer->branch == 'tulsa')
                                    1904 W Iola St unit 101, <br>
                                    Broken Arrow, OK 74012 <br>
                                    918-973-0242
                                    <br>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="col-span-6 px-4">
                        <div class="">
                            <p class="text-right text-16 font-bold text-primary">Estimate</p>
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ $customer->customer_project_number }} <br>
                                {{ $estimate->created_at }}
                            </p>
                        </div>
                        <div class="">
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ ucfirst($customer->customer_first_name) }}
                                {{ ucfirst($customer->customer_last_name) }}
                            </p>
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ $estimate->customer_address }}
                            </p>
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ $customer->customer_email }}
                            </p>
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ $customer->customer_phone }}
                            </p>
                            <br>
                            <p class="text-right font-medium text-12 text-secondary">
                                {{ $customer->customer_project_name }}
                            </p>
                        </div>
                    </div> --}}
                    {{-- <table class="table_img">
                        <tr>
                            <td class="width_padding">
                                <img src="{{ public_path('assets/images/PCA-Logo-RGB .png') }}" alt="PCA Logo">
                            </td>
                            <td class="width_padding">
                                <img src="{{ public_path('assets/images/RCP Badges-02.png') }}" alt="RCP Badge">
                            </td>
                            <td class="width_padding">
                                <img src="{{ public_path('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" alt="EPA Badge">
                            </td>
                            <td class="width_padding">
                                <img src="{{ public_path('assets/images/RCP-Badges-01.png') }}" alt="RCP Badge">
                            </td>
                        </tr>
                    </table> --}}
                    <div class="badges-container">
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/PCA-Logo-RGB .png') }}" alt="PCA Logo">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/RCP-Badges-02.png') }}" alt="RCP Badge">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}"
                                alt="EPA Badge">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/RCP-Badges-01.png') }}" alt="RCP Badge">
                        </div>
                    </div>
                </div>

                    {{-- <div class="col-span-12 center-margin">
                        <div class="badges-container">
                            <div class="badge-item">
                                <img src="{{ public_path('assets/images/PCA-Logo-RGB .png') }}" alt="PCA Logo">
                            </div>
                            <div class="badge-item">
                                <img src="{{ public_path('assets/images/RCP Badges-02.png') }}" alt="RCP Badge">
                            </div>
                            <div class="badge-item">
                                <img src="{{ public_path('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" alt="RCP Badge">

                            </div>
                            <div class="badge-item">
                                <img src="{{ public_path('assets/images/RCP-Badges-01.png') }}" alt="RCP Badge">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-span-12">
                        <div class="text-primary font-medium  border-solid">
                            @php
                                $subTotal = 0;
                            @endphp
                            <div id="printableArea">
                                @php
                                    $groupedItems = [];
                                    foreach ($estimate_items as $groupItems) {
                                        $groupName = '';
                                        $group = null;

                                        if ($groupItems->estimate_group_id && $groupItems->estimateGroup) {
                                            $groupName = $groupItems->estimateGroup->group_name ?? '';
                                            $group = $groupItems->estimateGroup;
                                            $group->is_estimate_specific = true;
                                            $group->group_id = $group->estimate_group_id;
                                        } elseif ($groupItems->group_id && $groupItems->globalGroup) {
                                            $groupName = $groupItems->globalGroup->group_name ?? '';
                                            $group = $groupItems->globalGroup;
                                            $group->is_estimate_specific = false;
                                        }

                                        $groupItems->group = $group;
                                        $groupedItems[$groupName][] = $groupItems;
                                    }
                                @endphp
                                <div class="itemDiv col-span-10 overflow-auto rounded-lg border-[#0000004D]">
                                    @if ($estimate_items->count() > 0)
                                        @foreach ($groupedItems as $groupName => $itemss)
                                            <div class="mb-2 bg-white">
                                                <div class="group-card bg-white text-black">
                                                    <div class="inline-block">
                                                        @if ($groupName)
                                                            <div id="cuttingDiv" class="flex gap-3">
                                                                <h1
                                                                    class="font-bold text-16 align-center p-2 underline">
                                                                    {{ $groupName }}</h1>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="relative overflow-x-auto">
                                                    <div class="itemDiv">
                                                        <table
                                                            class="full-width text-sm text-left rtl:text-right text-gray-500">
                                                            <thead
                                                                class="text-xs text-gray-700 uppercase table-header-bg">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-10">
                                                                        Item Name
                                                                    </th>
                                                                    @foreach ($itemss as $singleItem)
                                                                        @php
                                                                            $showItemQty = 0;
                                                                            $showItemTotal = 0;
                                                                            $singleItem->group->show_quantity == 1
                                                                                ? ($showItemQty = 1)
                                                                                : 0;
                                                                            $singleItem->group->show_total == 1
                                                                                ? ($showItemTotal = 1)
                                                                                : 0;
                                                                        @endphp
                                                                    @endforeach
                                                                    @if ($showItemQty == 1)
                                                                        <th scope="col" class="text-center text-10">
                                                                            Item Qty
                                                                        </th>
                                                                    @endif
                                                                    @if ($showItemTotal == 1)
                                                                        <th scope="col" class="text-center text-10">
                                                                            Item Total
                                                                        </th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $groupTotal = 0;
                                                                    $incEstTotal = 0;
                                                                @endphp
                                                                @foreach ($itemss as $item)
                                                                    <tr class="bg-white table-border-bottom">
                                                                        @php
                                                                            $showQty =
                                                                                $item->group &&
                                                                                $item->group->show_quantity == 1;
                                                                            $showTotal =
                                                                                $item->group &&
                                                                                $item->group->show_total == 1;
                                                                            $colspan = !$showQty && !$showTotal ? 3 : 1;
                                                                        @endphp
                                                                        <td class="px-6 py-4 w-[70%]"
                                                                            colspan="{{ $colspan }}">
                                                                            <label
                                                                                class="text-lg font-semibold text-primary underline"
                                                                                for="">{{ $item->item_name }}</label>
                                                                            <p
                                                                                class="text-[16px]/[18px] text-primary pt-2">
                                                                                @if ($item->item_description)
                                                                                    <p class="font-medium text-10">
                                                                                        Description:
                                                                                        {!! formatText($item->item_description) !!}
                                                                                    </p>
                                                                                @endif
                                                                                @if ($item->item_note)
                                                                                    <p class="font-medium text-10">Note:
                                                                                        {!! formatText($item->item_note) !!}
                                                                                    </p>
                                                                                @endif
                                                                            </p>
                                                                        </td>
                                                                        @if ($showQty)
                                                                            <td scope="col"
                                                                                class="text-center text-10">
                                                                                {{ number_format($item->item_qty, 2) }}
                                                                                <br> {{ $item->item_unit }}
                                                                            </td>
                                                                        @endif
                                                                        @if ($showTotal)
                                                                            <td scope="col"
                                                                                class="text-center text-10">
                                                                                ${{ number_format($item->item_total, 2) }}
                                                                            </td>
                                                                        @endif
                                                                        @php
                                                                            if (
                                                                                isset($item->group->show_group_total) &&
                                                                                $item->group->show_group_total == 1
                                                                            ) {
                                                                                $groupTotal += $item->item_total;
                                                                            }
                                                                        @endphp
                                                                        @php
                                                                            if (
                                                                                isset(
                                                                                    $item->group->include_est_total,
                                                                                ) &&
                                                                                $item->group->include_est_total == 1
                                                                            ) {
                                                                                $incEstTotal = 1;
                                                                                $subTotal += $item->item_total;
                                                                            } else {
                                                                                if (
                                                                                    $item->upgrade_status == 'accepted'
                                                                                ) {
                                                                                    $subTotal += $item->item_total;
                                                                                }
                                                                            }
                                                                            $acceptorreject = $item->upgrade_status;
                                                                        @endphp
                                                                @endforeach
                                                                <tr>
                                                                    <th class="text-14">
                                                                        @if ($incEstTotal == 0 || $acceptorreject == 'rejected')
                                                                            **Not include in Estimate Total**
                                                                        @endif
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-right py-3 text-14" colspan="7">
                                                                        Group Total:
                                                                        {{ number_format($groupTotal, 2) }}
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
                            @if (count($upgrades) > 0)
                                <div class="mb-2 bg-white">
                                    <div class="p-1 bg-[#930027] text-white full-width rounded-t-lg">
                                        <div class="inline-block">
                                            <div class="flex gap-3">
                                                <h1 class="font-medium align-center p-2"></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative overflow-x-auto mb-8">
                                        <div class="itemDiv">
                                            <table class="full-width text-sm text-left rtl:text-right text-gray-500">
                                                <thead class="text-xs text-gray-700 uppercase table-header-bg">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-10">
                                                            Item Name
                                                        </th>
                                                        <th scope="col" class="text-center text-10">
                                                            Item Qty
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Item Total
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($upgrades as $upgrade)
                                                        <tr class="bg-white table-border-bottom">
                                                            <td class="px-6 py-4">
                                                                <label class="text-lg font-semibold text-primary"
                                                                    for="">{{ $upgrade->item_name }}</label>
                                                                <p class="text-[16px]/[18px] text-primary font">
                                                                    @if ($upgrade->item_description)
                                                                        <p class="font-medium text-10">Description:</p>
                                                                        {!! formatText($upgrade->item_description) !!}
                                                                    @endif
                                                                    @if ($upgrade->item_note)
                                                                        <p class="font-medium text-10">Note:</p>
                                                                        {!! formatText($upgrade->item_note) !!}
                                                                    @endif
                                                                </p>
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $upgrade->item_qty }} <br>
                                                                {{ $upgrade->item_unit }}
                                                            </td>
                                                            <td class="text-center">
                                                                ${{ $upgrade->item_total }}
                                                            </td>
                                                        <tr>
                                                            <td colspan="7">
                                                                <div class="">
                                                                    <div id="accordion-collapse{{ $upgrade->estimate_item_id }}"
                                                                        class="accordion-collapse mb-2"
                                                                        data-accordion="collapse">
                                                                        <h2 id="accordion-collapse-heading-1"
                                                                            class="border-2">
                                                                            <button type="button"
                                                                                class="flex align-center bg-gray-100 justify-between full-width p-2 text-left rounded-t-lg focus:ring-gray-200"
                                                                                data-accordion-target="#accordion-collapse-body-1"
                                                                                aria-expanded="true"
                                                                                aria-controls="accordion-collapse-body-1">
                                                                                <span></span>
                                                                                <svg data-accordion-icon
                                                                                    class="w-3 h-3 rotate-180 shrink-0"
                                                                                    aria-hidden="true"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 10 6">
                                                                                    <path stroke="currentColor"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M9 5 5 1 1 5" />
                                                                                </svg>
                                                                            </button>
                                                                        </h2>
                                                                        <div id="accordion-collapse-body{{ $upgrade->estimate_item_id }}"
                                                                            class="accordion-collapse-body bg-gray-100"
                                                                            aria-labelledby="accordion-collapse-heading-1">
                                                                            <div class="p-2">
                                                                                <table
                                                                                    class="full-width text-sm text-left rtl:text-right text-gray-500">
                                                                                    <thead
                                                                                        class="text-xs text-gray-700 uppercase table-header-bg">
                                                                                        <tr>
                                                                                            <th scope="col"
                                                                                                class="px-6 py-3"></th>
                                                                                            <th scope="col"
                                                                                                class="px-6 py-3">
                                                                                                Item Name
                                                                                            </th>
                                                                                            <th scope="col"
                                                                                                class="px-6 py-3">
                                                                                                Item Description
                                                                                            </th>
                                                                                            <th scope="col"
                                                                                                class="text-center">
                                                                                                Item Qty
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($upgrade->assemblies as $assembly)
                                                                                            <tr
                                                                                                class="bg-white table-border-bottom">
                                                                                                <td class="px-6 py-4">
                                                                                                </td>
                                                                                                <td class="px-6 py-4">
                                                                                                    {{ $assembly->est_ass_item_name }}
                                                                                                </td>
                                                                                                <td
                                                                                                    class="px-6 py-4 w-[30%]">
                                                                                                    {{ $assembly->ass_item_description }}
                                                                                                </td>
                                                                                                <td
                                                                                                    class="text-center">
                                                                                                    {{ $assembly->ass_item_qty }}
                                                                                                    <br>
                                                                                                    {{ $assembly->ass_item_unit }}
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
                                                            $subTotal += $upgrade->item_total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <table class="totals-table">
                            <tr>
                                <td class="value-right">Sub Total: ${{ number_format($subTotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="value-right">Tax: {{ number_format($estimate->tax_rate, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="value-right">
                                    Total: ${{ number_format($subTotal + ($subTotal * $estimate->tax_rate) / 100, 2) }}
                                </td>
                            </tr>

                            @php
                                $estimateTotal = $subTotal;
                                $percentageDiscount = $estimate->percentage_discount;
                                $priceDiscount = $estimate->price_discount;

                                if ($percentageDiscount) {
                                    $discountedTotal = $estimateTotal - $estimateTotal * ($percentageDiscount / 100);
                                } elseif ($priceDiscount) {
                                    $discountedTotal = $estimateTotal - $priceDiscount;
                                } else {
                                    $discountedTotal = null;
                                }
                            @endphp

                            @if ($discountedTotal)
                                <tr>
                                    <td class="value-right">Discounted Total:
                                        ${{ number_format($discountedTotal, 2) }}</td>
                                </tr>
                            @endif
                        </table>



                    </div>
                </div>
                <div class=" grid col-span-12 editor-container">
                    {{-- @if ($preview == null)
                        <textarea name="terms_and_conditions" id="editor" class="text_area ">
                    @endif --}}
                    <p class="text-14"><strong>Required Deposit</strong></p>
                    <p class="text-10">A nonrefundable 1/3 deposit is required for all projects due at the time of
                        scheduling to secure your spot on our schedule. The remaining balance will be due upon
                        completion.</p>

                    <p class="text-14"><strong>Final Walkthrough</strong></p>
                    <p class="text-10">If final walkthrough is unable to be done within 3 days of project completion
                        then customer will be sent final invoice for full amount and payment is due.</p>

                    <p class="text-14"><strong>Color Policy</strong></p>
                    <p class="text-10">Please list all color numbers and names with specified areas to be painted and
                        email to @if ($customer->branch == 'wichita')
                            <a class="link-tag-color" href="https://paintwichita.com/">info@paintwichita.com</a>
                        @elseif($customer->branch == 'kansas')
                            <a class="link-tag-color"
                                href="https://office@rivercitypaintinginc.com/">office@rivercitypaintinginc.com</a>
                        @endif
                        no later than three days before your projected start date. You may also call
                        @if ($customer->branch == 'wichita')
                            (316) 262-3289
                        @elseif($customer->branch == 'kansas')
                            913-660-9099
                        @endif no later than three days before your projected start date. You may
                        also call to list your colors. Prices may vary for multiple color schemes, deep colors, and
                        accent walls that are not noted on your estimate.
                    </p>

                    <p class="text-14"><strong>Paint Samples</strong></p>
                    <p class="text-10">Sample colors can be done at the request of customer when project starts but
                        before full paint quantities have been purchased. If customer requests samples to be painted
                        prior to work beginning then customer will be charged one additional labor hour rate of $48 per
                        hour. If full paint quantities have been purchased and customer requests to make a color change,
                        customer will be billed AT COST for purchase of paint as large paint orders cannot be returned.
                    </p>

                    <p class="text-14"><strong>Professional Standards</strong></p>
                    <p class="text-10">Our company follows professional standards from guidelines of the “Painting
                        Contractors of America” for all touch-ups and damage repair, please refer to PCA P1-92.
                        Inspection of completed work will be done by the customer according to PCA Standards (Painting
                        Contractors of America) which states: “In order to determine whether a surface has been
                        “properly painted” it shall be examined without magnification at a distance of thirty-nine (39)
                        inches or one (1) meter, or more, under finished lighting conditions and from a normal viewing
                        position.”</p>

                    <p class="text-14"><strong>Quality Standards</strong></p>
                    <p class="text-10">We will only use the finest quality products as an investment in your property.
                        NOTE: some degree of yellowing must be expected with the aging of all paints. Rework caused by
                        others will be completed at an hourly rate of $95.00 per hour, with a minimum of two hours.
                        Change Order: Any changes from original will need to be brought to the attention of Project
                        Manager of River City Painting office so that a change order can be completed and approved by
                        customer. We will not deviate from original work order unless all items and pricing have been
                        approved.</p>

                    <p class="text-14"><strong>Photographs</strong></p>
                    <p class="text-10">River City Painting, Inc. assumes the right to take photographs of all work
                        performed on your site to use in our advertising and marketing efforts.</p>

                    <p class="text-14"><strong>General</strong></p>
                    <p class="text-10">An area in the garage or a place to park the River City Painting trailer may be
                        needed to store materials, tools, and equipment during the course of your project. River City
                        Painting would like permission to set a yard sign during work. Any damage such as dry rot,
                        termites, mold, etc. may not be apparent during initial inspection for a variety of reasons. Any
                        damage or additional work required that was not on the original estimate will be discussed with
                        the homeowner prior to any repairs being completed. The job site will be kept clean and debris
                        will be hauled away upon completion. The customer shall not directly or indirectly interfere
                        with River City Painting crew members in any way during the project. This stops the flow of the
                        painter and disrupts the pattern and final outcome. Customer interference may result in
                        additional labor and/or material charges. We cannot be held responsible for after-the-fact
                        items, which could result in us having to stop in the middle of a project. We have an Office
                        staff as well as a project manager staffed during business hours to assist you with anything you
                        need, so feel free to give us a call. Customer agrees to allow access to project area of
                        customers’ home between the hours of 8:30am - 5:00pm, Mon-Fri from the start of the project
                        through completion. Hours/days spent at customer home can vary due to a number of variables.
                        Employee and/or contractor may come and go during the above hours/days, according to what is
                        most efficient each day to complete the job correctly. Sometimes there are circumstances that
                        arise where we may ask to work outside of the above hours but we will always receive your
                        permission before doing so. We do our best to keep you informed of the process but you are
                        always welcome to check with your project manager or the office anytime you have questions.
                        River City Painting, Inc. is a member of the Wichita Executives Association, Painting
                        Contractors of America, and The Better Business Bureau. We are fully insured for your
                        protection! ESTIMATES ARE FOR COMPLETING THE JOB AS DESCRIBED IN THE ESTIMATE. IT IS A SET PRICE
                        PER JOB AND IS BASED UPON OUR EVALUATION. IT DOES NOT INCLUDE INCREASES FOR ADDITIONAL LABOR OR
                        MATERIALS WHICH MAY BE REQUIRED SHOULD UNFORESEEN PROBLEMS ARISE. ALL WORKMANSHIP IS GUARANTEED
                        FOR THREE YEARS WITH THE EXCEPTION OF DECK PAINTING/STAINING AND GENERAL STAINING WHICH IS NOT
                        WARRANTIED. THE PRICES INCLUDED IN YOUR ESTIMATE ARE FOR COMPLETE JOB BOOKING. SHOULD YOU DECIDE
                        ON ONLY A PORTION OF THE ESTIMATE, PRICING MAY VARY, AS WE GIVE PRICE BREAKS ON LARGER
                        ESTIMATES. Any changes to the specifications above must be requested by the Client and approved
                        by the Project Manager. Additional charges may apply and will be payable upon completion. All
                        agreements are contingent based upon weather changes during and prior to your project that is
                        outside of our control.</p>

                    <p class="text-14"><strong>Acceptance</strong></p>
                    <p class="text-10">The above prices, specifications, and conditions are satisfactory and are hereby
                        accepted. You are authorized to do the work as specified. Payment will be made as outlined
                        above. Both parties agree to a three-day (3) right to cancel on all signed/dated contracts. "YOU
                        THE BUYER, MAY CANCEL THIS TRANSACTION AT ANY TIME PRIOR TO MIDNIGHT OF THE THIRD BUSINESS DAY
                        AFTER THE DATE OF THIS TRANSACTION. SEE THE ATTACHED NOTICE OF CANCELLATION FORM FOR AN
                        EXPLANATION OF THIS RIGHT." For purposes of the required notices under this section, the term
                        "buyer" shall have the same meaning as the term "consumer".</p>

                    <p class="text-14"><strong>Final Payment Terms</strong></p>
                    <p class="text-10">The customer agrees to pay the entire remaining balance owed for their project
                        on the day of completion/installation. Failure to do so will result in a 10% weekly late fee for
                        the first six weeks and an 18% monthly interest fee from six weeks (added to the balance owed),
                        until paid in full. The customer will also be responsible for all attorney/legal/court/lien fees
                        paid by the contractor to collect payment.</p>

                    <p class="text-14"><strong>Compensation</strong></p>
                    <p class="text-10">Client shall pay as set forth in this document. Price is subject to change, with
                        customer’s approval.</p>

                    <p class="text-14"><strong>Invoicing & Payment</strong></p>
                    <p class="text-10">Invoice will be issued to Client upon Completion of the work client shall pay
                        invoice within 10 days of client’s receipt of the invoice. Client shall also pay a late charge
                        of 1-1/2% per month on all balances unpaid 30 days after the invoice date.</p>
                    {{-- @if ($preview == null)
                    </textarea>
                         @endif --}}
                </div>

            </div>
        </div>
        </div>
    </form>

</body>

</html>
