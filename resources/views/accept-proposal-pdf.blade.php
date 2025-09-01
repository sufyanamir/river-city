<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Proposal</title>
    <style>
        /* Base styling for PDF generation */
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

        .width-60{
            width: 60%;
        }
        .width-20{
            width: 20%;
            text-align: right;
        }
        /* Layout and structure */
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

        /* Header table */
          table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 8px 12px;
            text-align: left;
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

        /* .projectLogo {
            margin-bottom: 15px;
        }

        .projectLogo img {
            max-width: 50%;
            height: auto;
        } */

        .company-info p {
            margin: 5px 0;
            line-height: 1.4;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            color: #323C47;
            margin-bottom: 10px;
        }
/*
        .customer-info p {
            text-align: right;
            color: #858585;
            font-size: 12px;
            margin: 3px 0;
        } */

        /* Badges container */
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

        /* Content styling */
        .grid{
            display: grid;
        }
        .grid-padding {
            padding: 0 15px;
        }
        .grid-paddingbadge {
            padding: 20px;
        }
        .term_condition p{
            font-size: 10px;
        }
        .term_condition p strong{
            font-size: 12px;
        }

        .text-primary {
            color: #323C47;
        }

        .font-medium {
            font-weight: 500;
        }

        .border-bottom {
            border-bottom: 1px solid #323C47;
        }

        .pb-6 {
            padding-bottom: 24px;
        }

        .border-solid {
            /* border-style: solid; */
        }

        /* Group card */
        .group-card {
            background-color: white;
            padding: 8px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .w-full {
            width: 100%;
        }

        /* Item div */
        /* .itemDiv {
            margin-bottom: 20px;
        } */

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px 12px;
            /* border: 1px solid #e5e7eb; */
            vertical-align: top;
        }

        th {
            background-color: white;
            font-weight: bold;
        }

        .table-header-bg {
            /* background-color: #f9fafb; */
        }

        .text-10 {
            font-size: 10px;
        }

        .text-14 {
            font-size: 14px;
        }

        .text-12 {
            font-size: 12px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .table-border-bottom {
            border-bottom: 1px solid #e5e7eb;
        }

        /* Totals table */
        .totals-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            font-size: 14px;
        }
        .totals-table td.value-right {
            text-align: right;
            /* align both label and amount to the right */
            /* font-style: italic; */
            color: #333;
            padding: 6px 12px;
        }

        /* Button styling */
        .bg-930027 {
            background-color: #930027;
        }

        .text-white {
            color: white;
        }

        .px-10 {
            padding-left: 40px;
            padding-right: 40px;
        }

        .py-2 {
            padding: 8px;
        }

        .rounded-md {
            border-radius: 6px;
        }

        /* Signature area */
        #signatureCanvas {
            border: 1px solid #000;
            width: 100%;
            height: 120px;
        }

        /* Status badges */
        .bg-green-100 {
            background-color: #dcfce7;
        }

        .text-green-800 {
            color: #166534;
        }

        .bg-red-100 {
            background-color: #fee2e2;
        }

        .text-red-800 {
            color: #991b1b;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                padding: 10px;
                font-size: 11px;
            }

            /* Hide elements that shouldn't print */
            #addSign,
            .modal-close,
            #saveButton,
            #addSign-modal,
            input[type="radio"],
            input[type="checkbox"] {
                display: none !important;
            }

            /* Ensure good contrast for printing */
            .text-primary {
                color: #000 !important;
            }

            .text-858585 {
                color: #444 !important;
            }

            /* Force background colors when printing */
            .bg-930027,
            .bg-gray-50,
            .bg-green-100,
            .bg-red-100 {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Improve spacing for print */
            .section-spacing {
                margin: 15px 0;
            }

            .p-5 {
                padding: 15px;
            }

            .mb-8 {
                margin-bottom: 20px;
            }
        }

        /* Utility classes */
        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .align-center {
            align-items: center;
        }

        .my-auto {
            margin-top: auto;
            margin-bottom: auto;
        }

        .mx-2 {
            margin-left: 8px;
            margin-right: 8px;
        }

        .my-10 {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .grid {
            display: grid;
            /* align-items: center; */
        }
        .grid-cols-12 {
            grid-template-columns: repeat(12, 1fr);
        }
        .col-span-12 {
            grid-column: span 12;
        }
        .col-span-6 {
            grid-column: span 6;
        }

        .col-span-10 {
            grid-column: span 10;
        }

        .inline-block {
            display: inline-block;
        }

        .p-1 {
            padding: 4px;
        }

        .p-2 {
            padding: 8px;
        }

        .p-3 {
            padding: 12px;
        }

        .p-4 {
            padding: 16px;
        }

        .text-xl {
            font-size: 16px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-semibold {
            font-weight: 600;
        }

        .underline {
            text-decoration: underline;
        }

        .gap-3 {
            gap: 12px;
        }

        .relative {
            position: relative;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-8 {
            margin-bottom: 32px;
        }

        .w-70 {
            width: 70%;
        }

        .pt-2 {
            padding-top: 8px;
        }

        .py-3 {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .py-4 {
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .px-6 {
            padding-left: 24px;
            padding-right: 24px;
        }

        .border-b {
            /* border-bottom: 1px solid #e5e7eb; */
        }

        .mt-5 {
            margin-top: 20px;
        }

        .dynamic-total {
            font-weight: bold;
        }
        .item_left{
            text-align: left;
        }
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
    </style>
</head>
<body>
    <form action="/acceptProposal/{{ $estimate['estimate_id'] }}" method="post" id="proposalForm">
        @csrf
        <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">
        <input type="hidden" name="proposal_group_id" value="{{ $group_id }}">

        <div class="section-spacing" id="printableArea">
            <div class="bg-white full-width overflow-auto rounded-lg">
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
                                    @elseif($customer['branch'] == 'tulsa')
                                    1904 W Iola St unit 101, <br>
                                    Broken Arrow, OK 74012 <br>
                                    918-973-0242
                                    <br>
                                    @endif
                                </p>
                            </div>
                        </td>

                        <!-- Right Column -->
                        <td width="50%">
                            <p class="estimate-title">Estimate</p>
                            <p class="estimate-info">
                                {{ $customer['customer_project_number'] }} <br>
                                {{ $estimate['created_at'] }}
                            </p>
                            <div class="customer-info">
                                <p>{{ ucfirst($customer['customer_first_name']) }} {{ ucfirst($customer['customer_last_name']) }}</p>
                                <p>{{ $customer['customer_primary_address'] }}</p>
                                <p> {{ $customer['customer_city'] }} {{ $customer['customer_state'] }}
                                {{ $customer['customer_zip_code'] }}</p>
                                <p>{{ $customer['customer_email'] }}</p>
                                <br>
                                <p>{{ $customer['customer_phone'] }}</p>
                                <p>{{ $customer['customer_project_name'] }}</p>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="gridcgrid-cols-12 grid-paddingbadge">
                    <div class="badges-container">
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/PCA-Logo-RGB .png') }}"
                                alt="PCA Logo">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/RCP-Badges-02.png') }}"
                                alt="RCP Badge">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh"
                                src="{{ public_path('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}"
                                alt="EPA Badge">
                        </div>
                        <div class="badge-item">
                            <img class="badge_img_wh" src="{{ public_path('assets/images/RCP-Badges-01.png') }}"
                                alt="RCP Badge">
                        </div>
                    </div>
                </div>

                <div class="col-span-12">
                    <div class="text-primary font-medium border-bottom pb-6 border-solid">
                        @php
                        $subTotal = 0;
                        $groupedItems = [];

                        foreach ($estimate_items as $groupItems) {
                            // Get group name from either estimate group or global group
                            $groupName = '';
                            $group = null;

                            // Check for estimate group first
                            if (!empty($groupItems['estimate_group_id']) &&
                                isset($groupItems['estimate_group']) &&
                                is_array($groupItems['estimate_group']) &&
                                !empty($groupItems['estimate_group'])) {

                                $groupName = $groupItems['estimate_group']['group_name'] ?? '';
                                $group = $groupItems['estimate_group'];
                                $group['is_estimate_specific'] = true;
                                // Ensure the group object has the correct ID field for JavaScript compatibility
                                $group['group_id'] = $group['estimate_group_id'] ?? null;
                                $groupItems['group'] = $group;
                            }
                            // Check for global group if estimate group is not found
                            elseif (!empty($groupItems['group_id']) &&
                                    isset($groupItems['global_group']) &&
                                    is_array($groupItems['global_group']) &&
                                    !empty($groupItems['global_group'])) {

                                $groupName = $groupItems['global_group']['group_name'] ?? '';
                                $group = $groupItems['global_group'];
                                $group['is_estimate_specific'] = false;
                                $groupItems['group'] = $group;
                            } else {
                                $groupName = $groupItems['group']['group_name'] ?? ''; // Use 'Other' if no group is associated
                            }

                            // Add the group object to the item for use in the view
                            $groupedItems[$groupName][] = $groupItems;
                        }
                        @endphp

                        @if (count($estimate_items) > 0)
                            @foreach ($groupedItems as $groupName => $itemss)
                            <div class="mb-2 bg-white">
                                <div class="group-card bg-white text-black">
                                    <div class="inline-block">
                                        @if ($groupName)
                                        <div class="flex justify-between">
                                            <div id="cuttingDiv">
                                                <h1 class="font-bold text-12 my-auto p-2 underline">{{$groupName}}</h1>
                                                @php
                                                $groupTotal = 0;
                                                foreach($itemss as $item) {
                                                    if(isset($item['group']['show_group_total']) && $item['group']['show_group_total'] == 1) {
                                                        $groupTotal += $item['item_total'];
                                                    }
                                                }
                                                @endphp
                                                <input type="hidden" class="group-total" data-group-id="{{$item['estimate_group_id'] ?? $item['group_id']}}" value="{{$groupTotal}}">
                                            </div>
                                            @if(isset($item['group']['include_est_total']) && $item['group']['include_est_total'] == 0)
                                            {{-- <div class="my-auto mx-2 text-12">
                                                <div class="inline-block p-3 rounded-md bg-green-100">
                                                    <input type="radio"
                                                    name="group_accept_reject_{{$item['estimate_group_id'] ?? $item['group_id']}}"
                                                    value="accepted"
                                                    class="group-radio"
                                                    data-group-id="{{$item['estimate_group_id'] ?? $item['group_id']}}"
                                                    data-proposal-id="{{$proposal_id}}"
                                                    {{ $item['upgrade_status'] == 'accepted' ? 'checked' : '' }}>
                                                    <label class="text-green-800">Accept</label>
                                                </div>
                                                |
                                                <div class="inline-block p-3 rounded-md bg-red-100">
                                                    <input type="radio"
                                                        name="group_accept_reject_{{$item['estimate_group_id'] ?? $item['group_id']}}"
                                                        value="rejected"
                                                        class="group-radio"
                                                        data-group-id="{{$item['estimate_group_id'] ?? $item['group_id']}}"
                                                        data-proposal-id="{{$proposal_id}}"
                                                        {{ $item['upgrade_status'] == 'rejected' ? 'checked' : '' }}>
                                                    <label class="text-red-800">Reject</label>
                                                </div>
                                            </div> --}}
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="relative overflow-x-auto">
                                    <div class="itemDiv">
                                        <table class="full-width text-sm text-left rtl:text-right text-gray-500">
                                            <thead class="text-10 text-gray-700 uppercase table-header-bg">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-10 item_left width-60">
                                                        Item Name
                                                    </th>
                                                    @php
                                                    $showItemQty = 0;
                                                    $showItemTotal = 0;
                                                    if (isset($itemss[0]['group'])) {
                                                        $showItemQty = $itemss[0]['group']['show_quantity'] == 1 ? 1 : 0;
                                                        $showItemTotal = $itemss[0]['group']['show_total'] == 1 ? 1 : 0;
                                                    }
                                                    @endphp
                                                    @if($showItemQty == 1)
                                                    <th scope="col" class="text-right width-20">
                                                        Item Qty
                                                    </th>
                                                    @else
                                                        <th scope="col" class="text-right width-20"></th>
                                                    @endif
                                                    @if($showItemTotal == 1)
                                                    <th scope="col" class="text-right width-20">
                                                        Item Total
                                                    </th>
                                                    @else
                                                        <th scope="col" class="text-right width-20"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $groupTotal = 0;
                                                $incEstTotal = 0;
                                                @endphp
                                                @foreach ($itemss as $item)
                                                <tr class="bg-white border-b">
                                                    @php
                                                    $showQty = $item['group'] && $item['group']['show_quantity'] == 1;
                                                    $showTotal = $item['group'] && $item['group']['show_total'] == 1;
                                                    $colspan = (!$showQty && !$showTotal) ? 3 : 1;
                                                    @endphp

                                                    <td class="px-6 py-4 width-60" colspan="{{ $colspan }}">
                                                        <label class="text-12 font-semibold text-primary underline" for="">{{ $item['item_name'] }}</label>
                                                        <div class="text-primary pt-2">
                                                            @if ($item['item_description'])
                                                            <p class="font-medium text-10">Description:</p>
                                                            <p class="text-10">
                                                                {!!formatText($item['item_description'])!!}
                                                            </p>
                                                            @endif
                                                            @if ($item['item_note'])
                                                            <p class="font-medium text-10">Note:</p>
                                                            <p class="text-10">
                                                                {!!formatText($item['item_note'])!!}
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    @if($showQty)
                                                        <td class="text-right text-10 w-[20%]">
                                                            {{ number_format($item['item_qty'], 2) }} <br> {{ $item['item_unit'] }}
                                                        </td>
                                                    @else
                                                        <td class="w-[20%]"></td>
                                                    @endif

                                                    @if($showTotal)
                                                        <td class="text-right text-10 w-[20%]">
                                                            ${{ number_format($item['item_total'], 2) }}
                                                        </td>
                                                    @else
                                                        <td class="w-[20%]"></td>
                                                    @endif

                                                </tr>
                                                @php
                                                if(isset($item['group']['show_group_total']) && $item['group']['show_group_total'] == 1) {
                                                    $groupTotal += $item['item_total'];
                                                }
                                                if(isset($item['group']['include_est_total']) && $item['group']['include_est_total'] == 1) {
                                                    $incEstTotal = 1;
                                                    $subTotal += $item['item_total'];
                                                } else {
                                                    if($item['upgrade_status'] == 'accepted'){
                                                        $subTotal += $item['item_total'];
                                                    }
                                                }
                                                $acceptorreject = $item['upgrade_status'];
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td class="text-12">
                                                        @if($incEstTotal == 0 && $acceptorreject == 'rejected')
                                                        **Not include in Estimate Total**
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right py-3 text-12" colspan="7">
                                                        Group Total: {{ number_format($groupTotal, 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif

                        @foreach($templates as $template)
                        <div class="mb-2 bg-white">
                            <div class="p-1 bg-930027 text-white full-width rounded-t-lg">
                                <div class="inline-block">
                                    <div class="flex gap-3">
                                        <h1 class="font-medium text-10 align-center p-2">{{ $template->item_template_name }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto mb-8">
                                <div class="itemDiv">
                                    <table class="full-width text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-10 text-gray-700 uppercase table-header-bg">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-10 item_left">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-right text-10">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Price
                                                </th>
                                                <th scope="col" class="text-right">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $templateItems = $template->templateItems;
                                            @endphp
                                            @foreach ($templateItems as $item)
                                            @php
                                            $itemName = App\Models\Items::where('item_id', $item['item_id'])->first();
                                            @endphp
                                            <tr class="bg-white table-border-bottom">
                                                <td class="px-6 py-4">
                                                    <label class="text-12 font-semibold text-primary" for="">{{ $itemName->item_name }}</label>
                                                </td>
                                                <td class="text-right">
                                                    <label class="text-12 font-semibold text-primary" for="">{{ $item['item_description'] }}</label>
                                                </td>
                                                <td class="text-right">
                                                    <label class="text-12 font-semibold text-primary" for="">{{ $item['item_qty'] }}</label> <br> {{$itemName->item_units}}
                                                </td>
                                                <td class="text-right">
                                                    <label class="text-12 font-semibold text-primary" for=""> ${{ $item['item_price'] }}</label>
                                                </td>
                                                <td class="text-right">
                                                    <label class="text-12 font-semibold text-primary" for=""> ${{ $item['item_total'] }}</label>
                                                </td>
                                            </tr>
                                            @php
                                            $subTotal += $item['item_total'];
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @if(count($upgrades) > 0)
                        <div class="mb-2 bg-white">
                            <div class="p-1 bg-930027 text-white full-width rounded-t-lg">
                                <div class="inline-block">
                                    <div class="flex gap-3">
                                        <h1 class="font-medium text-10 align-center p-2">Upgrades</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto mb-8">
                                <div class="itemDiv">
                                    <table class="full-width text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-10 text-gray-700 uppercase table-header-bg">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="text-right">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-right">
                                                    Item Total
                                                </th>
                                                <th scope="col" class="text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($upgrades as $upgrade)
                                            <tr class="bg-white border-b">
                                                <td class="px-6 py-4">
                                                    <label class="text-12 font-semibold text-primary" for="">{{ $upgrade->item_name }}</label>
                                                    <div class="text-primary font">
                                                        @if ($upgrade->item_description)
                                                        <p class="font-medium text-10">Description:</p>
                                                        {!!formatText($upgrade->item_description)!!}
                                                        @endif
                                                        @if ($upgrade->item_note)
                                                        <p class="font-medium text-10">Note:</p>
                                                        {!!formatText($upgrade->item_note)!!}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    {{ $upgrade->item_qty }} <br> {{ $upgrade->item_unit }}
                                                </td>
                                                <td class="text-right">
                                                    ${{ $upgrade->item_total }}
                                                    <input type="hidden" id="upgrade_total" value="{{$upgrade->item_total}}">
                                                </td>
                                                <td>
                                                    @if(!session()->has('user_details'))
                                                    @if ($upgrade->upgrade_status != 'accepted')
                                                    <div class="text-right">
                                                        <input type="radio" name="upgrade_accept_reject" value="accepted" id="upgrade_accept"> Accept
                                                        <input type="radio" name="upgrade_accept_reject" value="rejected" id="upgrade_reject"> Reject
                                                    </div>
                                                    @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="">
                                                        <div id="accordion-collapse{{$upgrade->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                            <h2 id="accordion-collapse-heading-1" class="border-b">
                                                                <button type="button" class="flex items-center bg-gray-100 justify-between w-full p-2 text-left rounded-t-lg" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                                    <span>Assembly Details</span>
                                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="accordion-collapse-body{{$upgrade->estimate_item_id}}" class="accordion-collapse-body bg-gray-100" aria-labelledby="accordion-collapse-heading-1">
                                                                <div class="p-2">
                                                                    <table class="full-width text-sm text-left rtl:text-right text-gray-500">
                                                                        <thead class="text-10 text-gray-700 uppercase table-header-bg">
                                                                            <tr>
                                                                                <th scope="col" class="px-6 py-3"></th>
                                                                                <th scope="col" class="px-6 py-3">
                                                                                    Item Name
                                                                                </th>
                                                                                <th scope="col" class="px-6 py-3">
                                                                                    Item Description
                                                                                </th>
                                                                                <th scope="col" class="text-right">
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
                                                                                <td class="px-6 py-4">
                                                                                    {{$assembly->ass_item_description}}
                                                                                </td>
                                                                                <td class="text-right">
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
                            <td class="value-right">Tax: {{ number_format($estimate['tax_rate'], 2) }}%</td>
                        </tr>
                        <tr>
                            <td class="value-right">
                                Total: @php
                                $grandTotal = $subTotal + ($subTotal * $estimate['tax_rate']) / 100;
                                @endphp
                                <span id="dynamic-total" class="dynamic-total">${{ number_format($grandTotal, 2) }}</span>
                                <input type="hidden" id="dynamic_total_input" value="{{$subTotal + ($subTotal * $estimate['tax_rate']) / 100}}">
                            </td>
                        </tr>
                        @php
                        $estimateTotal = $subTotal;
                        $percentageDiscount = $estimate['percentage_discount'];
                        $priceDiscount = $estimate['price_discount'];

                        if ($percentageDiscount) {
                            $discountedTotal = $estimateTotal - ($estimateTotal * ($percentageDiscount / 100));
                        } elseif($priceDiscount) {
                            $discountedTotal = $estimateTotal - $priceDiscount;
                        } else {
                            $discountedTotal = null;
                        }
                        @endphp
                    </table>
                </div>

                <div class="grid-padding">
                    <div class="mt-5 term_condition">
                        @isset($terms_and_conditions)
                        {!! $terms_and_conditions !!}
                        @endisset
                    </div>
                </div>
{{--
                <input type="hidden" name="estimate_id" value="{{ $estimate['estimate_id'] }}">
                <input type="hidden" name="customer_email" value="{{ $customer['customer_email'] }}">
                <input type="hidden" name="estimate_total" value="{{ $subTotal + ($subTotal * $estimate['tax_rate']) / 100 }}">

                <div class="grid-padding flex justify-end my-10">
                    @if(!session()->has('user_details'))
                    @if($proposal_status == 'pending')
                    <button type="button" id="addSign" class="bg-930027 text-white text-12 px-10 py-2 rounded-md">I Agree!</button>
                    @else
                    <div>
                        <div>
                            @if($estimate['customer_signature'] != null)
                            <img src="{{$estimate['customer_signature']}}" alt="Customer Signature" style="max-width: 200px;">
                            @endif
                        </div>
                        <hr>
                        <div class="text-center">
                            <p class="text-930027">Proposal Accepted</p>
                        </div>
                    </div>
                    @endif
                    @endif
                    @if(session()->has('user_details'))
                    @if($estimate['estimate_total'] != null && $proposal_status != 'pending')
                    <div>
                        <div>
                            @if($estimate['customer_signature'] != null)
                            <img src="{{$estimate['customer_signature']}}" alt="Customer Signature" style="max-width: 200px;">
                            @endif
                        </div>
                        <hr>
                        <div class="text-center">
                            <p class="text-930027">Proposal Accepted</p>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addSign-modal">
            <!-- Modal content would go here -->
        </div>

        <input type="hidden" id="drawingData" name="customer_signature"> --}}
    </form>
{{--
    <div style="text-align: center; margin-top: 20px; font-weight: bold;">
        Grand Total: ${{ number_format($grandTotal, 2) }}
    </div> --}}
</body>
</html>
