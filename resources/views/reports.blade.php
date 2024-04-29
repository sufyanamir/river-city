@include('layouts.header')
<div class=" my-4 rounded-lg shadow-lg">
    <h1 class="  text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Reports</h1>
    <div class=" bg-white w-full ">
        <div class="p-3">
            <div class="text-right mb-3">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <span>Summary</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-right">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button id="selectformatDate" data-dropdown-toggle="selectformatDateDropDown" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700" type="button">Month <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="selectformatDateDropDown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-center text-gray-700 dark:text-gray-200" aria-labelledby="selectformatDate">
                            <li>
                                <a href="#" data-input-type="day" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Day</a>
                            </li>
                            <li>
                                <a href="#" data-input-type="week" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Week</a>
                            </li>
                            <li>
                                <a href="#" data-input-type="month" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Month</a>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <input type="date" id="day_input" value="{{$date}}" class="hidden bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                        <input type="week" id="week_input" value="{{$date}}" class="hidden bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                        <input type="month" id="month_input" value="{{$date}}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <svg data-accordion-icon class="w-2 h-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5 5 9" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <svg data-accordion-icon class="w-2 h-2 rotate-90 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class=" my-3">
                <div class="inline-flex rounded-md shadow-sm w-full" role="group">
                    <input type="text" id="confirm_password" class="bg-gray-50 border border-gray-300  text-sm rounded-l-lg outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M4 18h16v2H4zm1-4h7v2H5zm0-4h11v2H5zm0-4h11v2H5zm1-4h9v2H6z" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-3 gab-4">
                <div class="card px-3 mt-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Sales By Source</h3>
                    </div>
                    <div class=" relative overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Source</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class=" w-full text-sm">
                                @php
                                $source_customer_total = 0;
                                $source_estimate_total = 0;
                                @endphp

                                <tbody class="">
                                    @foreach($sources as $source => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$source}}</td>
                                        <td class=" text-center">{{$data['total_customers']}}</td>
                                        <td class=" text-right pr-1 py-2">${{$data['estimate_total']}}</td>
                                    </tr>
                                    @php
                                    $source_customer_total += $data['total_customers'];
                                    $source_estimate_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$source_customer_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{$source_estimate_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Completed Estimates</h3>
                    </div>
                    <div class=" relative overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Estimator</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class=" w-full text-sm">
                                @php
                                $completed_estimates_total = 0;
                                $completed_estimate_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($completed_estimators as $estimators => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class=" text-center">{{$data['total_estimates']}}</td>
                                        <td class=" text-right pr-1 py-2">${{$data['estimate_total']}}</td>
                                    </tr>
                                    @php
                                    $completed_estimates_total += $data['total_estimates'];
                                    $completed_estimate_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$completed_estimates_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{$completed_estimate_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Pending Estimates</h3>
                    </div>
                    <div class=" relative overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Estimator</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class=" w-full text-sm">
                                @php
                                $pending_estimates_total = 0;
                                $pending_estimate_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($pending_estimators as $estimators => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class=" text-center">{{$data['total_estimates']}}</td>
                                        <td class=" text-right pr-1 py-2">${{$data['estimate_total']}}</td>
                                    </tr>
                                    @php
                                    $pending_estimates_total += $data['total_estimates'];
                                    $pending_estimate_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$pending_estimates_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{$pending_estimate_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3">
                    <div class="rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Completed Work Orders</h3>
                    </div>
                    <div class="relative overflow-auto border rounded-b-lg">
                        <table class="w-full text-sm">
                            <thead class="border-b-2">
                                <tr>
                                    <th class="text-left pl-1 py-2">Supervisor</th>
                                    <th>#</th>
                                    <th class="text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class="w-full text-sm">
                                @php
                                $completed_work_orders_total = 0;
                                $completed_work_order_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($completed_work_orders as $estimators => $data)
                                    <tr class="border-b">
                                        <td class="text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class="text-center">{{$data['total_work_orders']}}</td>
                                        <td class="text-right pr-1 py-2">${{$data['work_order_total']}}</td>
                                    </tr>
                                    @php
                                    $completed_work_orders_total += $data['total_work_orders'];
                                    $completed_work_order_total += $data['work_order_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class="w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class="text-left pl-1 py-2"> Grand Total</th>
                                    <td class="text-center">{{$completed_work_orders_total}}</td>
                                    <td class="text-right pr-1 py-2">${{$completed_work_order_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Accepted Estimates</h3>
                    </div>
                    <div class=" relative overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Estimator</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class=" w-full text-sm">
                                @php
                                $accepted_estimates_total = 0;
                                $accepted_estimate_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($accepted_estimates as $estimators => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class=" text-center">{{$data['total_estimates']}}</td>
                                        <td class=" text-right pr-1 py-2">${{$data['estimate_total']}}</td>
                                    </tr>
                                    @php
                                    $accepted_estimates_total += $data['total_estimates'];
                                    $accepted_estimate_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$pending_estimates_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{$pending_estimate_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100">
                        <h3>Sales By Estimates</h3>
                    </div>
                    <div class=" relative overflow-auto border rounded-b-lg">
                        <table class=" w-full text-sm">
                            <thead class=" border-b-2">
                                <tr>
                                    <th class=" text-left pl-1 py-2">Estimator</th>
                                    <th>#</th>
                                    <th class=" text-right pr-1 py-2">Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height: 100px !important; overflow-y:scroll !important;">
                            <table class=" w-full text-sm">
                                @php
                                $sales_by_estimator_total = 0;
                                $sales_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($sales_by_estimator as $estimators => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class=" text-center">{{$data['total_estimates']}}</td>
                                        <td class=" text-right pr-1 py-2">${{$data['estimate_total']}}</td>
                                    </tr>
                                    @php
                                    $sales_by_estimator_total += $data['total_estimates'];
                                    $sales_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$pending_estimates_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{$pending_estimate_total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        // Function to show the selected input and hide others
        $(".select-format").click(function() {
            // Get the data-input-type attribute value of the clicked item
            var inputType = $(this).data("input-type");

            // Hide all input elements
            $("input[type='date'], input[type='week'], input[type='month']").addClass("hidden");

            // Show the input element corresponding to the selected type
            $("#" + inputType + "_input").removeClass("hidden");

            // Trigger change event when switching input types
            // $("#" + inputType + "_input").change();
        });

        // Trigger change event for the default input
        $("#month_input").change();

        $("input[type='date'], input[type='week'], input[type='month']").change(function() {
            var inputType = $(this).attr("id").split("_")[0];
            var baseUrl = "/reports/";
            var selectedDate = $("#" + inputType + "_input").val();
            var url = baseUrl + inputType + "/" + selectedDate;
            window.location.href = url;
        });

    });
</script>
<script>
  $(document).ready(function() {
    // Get the current date
    var currentDate = new Date();

    // Get the year and month in the format YYYY-MM
    var currentYearMonth = currentDate.toISOString().slice(0, 7);

    // Set the value of the month_input to the current year and month
    $("#month_input").val(currentYearMonth);

    // Set the value of the day_input to the current date in YYYY-MM-DD format
    var currentDay = currentDate.toISOString().slice(0, 10);
    $("#day_input").val(currentDay);

    // Set the value of the week_input to the current week in YYYY-Www format
    var currentWeek = getISOWeek(currentDate);
    var currentYear = currentDate.getFullYear();
    $("#week_input").val(currentYear + '-W' + currentWeek);

    // Get the value of the 'date' parameter from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var dateParam = urlParams.get('date');

    // Determine which input field to update based on the 'date' parameter
    if (dateParam) {
        var formattedDate = formatDate(dateParam);
        if (dateParam.length === 7) {
            $("#month_input").val(dateParam);
        } else if (dateParam.length === 10) {
            $("#day_input").val(dateParam);
        } else if (dateParam.length >= 8 && dateParam.includes('-W')) {
            $("#week_input").val(dateParam);
        }
    }
});

// Function to format the date
function formatDate(date) {
    return date.split('-').join('/');
}

    // Function to get the ISO week of the given date
    function getISOWeek(date) {
        var d = new Date(date);
        d.setHours(0, 0, 0, 0);
        d.setDate(d.getDate() + 4 - (d.getDay() || 7));
        var yearStart = new Date(d.getFullYear(), 0, 1);
        var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
        return weekNo;
    }
</script>