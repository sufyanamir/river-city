@include('layouts.header')
<style>
    /* Active Tab Style */
    .tab-btn.active {
        background-color: #930027 !important;
        /* Your dark red */
        color: white !important;
        border-color: #930027 !important;
    }
</style>

<div class=" my-4 rounded-lg shadow-lg">
    <h1 class="  text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Sale Analytics</h1>
    <div class=" bg-white w-full ">
        <div class="p-3">
            <div class="text-right mb-3">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="tab-btn inline-block p-2 border-b-2 rounded-t-lg" id="profile-tab"
                                data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Total Sales Per Period</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="tab-btn inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="false">Paid/Unpaid Invoices</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Top 10 Highest Value Estimate</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts2-tab" data-tabs-target="#contacts2" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Revenue by Project Type</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts3-tab" data-tabs-target="#contacts3" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Revenue by Building Type</button>

                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        {{-- <div class="mb-4">
                            <form action="/saleAnalytics" method="GET" class="bg-white p-4 rounded-lg shadow mb-4">
                                <h3 class="font-medium text-gray-700 text-left mb-2">Filter by Period</h3>
                                <div class="flex flex-wrap items-center gap-4">
                                    <div class="flex items-center">
                                        <label for="period" class="mr-2">Period:</label>
                                        <select name="period" id="period" class="border rounded px-2 py-1">
                                            <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Day</option>
                                            <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Week</option>
                                            <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Month</option>
                                            <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Year</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-[#930027] text-white px-4 py-1 rounded hover:bg-red-700">Apply Filter</button>
                                </div>
                            </form>
                        </div> --}}
                        <div>
                            <h2 class="text-xl font-semibold text-left mb-2">Sales Summary</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Total Sales</h3>
                                    <p class="text-2xl font-bold">{{ number_format($totalSales, 0) }}</p>
                                </div>
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Total Revenue</h3>
                                    <p class="text-2xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                                </div>
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Daily Sales</h3>
                                    <p class="text-2xl font-bold">${{ number_format($dailySales, 2) }}</p>
                                </div>
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Weekly Sales</h3>
                                    <p class="text-2xl font-bold">${{ number_format($weeklySales, 2) }}</p>
                                </div>
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Monthly Sales</h3>
                                    <p class="text-2xl font-bold">${{ number_format($monthlySales, 2) }}</p>
                                </div>
                                <div class="bg-white p-4 my-auto rounded-lg shadow flex justify-between">
                                    <h3 class="font-medium text-gray-700">Yearly Sales</h3>
                                    <p class="text-2xl font-bold">${{ number_format($yearlySales, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-left">Daily Sales</h3>
                            <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 text-left">Month</th>
                                            <th class="py-2 px-4 text-right">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlySales as $month => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ $month }}</td>
                                            <td class="py-2 px-4 text-right">${{ number_format($revenue, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr class="border-t">
                                            <td colspan="2" class="py-4 text-center">No monthly sales data available for this period</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-left">Weekly Sales</h3>
                            <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 text-left">Month</th>
                                            <th class="py-2 px-4 text-right">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlySales as $month => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ $month }}</td>
                                            <td class="py-2 px-4 text-right">${{ number_format($revenue, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr class="border-t">
                                            <td colspan="2" class="py-4 text-center">No monthly sales data available for this period</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-left">Monthly Sales</h3>
                            <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 text-left">Month</th>
                                            <th class="py-2 px-4 text-right">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlySales as $month => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ $month }}</td>
                                            <td class="py-2 px-4 text-right">${{ number_format($revenue, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr class="border-t">
                                            <td colspan="2" class="py-4 text-center">No monthly sales data available for this period</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-left">Yearly Sales</h3>
                            <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 text-left">Year</th>
                                            <th class="py-2 px-4 text-right">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($yearlySales as $year => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ $year }}</td>
                                            <td class="py-2 px-4 text-right">${{ number_format($revenue, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr class="border-t">
                                            <td colspan="2" class="py-4 text-center">No yearly sales data available for this period</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Invoice Status</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white p-4 flex justify-between rounded-lg shadow">
                                    <h3 class="font-medium text-gray-700">Paid Invoices</h3>
                                    <div>
                                        <p class="text-2xl font-bold text-green-600">{{ $paidInvoicesPercent }}%</p>
                                        <p class="text-sm text-gray-500">${{ number_format($paidInvoicesTotal, 2) }}</p>
                                    </div>
                                </div>
                                <div class="bg-white p-4 flex justify-between rounded-lg shadow">
                                    <h3 class="font-medium text-gray-700">Unpaid Invoices</h3>
                                    <div>
                                        <p class="text-2xl font-bold text-red-600">{{ $unpaidInvoicesPercent }}%</p>
                                        <p class="text-sm text-gray-500">${{ number_format($unpaidInvoicesTotal, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-center items-center">
                            <div class="bg-white my-2 rounded-2xl w-auto xl:w-[20%]">
                                <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                                    <h3 class="text-lg font-semibold flex justify-start">Invoice Status Distribution</h3>
                                </div>
                                <div class="my-2 text-white text-center flex justify-center md:block lg:block xl:block mx-auto">
                                    <canvas id="myDoughnutChart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                        aria-labelledby="contacts-tab">
                        <h2 class="text-xl font-semibold mb-4">Top 10 Highest Value Estimates</h2>
                        <div class="py-4 overflow-x-auto">
                            <div class="">
                                <table id="" class="universalTable display" style="width:100%">
                                    <thead class="bg-[#930027] text-white text-center text-sm">
                                        <tr>
                                            <th class="py-3 px-2">Rank</th>
                                            <th class="py-3 px-2">Estimate #</th>
                                            <th class="py-3 px-2">Date</th>
                                            <th class="py-3 px-2">Customer</th>
                                            <th class="py-3 px-2">Project Type</th>
                                            <th class="py-3 px-2">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="universalTableBody2" class="universalTableBody text-center text-sm">
                                        @forelse($topEstimates as $index => $estimate)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $estimate->estimate_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($estimate->created_at)->format('M d, Y') }}</td>
                                            <td>{{ $estimate->customer ? $estimate->customer->customer_first_name : 'N/A' }}</td>
                                            <td>{{ $estimate->project_type ?? 'N/A' }}</td>
                                            <td class="text-right font-semibold">${{ number_format($estimate->estimate_total, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">No estimates found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts2" role="tabpanel" aria-labelledby="contacts2-tab">
                        <h2 class="text-xl font-semibold mb-4 text-left">Revenue by Project Type</h2>
                        
                        <div class="">
                            <div class="bg-white py-2 rounded-lg shadow overflow-x-auto">
                                <table class="universalTable display" style="width:100%">
                                    <thead class="bg-[#930027] text-white text-center text-sm">
                                        <tr>
                                            <th class="py-2 px-4">Project Type</th>
                                            <th class="py-2 px-4">Revenue</th>
                                            <th class="py-2 px-4">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-left">
                                        @forelse($revenueByProjectType as $type => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ ucwords($type ?: 'Unspecified') }}</td>
                                            <td class="py-2 px-4">${{ number_format($revenue, 2) }}</td>
                                            <td class="py-2 px-4">{{ $revenueByProjectTypePercent[$type] ?? 0 }}%</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">No project type data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- <div class="bg-white p-4 rounded-lg shadow">
                                <div class="bg-[#930027] rounded-t-lg p-2 text-white">
                                    <h3 class="text-lg font-semibold">Project Type Distribution</h3>
                                </div>
                                <div class="my-2 text-center flex justify-center">
                                    <canvas id="myDoughnutChart2"></canvas>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts3" role="tabpanel" aria-labelledby="contacts3-tab">
                        <h2 class="text-xl font-semibold mb-4 text-left">Revenue by Building Type</h2>
                        <div class="">
                            <div class="bg-white py-2 rounded-lg shadow overflow-x-auto">
                                <table class="universalTable display" style="width:100%">
                                    <thead class="bg-[#930027] text-white text-center text-sm">
                                        <tr>
                                            <th class="py-2 px-4">Building Type</th>
                                            <th class="py-2 px-4">Revenue</th>
                                            <th class="py-2 px-4">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-left">
                                        @forelse($revenueByBuildingType as $type => $revenue)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ ucwords($type ?: 'Unspecified') }}</td>
                                            <td class="py-2 px-4">${{ number_format($revenue, 2) }}</td>
                                            <td class="py-2 px-4">{{ $revenueByBuildingTypePercent[$type] ?? 0 }}%</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">No building type data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#universalTable').DataTable();
            $('#universalTable2').DataTable();
        });
    </script>

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Invoice Status Chart
            const ctx1 = document.getElementById('myDoughnutChart1').getContext('2d');
            new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Unpaid', 'Paid'],
                    datasets: [{
                        data: [{{ $unpaidInvoicesPercent }}, {{ $paidInvoicesPercent }}],
                        backgroundColor: [
                            '#FF5252', // Unpaid - red
                            '#4CAF50'  // Paid - green
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '90%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#000',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw;
                                    return `${label}: ${value}%`;
                                }
                            }
                        }
                    }
                }
            });

            // Project Type Revenue Chart
            const ctx2 = document.getElementById('myDoughnutChart2').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_keys($revenueByProjectType)) !!}.map(type => type ? ucwords(type) : 'Unspecified'),
                    datasets: [{
                        data: {!! json_encode(array_values($revenueByProjectTypePercent)) !!},
                        backgroundColor: [
                            '#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#E91E63',
                            '#00BCD4', '#FFEB3B', '#795548', '#607D8B', '#3F51B5'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#000',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw;
                                    return `${label}: ${value}%`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll(".tab-btn").forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
            });
        });

        // Set first tab active on page load
        document.querySelector(".tab-btn").classList.add("active");
    </script>

    @include('layouts.footer')
