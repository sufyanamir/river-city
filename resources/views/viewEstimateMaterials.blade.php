@include('layouts.header')

<div class="my-4">
    <div class="bg-white w-full rounded-2xl shadow-lg">
        <div class="flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class="text-xl font-semibold">
                <h4>Work Order</h4>
            </div>
            <div>
                <!-- <a href="javascript:void(0);" onclick="printPageArea('printableArea')">
                    <button class=" bg-white p-2 text-black rounded-md">
                        Print
                    </button>
                </a> -->
                <a href="javascript:void(0);" onclick="downloadAsPDF('printableArea')">
                    <button class="bg-white p-2 text-black rounded-md ml-2">Download as PDF</button>
                </a>
            </div>
        </div>

        @if(count($estimate_items) > 0 || count($assemblies) > 0 || count($upgrades) > 0 || count($templates) > 0)
        <div class="py-1" id="printableArea">
            <div class="col-span-10  pl-2 ">
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
                            <span class="pl-2">{{ $customer->customer_primary_address }}, {{ $customer->customer_city }}, {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}</span>
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
            <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                @if ($estimate_items->count() > 0)
                @foreach ($groupedItems as $groupName => $itemss)
                <div class="mb-2 bg-white shadow-xl">
                    <div class=" p-1 text-black w-full rounded-t-lg">
                        <div class="inline-block">
                            <div class="flex gap-3">
                                <h1 class=" font-medium my-auto p-2 underline">{{$groupName}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto mb-8">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemss as $item)
                                    <tr class="bg-white border-b">
                                        
                                        <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                            <label class="text-md font-semibold text-[#323C47] underline" for="">{{ $item->item_name }}</label>
                                            <p class="text-[16px]/[18px] text-[#323C47] mt-2">
                                                @if ($item->item_description)
                                            <p class="font-medium">Description:</p>
                                            <p>
                                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_description) !!}
                                            </p>
                                            @endif
                                            @if ($item->item_note)
                                            <p class="font-medium">Note:</p>
                                            <p>
                                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $item->item_note) !!}
                                            </p>
                                            @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($item->item_qty, 2) }} <br> {{ $item->item_unit }}
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
                                                                        <th scope="col" style="" class="px-6 py-3">
                                                                            Item Name
                                                                        </th>
                                                                        <th scope="col" class="text-center">
                                                                            Item Qty
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($item->assemblies as $assembly)
                                                                    <tr class="bg-white border-b">
                                                                        <td class="px-6 py-4" style="width: 85% !important; text-align:justify">
                                                                            <p>
                                                                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}
                                                                            </p>
                                                                            <br>
                                                                            <p>
                                                                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->ass_item_description) !!}
                                                                            </p>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <p>
                                                                                {{number_format($assembly->ass_item_qty, 2)}} <br> {{$assembly->ass_item_unit}}
                                                                            </p>
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
                                    @php
                                    $totalPrice += $item->item_total; // Add item price to total
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
            @php
            $totalPrice = 0; // Initialize total price variable

            $groupedItems = [];
            foreach ($estimateAdditionalItems as $groupItems) {
            $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
            $groupedItems[$groupName][] = $groupItems;
            }
            @endphp
            <div class=" py-7 px-4 shadow-md rounded-lg border">
                <h1 class=" font-bold">Addtitional Items</h1>
                <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                    @if ($estimateAdditionalItems->count() > 0)
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
                                                Item Name
                                            </th>
                                            <th scope="col" class="text-center">
                                                Item Qty
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($itemss as $item)
                                        <tr class="bg-white border-b">
                                            
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
                                                                            <th scope="col" style="" class="px-6 py-3">
                                                                                Item Name
                                                                            </th>
                                                                            <th scope="col" class="text-center">
                                                                                Item Qty
                                                                            </th>
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
                                        </tr>
                                        @php
                                        $totalPrice += $item->item_total; // Add item price to total
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
            @foreach($upgrades as $upgrade)
            <div class="mb-2 p-2 bg-white shadow-xl">
                <div class=" flex justify-between p-3 bg-[#930027] text-white w-full rounded-t-lg">
                    <h1 class=" font-medium my-auto">{{ $upgrade->item_name }} ({{ $upgrade->upgrade_status }})</h1>
                    <h1 class=" font-medium my-auto">QTY: {{ $upgrade->item_qty }}</h1>
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
                                        <label for="privilegeReportsView" class=" text-gray-500"></label>
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
        <div class="py-1 text-center  rounded-2xl">
            <div class="bg-[#F5F5F5] rounded-lg p-3 m-2">
                <h1>No Items Right Now!</h1>
            </div>
        </div>
        @endif

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function printPageArea(areaID) {
        var printContent = document.getElementById(areaID).innerHTML;
        var originalContent = document.body.innerHTML;

        // Create a style tag with the desired background color
        var style = document.createElement('style');
        style.innerHTML = 'body { background-color: white !important; }';

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
        // Get the printable area content
        var printContent = document.getElementById(areaID).innerHTML;

        // Create a temporary div to hold the content
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = printContent;

        // Define PDF options with original styling
        var opt = {
            margin: 0.5, // Original 0.5 inch margin
            filename: '{{ $customer->customer_first_name }}_{{$customer->customer_last_name}}-Work_Order.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 }, // Original scale of 2
            jsPDF: { unit: 'in', formayt: 'letter', orientation: 'portrait' }
        };

        // Apply minimal styles to hide unwanted elements (original approach)
        var style = document.createElement('style');
        style.innerHTML = `
            body { background-color: white !important; font-size: 10px !important; }
            div, p, span, table, td, tr, th {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
            }
            // .group-card { background-color: #930027 !important; } /* Maintain group header styling */
            * { word-wrap: break-word; font-size: 10px !important; }
            table { page-break-before: auto; page-break-after: auto; }
        `;
        tempDiv.appendChild(style);

        // Generate and download the PDF
        html2pdf().set(opt).from(tempDiv).save();
    }
</script>
@include('layouts.footer')