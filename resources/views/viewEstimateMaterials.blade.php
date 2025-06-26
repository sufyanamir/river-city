@include('layouts.header')
<style>
/* Core styling rules */
* {
    margin: 0;
    padding: 0;
    line-height: 1.4;
    font-size: 12px;
    box-sizing: border-box;
}

body, html {
    width: 100%;
    height: auto;
    background-color: white;
}

/* Optimize page content density */
p, div, span {
    margin-bottom: 0.1rem; /* Reduce vertical spacing */
}

/* Page break control - better table handling */
table {
    width: 100%;
    border-collapse: collapse;
    page-break-inside: auto;
}

tr {
    page-break-inside: avoid;
    page-break-after: auto;
}

td, th {
    page-break-inside: avoid;
    padding: 4px 6px !important; /* Reduce cell padding */
}

thead {
    display: table-header-group;
}

tfoot {
    display: table-footer-group;
}

/* Improved group section handling */
.group-section {
    page-break-inside: avoid;
    margin-bottom: 0.5rem !important; /* Reduce spacing between sections */
}

/* Only force page breaks when absolutely necessary */
.page-break-header {
    /* Remove the forced page break */
    /* page-break-before: always; */
    margin-top: 10px !important; /* Reduced from 20px */
}

/* Prevent headings from being alone at the bottom of a page */
h1, h2, h3, h4, h5 {
    page-break-after: avoid;
    margin-bottom: 0.2rem !important; /* Reduce heading margins */
}

/* Group headers and content should stay together when possible */
.group-header {
    page-break-after: avoid;
    padding: 0.5rem !important; /* Reduce header padding */
}

.group-content {
    page-break-before: avoid;
}

/* More compact customer info */
.customer-info {
    page-break-inside: avoid;
    padding: 0.5rem !important; /* Reduce padding */
}

/* Fix accordion items to prevent breaking */
.accordion-collapse {
    page-break-inside: avoid;
}

/* For items with descriptions, try to keep them together but allow breaks if needed */
.item-with-description {
    page-break-inside: auto; /* Changed from avoid to allow breaking if needed */
}

/* Reduce spacing in Additional Items section */
.py-7 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

/* Reduce margins in item tables */
.itemDiv {
    margin: 0.5rem !important;
}

/* Optimize print settings */
@media print {
    /* Reduce margins for printing */
    @page {
        margin: 0.3in;
    }

    /* Ensure clean page breaks only when necessary */
    .page-break {
        page-break-before: always;
    }

    /* Hide print/download buttons during printing */
    .no-print, .no-print * {
        display: none !important;
    }

    /* Force background colors to print */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* Reduce spacing between elements */
    .mb-2 {
        margin-bottom: 0.25rem !important;
    }

    .mb-8 {
        margin-bottom: 0.5rem !important;
    }

    /* Make text slightly smaller in print */
    body {
        font-size: 11px;
    }
}
</style>

