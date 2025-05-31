<!-- DataTables v2 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css">


@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class="flex items-center justify-end gap-4 my-4 pe-4 pt-4">
    <!-- Dropdown Toggle -->
    <div class="relative">
        <button id="selectformatDate" data-dropdown-toggle="selectformatDateDropDown"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:ring-2 focus:ring-blue-700"
            type="button">
            Select Filter
            <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="selectformatDateDropDown"
            class="absolute z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="selectformatDate">
                <li>
                    <a data-input-type="day"
                        class="block px-4 py-2 select-format hover:bg-gray-100 cursor-pointer">Day</a>
                </li>
                <li>
                    <a data-input-type="week"
                        class="block px-4 py-2 select-format hover:bg-gray-100 cursor-pointer">Week</a>
                </li>
                <li>
                    <a data-input-type="month"
                        class="block px-4 py-2 select-format hover:bg-gray-100 cursor-pointer">Month</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Input Fields -->
    <input type="date" id="day_input"
        class="hidden bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5">
    <input type="week" id="week_input"
        class="hidden bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5">
    <input type="month" id="month_input"
        class="hidden bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5">

    <!-- Optional Clear Button -->
    <button id="clear-filters"
        class="bg-gray-300 px-3 py-2 rounded text-sm font-medium hover:bg-gray-400 text-gray-800">Clear</button>
</div>




        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Customer Details</h4>
            </div>
            <div>


                {{-- <x-add-button :title="'+Add Customer'" :class="'addEstimate'" :id="'addCustomer'"></x-add-button> --}}
            </div>
        </div>
        <div class="py-4 overflow-x-auto bg-white">

                <table id="universalTable" class="display" style="width:100%" >
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Crated</th>
                            <th>Source</th>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Owner</th>
                            <th>Currently</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($customers as $customer)
                            @foreach ($customer->estimates as $estimate)
                                <tr>
                                    <td>{{ $estimate->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $customer->source }}</td>
                                    <td>{{ $estimate->customer_name }}</td>
                                    <td>{{ $estimate->project_name }}</td>
                                    <td>{{ $estimate->project_owner }}</td>
                                    <td>{{ $estimate->estimate_status }}</td>
                                    <td>{{ $estimate->estimate_total }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
        </div>


@include('layouts.footer')

<!-- DataTables v2 JS + Dependencies -->
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        $('#universalTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });

    $.fn.DataTable.ext.errMode = 'none';
    new DataTable('#universalTable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});
</script>

<script>
$(document).ready(function () {
    // Initialize DataTable
    var table = $('#universalTable').DataTable();

    // Toggle visible input on dropdown click
    $(".select-format").click(function () {
        const inputType = $(this).data("input-type");
        $("#day_input, #week_input, #month_input").addClass("hidden").val("");

        if (inputType === "day") {
            $("#day_input").removeClass("hidden");
        } else if (inputType === "week") {
            $("#week_input").removeClass("hidden");
        } else if (inputType === "month") {
            $("#month_input").removeClass("hidden");
        }

        table.draw();
    });

    // Trigger filter on input change
    $("#day_input, #week_input, #month_input").on("change", function () {
        table.draw();
    });

    // Clear filters on button click (optional)
    $("#clear-filters").on("click", function () {
        $("#day_input, #week_input, #month_input").val('').addClass("hidden");
        table.draw();
    });

    // Custom DataTable search for date filters
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        const inputType = $(".select-format").filter(function () {
            return !$("#" + $(this).data("input-type") + "_input").hasClass("hidden");
        }).data("input-type");

        const rowDateStr = data[0]; // assuming date is in column 0
        const rowDate = new Date(rowDateStr.split('/').reverse().join('-'));

        if (inputType === "day") {
            const day = $("#day_input").val();
            return rowDate.toISOString().slice(0, 10) === day;
        } else if (inputType === "week") {
            const week = $("#week_input").val();
            return getISOWeek(rowDate) === week;
        } else if (inputType === "month") {
            const month = $("#month_input").val();
            return rowDate.toISOString().slice(0, 7) === month;
        }

        return true;
    });

    // Helper: Get ISO week in YYYY-W## format
    function getISOWeek(date) {
        const d = new Date(date);
        d.setHours(0, 0, 0, 0);
        d.setDate(d.getDate() + 4 - (d.getDay() || 7));
        const yearStart = new Date(d.getFullYear(), 0, 1);
        const weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
        return d.getFullYear() + '-W' + (weekNo < 10 ? '0' + weekNo : weekNo);
    }
});
</script>

