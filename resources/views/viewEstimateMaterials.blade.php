@include('layouts.header')

<div class="my-4">
    <div class="bg-white w-full rounded-2xl shadow-lg">
        <div class="flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class="text-xl font-semibold">
                <h4>Work Order</h4>
            </div>
            <a href="javascript:void(0);" onclick="printPageArea('printableArea')">
                <button class=" bg-white p-2 text-black rounded-md">
                    Print
                </button>
            </a>
        </div>

        @if(count($items) > 0)
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
                            {{ $estimate->created_at }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto  rounded-2xl">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Check</th>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Quantity
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                <input type="checkbox" disabled name="privileges[reports][view]" id="privilegeReportsView">
                                <label for="privilegeReportsView" class=" text-gray-500"></label>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->item_name}}
                            </th>
                            <td class="px-6 py-4">
                                @if($item->item_qty == null)
                                <p>This product does not have quantity. Please add the quantity of the product.</p>
                                @else
                                {{$item->item_qty}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                                        <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item['item_qty'] }}</label>
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
</script>
@include('layouts.footer')