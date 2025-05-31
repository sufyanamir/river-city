@include('layouts.header')
<div class=" my-4 rounded-lg shadow-lg">
    <h1 class="  text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Reports</h1>
    <div class=" bg-white w-full ">
        <div class="p-3">
            <div class="text-right mb-3">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    {{-- <button type="button" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <span>Summary</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button> --}}
                    {{-- <button type="button" onclick="downloadAsPDF('printableArea')" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
                        <svg data-accordion-icon class="w-2 h-2 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button> --}}
                </div>
            </div>
            <form action="/reports" method="post">
                <div class="text-right">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button id="selectformatDate" data-dropdown-toggle="selectformatDateDropDown" class=" inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700" type="button">
                            @if($range == 'day')
                            Day
                            @elseif($range == 'week')
                            Week
                            @else
                            Month
                            @endif
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="selectformatDateDropDown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-center text-gray-700 dark:text-gray-200" aria-labelledby="selectformatDate">
                                <li>
                                    <a data-input-type="day" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Day</a>
                                </li>
                                <li>
                                    <a data-input-type="week" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Week</a>
                                </li>
                                <li>
                                    <a data-input-type="month" class="block px-4 py-2 select-format hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Month</a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            <input type="date" id="day_input" value="{{$date}}" class=" {{ $range == 'day' ? '' : 'hidden' }} bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                            <input type="week" id="week_input" value="{{$date}}" class="{{ $range == 'week' ? '' : 'hidden' }} bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                            <input type="month" id="month_input" value="{{$date}}" class=" {{ $range == 'month' ? '' : 'hidden' }} bg-gray-50 border border-gray-300 text-sm rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 w-full">
                        </button>
                        <button type="button" id="prev-btn" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            <svg data-accordion-icon class="w-2 h-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5 5 9" />
                            </svg>
                        </button>
                        <button type="button" id="next-btn" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            <svg data-accordion-icon class="w-2 h-2 rotate-90 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class=" my-3">
                    <div class="inline-flex rounded-md shadow-sm w-full" role="group">
                        <input type="text" id="search_input" class="bg-gray-50 border border-gray-300  text-sm rounded-l-lg outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" value="{{$keyword}}" required>
                        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M4 18h16v2H4zm1-4h7v2H5zm0-4h11v2H5zm0-4h11v2H5zm1-4h9v2H6z" />
                            </svg>
                        </button>
                        <button type="button" id="search-btn" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-1 focus:ring-blue-500 focus:text-blue-700 ">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gab-4">
                <div class="card px-3 mt-3" id="SalesBySource">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Sales By Source</h3>
                        <button type="button" onclick="downloadAsPDF('SalesBySource')" id="hideBtnSS" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>

                    </button>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleSS">
                            <table class=" w-full text-sm" >
                                @php
                                $source_customer_total = 0;
                                $source_estimate_total = 0;
                                @endphp

                                <tbody class="">
                                    @foreach($sources as $source => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$source}}</td>
                                        <td class=" text-center">{{$data['total_customers']}}</td>
                                       <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['source', $source]) }}">${{ number_format($data['estimate_total'], 2, '.', ',') }}</a></td>
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
                                    <td class=" text-right pr-1 py-2">${{number_format($source_estimate_total,1,'')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="CompletedEstimates">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Completed Estimates</h3>
                        <button type="button" onclick="downloadAsPDF('CompletedEstimates')" id="hideBtnCE" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleCE">
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
                                        <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['completedEstimate', $estimators]) }}">${{number_format($data['estimate_total'],2,'.',',')}}</a></td>
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
                                    <td class=" text-right pr-1 py-2">${{number_format($completed_estimate_total,1,'.',',')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="PendingEstimates">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Pending Estimates</h3>
                        <button type="button" onclick="downloadAsPDF('PendingEstimates')" id="hideBtnPE" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStylePE">
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
                                        <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['pandingEstimate', $estimators]) }}">${{number_format($data['estimate_total'],2,'.',',')}}</a></td>
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
                                    <td class=" text-right pr-1 py-2">${{number_format($pending_estimate_total,1,'.',',')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="CompletedWorkOrders">
                    <div class="rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Completed Work Orders</h3>
                        <button type="button" onclick="downloadAsPDF('CompletedWorkOrders')" id="hideBtnCO" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleCO">
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
                                        <td class="text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['completedWorkOrders', $estimators]) }}">${{number_format($data['work_order_total'],2,'.',',')}}</a></td>
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
                                    <td class="text-right pr-1 py-2">${{number_format($completed_work_order_total,1,'.',',')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="AcceptedEstimates">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Accepted Estimates</h3>
                        <button type="button" onclick="downloadAsPDF('AcceptedEstimates')" id="hideBtnAE" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleAE">
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
                                        <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['acceptedEstimate', $estimators]) }}">${{number_format($data['estimate_total'],2,'.',',')}}</a></td>
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
                                    <td class=" text-center">{{$accepted_estimates_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{number_format($accepted_estimate_total,1,'.',',')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="SalesByEstimates">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>Sales By Estimates</h3>
                        <button type="button" onclick="downloadAsPDF('SalesByEstimates')" id="hideBtnSE" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleSE">
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
                                        <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['salesByEstimate', $estimators]) }}">${{number_format($data['estimate_total'],2,'.',',')}}</a></td>
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
                                    <td class=" text-center">{{$sales_by_estimator_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{number_format($sales_total,1,'.',',')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card px-3 mt-3" id="NewEstimatesbyOwner">
                    <div class=" rounded-t-lg p-2 card-header border bg-gray-100 flex justify-between">
                        <h3>New Estimates by Owner</h3>
                        <button type="button" onclick="downloadAsPDF('NewEstimatesbyOwner')" id="hideBtnNO" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-[4px] hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                        <span>Download</span>
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
                        <div style="height: 100px !important; overflow-y:scroll !important;" id="hideStyleNO">
                            <table class=" w-full text-sm">
                                @php
                                $new_estimate_by_owner_total = 0;
                                $owner_total = 0;
                                @endphp
                                <tbody class="">
                                    @foreach($new_estimates_by_owner as $estimators => $data)
                                    <tr class=" border-b">
                                        <td class=" text-left pl-1 py-2">{{$estimators}}</td>
                                        <td class=" text-center">{{$data['total_estimates']}}</td>
                                        <td class=" text-right pr-1 py-2 text-[#930027] hover:underline"><a href="{{ route('report-details', ['newEstimateByOwner', $estimators]) }}">${{number_format($data['estimate_total'],2,'.',',')}}</a></td>
                                    </tr>
                                    @php
                                    $new_estimate_by_owner_total += $data['total_estimates'];
                                    $owner_total += $data['estimate_total'];
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class=" w-full text-sm">
                            <tfoot>
                                <tr>
                                    <th class=" text-left pl-1 py-2"> Grand Total</th>
                                    <td class=" text-center">{{$new_estimate_by_owner_total}}</td>
                                    <td class=" text-right pr-1 py-2">${{number_format($owner_total,1,'.',',')}}</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        // Handle format switch (day/week/month)
        $(".select-format").click(function () {
            var inputType = $(this).data("input-type");

            $("input[type='date'], input[type='week'], input[type='month']").addClass("hidden");
            $("#" + inputType + "_input").removeClass("hidden");
        });

        // Trigger change for default
        $("#month_input").change();

        // Handle change for all inputs
        $("input[type='date'], input[type='week'], input[type='month']").change(function () {
            var inputType = $(this).attr("id").split("_")[0];
            var selectedDate = $(this).val();

            if (selectedDate) {
                var url = "/reports/" + inputType + "/" + selectedDate;
                console.log("Redirecting to:", url);
                window.location.href = url;
            }
        });

        // Previous/Next buttons
        $("#prev-btn, #next-btn").click(function () {
            var activeInput = $("input[type='date']:not(.hidden), input[type='week']:not(.hidden), input[type='month']:not(.hidden)");
            var inputType = activeInput.attr("id").split("_")[0];
            var currentValue = activeInput.val();
            var currentDate;

            // Parse current value to Date
            if (inputType === "week" && currentValue) {
                var parts = currentValue.split("-W");
                var year = parseInt(parts[0]);
                var week = parseInt(parts[1]);
                currentDate = new Date(year, 0, 1 + (week - 1) * 7);
            } else if (currentValue) {
                currentDate = new Date(currentValue);
            } else {
                currentDate = new Date();
            }

            // Adjust date
            if ($(this).attr("id") === "prev-btn") {
                if (inputType === "month") currentDate.setMonth(currentDate.getMonth() - 1);
                else if (inputType === "day") currentDate.setDate(currentDate.getDate() - 1);
                else if (inputType === "week") currentDate.setDate(currentDate.getDate() - 7);
            } else {
                if (inputType === "month") currentDate.setMonth(currentDate.getMonth() + 1);
                else if (inputType === "day") currentDate.setDate(currentDate.getDate() + 1);
                else if (inputType === "week") currentDate.setDate(currentDate.getDate() + 7);
            }

            // Format and apply
            var newVal = formatDate(currentDate, inputType);
            activeInput.val(newVal).trigger('change');
        });

        // Search button
        $("#search-btn").click(function () {
            var keyword = $("#search_input").val();
            var range = $("input[type='month']:not(.hidden)").val();
            var date = $("input[type='date']:not(.hidden)").val();
            var week = $("input[type='week']:not(.hidden)").val();

            var baseUrl = "/reports/";
            var url;

            if (range) url = baseUrl + "month/" + range + "/";
            else if (date) url = baseUrl + "day/" + date + "/";
            else if (week) url = baseUrl + "week/" + getISOWeek(new Date(week)) + "/";
            else url = baseUrl;

            url += keyword;
            window.location.href = url;
        });

        // Helpers
        function formatDate(date, type) {
            if (type === "month") {
                return date.toISOString().slice(0, 7);
            } else if (type === "day") {
                return date.toISOString().slice(0, 10);
            } else if (type === "week") {
                return getISOWeek(date);
            }
        }

        function getISOWeek(date) {
            var d = new Date(date);
            d.setHours(0, 0, 0, 0);
            d.setDate(d.getDate() + 4 - (d.getDay() || 7));
            var yearStart = new Date(d.getFullYear(), 0, 1);
            var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
            return d.getFullYear() + '-W' + (weekNo < 10 ? '0' + weekNo : weekNo);
        }
    });


 function downloadAsPDF(areaID) {
    var element = document.getElementById(areaID);

    // Only continue if the element with this ID exists
    if (!element) {
        alert("Invalid section selected for download.");
        return;
    }

    // Dynamically get the related button and scrollable div
    let hideBtn, scrollDiv;

    if (areaID === 'SalesBySource') {
        hideBtn = document.getElementById('hideBtnSS');
        scrollDiv = document.getElementById('hideStyleSS');
    } else if (areaID === 'CompletedEstimates') {
        hideBtn = document.getElementById('hideBtnCE');
        scrollDiv = document.getElementById('hideStyleCE');
    } else if (areaID === 'PendingEstimates') {
        hideBtn = document.getElementById('hideBtnPE');
        scrollDiv = document.getElementById('hideStylePE');
    } else if (areaID === 'CompletedWorkOrders') {
        hideBtn = document.getElementById('hideBtnCO');
        scrollDiv = document.getElementById('hideStyleCO');
    } else if (areaID === 'AcceptedEstimates') {
        hideBtn = document.getElementById('hideBtnAE');
        scrollDiv = document.getElementById('hideStyleAE');
    }else if (areaID === 'SalesByEstimates') {
        hideBtn = document.getElementById('hideBtnSE');
        scrollDiv = document.getElementById('hideStyleSE');
    } else if (areaID === 'NewEstimatesbyOwner') {
        hideBtn = document.getElementById('hideBtnAENO');
        scrollDiv = document.getElementById('hideStyleNO');
    } else {
        alert("No matching button or scroll area found for this section.");
        return;
    }

    // Store original styles
    const originalOverflow = scrollDiv.style.overflowY;
    const originalHeight = scrollDiv.style.height;

    // Hide the button and remove scroll styles
    hideBtn.style.display = 'none';
    scrollDiv.style.overflowY = 'visible';
    scrollDiv.style.height = 'auto';

    // PDF options
    var opt = {
        margin: 0.5,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1.5 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
        pagebreak: { mode: ['css'] }
    };

    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
        var totalPages = pdf.internal.getNumberOfPages();
        var pageWidth = pdf.internal.pageSize.getWidth();
        var pageHeight = pdf.internal.pageSize.getHeight();

        var today = new Date();
        var dateStr = today.toLocaleDateString();

        for (var i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            pdf.setFontSize(10);
            pdf.setTextColor(150);
            pdf.text('Downloaded on: ' + dateStr, pageWidth / 2, pageHeight - 0.6, { align: 'center' });//for date
            pdf.text('Page ' + i + ' of ' + totalPages, pageWidth / 2, pageHeight - 0.3, { align: 'center' });
        }
    }).save().then(() => {
        // Restore styles and show button
        hideBtn.style.display = 'inline-flex';
        scrollDiv.style.overflowY = originalOverflow;
        scrollDiv.style.height = originalHeight;
    });
}



</script>