<div class="my-4">
    <div class="bg-white w-full rounded-2xl shadow-lg">
        <div class="flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl no-print">
            <div class="text-xl font-semibold">
                <h4>Work Order</h4>
            </div>
            <div>
                <a href="javascript:void(0);" onclick="downloadAsPDF('printableArea')">
                    <button class="bg-white p-2 text-black rounded-md ml-2">Download as PDF</button>
                </a>
            </div>
        </div>

        @if(count($estimate_items) > 0 || count($assemblies) > 0 || count($upgrades) > 0 || count($templates) > 0)
        <div class="py-1" id="printableArea">
            <!-- Customer Info Section - Keep Together -->
            <div class="customer-info">
                <div class="grid sm:grid-cols-10">
                    <div class="col-span-8 p-3">
                        <p class="text-[#F5222D] text-xl font-bold">
                            {{ ucfirst($customer->customer_first_name) }} {{ ucfirst($customer->customer_last_name) }}
                        </p>
                        <p class="text-[#323C47] text-lg font-semibold">
                            {{ $customer->customer_project_name }}
                        </p>
                        <p class="my-2 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $estimate->customer_address }}</span>
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
                    </div>
                    <div class="col-span-2 p-3 text-right">
                        <p class="text-lg font-bold text-[#323C47]">
                            Work Order
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
                            {{ date('m/d/y', strtotime($estimate->created_at)) }}
                        </p>
                    </div>
                </div>
            </div>

            @php
            $totalPrice = 0; // Initialize total price variable

            $groupedItems = [];
            foreach ($estimate_items as $groupItems) {
                $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
                $groupedItems[$groupName][] = $groupItems;
            }
            @endphp

            <!-- Main Items Section -->
            <div class="itemDiv col-span-10 ml-2 overflow-auto rounded-lg border-[#0000004D] m-3">
                @if ($estimate_items->count() > 0)
                    @foreach ($groupedItems as $groupName => $itemss)
                    <div class="mb-2 bg-white  group-section">
                        <!-- Group Header - Keep with content if possible -->
                        <div class="p-1 text-black w-full rounded-t-lg group-header">
                            <div class="inline-block">
                                <div class="flex gap-3">
                                    <h1 class="font-medium my-auto p-2 underline">{{$groupName}}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto mb-8 group-content">
                            <div class="itemDiv">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase border-b border-gray-500 bg-gray-50 repeating-header">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Item Name</th>
                                            <th scope="col" class="text-center">Item Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($itemss as $item)
                                        <tr class="bg-white border-b item-with-description">
                                            <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                <label class="text-md font-semibold text-[#323C47] underline" for="">{{ $item->item_name }}</label>
                                                <p class="text-[16px]/[18px] text-[#323C47] mt-2">
                                                    @if ($item->item_description)
                                                    <p class="font-medium">Description:</p>
                                                    <p>{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}</p>
                                                    @endif

                                                    @if ($item->item_note)
                                                    <p class="font-medium">Note:</p>
                                                    <p>{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}</p>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($item->item_qty, 2) }} <br> {{ $item->item_unit }}
                                            </td>
                                        </tr>

                                        @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                        <tr>
                                            <td colspan="7">
                                                <div class="">
                                                    <div id="" class=" mb-2">
                                                        <div>
                                                            <div class="p-2">
                                                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                                    <thead class="text-xs text-gray-700 uppercase border-b border-gray-500 bg-gray-50 repeating-header">
                                                                        <tr>
                                                                            <th scope="col" class="px-6 py-3">Item Name</th>
                                                                            <th scope="col" class="text-center">Item Qty</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($item->assemblies as $assembly)
                                                                        <tr class="bg-white border-b">
                                                                            <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                                                <p>{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}</p>
                                                                                <br>
                                                                                <p>{!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->ass_item_description) !!}</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p>{{number_format($assembly->ass_item_qty, 2)}} <br> {{$assembly->ass_item_unit}}</p>
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

            <!-- Additional Items Section -->
            @php
            $totalPrice = 0; // Initialize total price variable

            $groupedItems = [];
            foreach ($estimateAdditionalItems as $groupItems) {
                $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
                $groupedItems[$groupName][] = $groupItems;
            }
            @endphp

            <div class="py-7 px-4 shadow-md rounded-lg border page-break-header">
                <h1 class="font-bold">Additional Items</h1>
                <div class="itemDiv col-span-10 ml-2 overflow-auto rounded-lg border-[#0000004D] m-3">
                    @if ($estimateAdditionalItems->count() > 0)
                        @foreach ($groupedItems as $groupName => $itemss)
                        <div class="mb-2 bg-white shadow-xl group-section">
                            <!-- Group Header - Keep with content if possible -->
                            <div class="p-1 bg-[#930027] text-white w-full rounded-t-lg group-header">
                                <div class="inline-block">
                                    <div class="flex gap-3">
                                        <h1 class="font-medium my-auto p-2">{{$groupName}}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="relative overflow-x-auto mb-8 group-content">
                                <div class="itemDiv">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 repeating-header">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">Item Name</th>
                                                <th scope="col" class="text-center">Item Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($itemss as $item)
                                            <tr class="bg-white border-b item-with-description">
                                                <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                    <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item->item_name }}</label>
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                        <p class="font-medium">Description:</p>
                                                        {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}
                                                        @endif
                                                        @if ($item->item_note)
                                                        <p class="font-medium">Note:</p>
                                                        {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->item_qty, 2) }} <br> {{ $item->item_unit }}
                                                </td>
                                            </tr>

                                            @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                            <tr>
                                                <td colspan="7">
                                                    <div class="accordion-collapse-wrapper">
                                                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2 text-left rounded-t-lg focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                                    <span></span>
                                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5]" aria-labelledby="accordion-collapse-heading-1">
                                                                <div class="p-2">
                                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 repeating-header">
                                                                            <tr>
                                                                                <th scope="col" class="px-6 py-3">Item Name</th>
                                                                                <th scope="col" class="text-center">Item Qty</th>
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
                                                                                <td class="text-center">
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
            <div class="mb-2 p-2 bg-white shadow-xl group-section page-break-header">
                <div class="flex justify-between p-3 bg-[#930027] text-white w-full rounded-t-lg group-header">
                    <h1 class="font-medium my-auto">{{ $template->item_template_name }}</h1>
                </div>
                <div class="relative overflow-x-auto group-content">
                    <div class="itemDiv">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 repeating-header">
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
            <div class="mb-2 p-2 bg-white shadow-xl group-section page-break-header">
                <div class="flex justify-between p-3 bg-[#930027] text-white w-full rounded-t-lg group-header">
                    <h1 class="font-medium my-auto">{{ $upgrade->item_name }} ({{ $upgrade->upgrade_status }})</h1>
                    <h1 class="font-medium my-auto">QTY: {{ $upgrade->item_qty }}</h1>
                </div>
                <div class="relative overflow-x-auto group-content">
                    <div class="itemDiv">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 repeating-header">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Check</th>
                                    <th scope="col" class="px-6 py-3">Item Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $assemblies = $upgrade->assemblies; // Fetch related EstimateItemAssembly items
                                @endphp
                                @foreach ($assemblies as $assembly)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">
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
        </div>
        <hr>
        @else
        <div class="py-1 text-center rounded-2xl">
            <div class="bg-[#F5F5F5] rounded-lg p-3 m-2">
                <h1>No Items Right Now!</h1>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function downloadAsPDF(areaID) {
        var element = document.getElementById(areaID);

        var opt = {
            margin: [0.5, 0.5, 0.7, 0.5], // [top, right, bottom, left] - extra bottom margin for page numbers
            filename: 'Estimate_{{ $estimate->customer_name }}_{{$estimate->customer_last_name}}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, logging: true },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        };

        var style = document.createElement('style');
        style.innerHTML = `
            #send-button, #footer, #editor, #editor-div {
                display: none !important;
            }
            .table-continued-note {
                display: block;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        `;
        document.head.appendChild(style);

        html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
            pdf.setProperties({
                title: 'Estimate_{{ $estimate->customer_name }}_{{$estimate->customer_last_name}}',
                author: 'System Generated'
            });

            // Add page numbers
            var totalPages = pdf.internal.getNumberOfPages();
            for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);
                pdf.setFontSize(10);
                pdf.setTextColor(100);
                // Center the page number at the bottom
                var pageWidth = pdf.internal.pageSize.getWidth();
                var text = 'Page ' + i + ' of ' + totalPages;
                var textWidth = pdf.getTextWidth(text);
                pdf.text(text, (pageWidth - textWidth) / 2, pdf.internal.pageSize.getHeight() - 0.3);
            }
        }).save().finally(function() {
            document.head.removeChild(style); // Clean up the style element
        });
    }
</script>

@include('layouts.footer')
