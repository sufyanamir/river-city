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
                            <button class="tab-btn inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Total Sales Per Period</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="false">Paid/Unpaid Invoices</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Top 10 Highest Value Estimate</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts2-tab" data-tabs-target="#contacts2" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Revenue by Project Type</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="contacts3-tab" data-tabs-target="#contacts3" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">Advance Payment Analysis</button>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                        <div class="py-4 overflow-x-auto">
                            <div class="">
                                <table id="universalTable" class="display" style="width:100%">
                                    <thead class="bg-[#930027] text-white text-sm">
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Branch</th>
                                            <th>Type</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="universalTableBody" class=" universalTableBody text-sm">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style=" width:50px;"></td>
                                            <td style=" width:50px;"></td>
                                            <td>
                                                {{-- <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($item->project_type)
                                <p class="font-medium">Project Type:</p>
                                {{ ucwords($item->project_type) }}
                                @endif
                                @if ($item->building_type)
                                <p class="font-medium">Building Type:</p>
                                {{ ucwords($item->building_type) }}
                                @endif
                                </p> --}}
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex justify-center items-center">
                            <div class="bg-white  my-2 rounded-2xl w-auto xl:w-[30%]">
                                <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                                    <h3 class=" text-lg font-semibold flex justify-start">Orders</h3>
                                </div>
                                <div
                                    class=" my-2 text-white text-center flex justify-center md:block lg:block xl:block mx-auto">
                                    <canvas id="myDoughnutChart1"></canvas>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                        aria-labelledby="contacts-tab">

                       {{-- <p class="text-sm text-gray-500 dark:text-gray-400"> --}}
                        <div class="py-4 overflow-x-auto">
                            <div class="">
                                <table id="universalTable2" class="display" style="width:100%">
                                    <thead class="bg-[#930027] text-white text-sm">
                                        <tr>
                                            <th class="py-3 px-2"></th>
                                            <th class="py-3 px-2">Date</th>
                                            <th class="py-3 px-2">Name</th>
                                            <th class="py-3 px-2">Branch</th>
                                            <th class="py-3 px-2">Type</th>
                                            <th class="py-3 px-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="universalTableBody2" class=" universalTableBody text-sm">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- </p> --}}
                    </div>

                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 flex justify-center items-center"
                        id="contacts2" role="tabpanel" aria-labelledby="contacts2-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                        <div class="bg-white  my-2 rounded-2xl w-auto xl:w-[30%]">
                            <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                                <h3 class=" text-lg font-semibold flex justify-start">Orders</h3>
                            </div>
                            <div
                                class=" my-2 text-white text-center flex justify-center md:block lg:block xl:block mx-auto">
                                <canvas id="myDoughnutChart2"></canvas>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 flex justify-center items-center"
                        id="contacts3" role="tabpanel" aria-labelledby="contacts3-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                        <div class="bg-white  my-2 rounded-2xl w-auto xl:w-[30%]">
                            <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                                <h3 class=" text-lg font-semibold flex justify-start">Orders</h3>
                            </div>
                            <div
                                class=" my-2 text-white text-center flex justify-center md:block lg:block xl:block mx-auto">
                                <canvas id="myDoughnutChart3"></canvas>
                            </div>
                        </div>
                        </p>
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
            function createDoughnutChart(canvasId, chartLabels, chartData) {
                const ctx = document.getElementById(canvasId).getContext("2d");

                new Chart(ctx, {
                    type: "doughnut",
                    data: {
                        labels: chartLabels, // Har chart ke liye custom labels
                        datasets: [{
                            label: "Orders",
                            data: chartData,
                            backgroundColor: [
                                "#FFB300", // Pending / Label 1
                                "#4CAF50", // Completed / Label 2
                                "#F44336" // Cancelled / Label 3
                            ],
                            borderColor: "#fff",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '90%',
                        plugins: {
                            legend: {
                                display: true,
                                position: "top",
                                labels: {
                                    color: "#000",
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        let value = context.parsed;
                                        return `${label}: ${value} orders`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Har chart ke liye alag labels + data
            createDoughnutChart("myDoughnutChart1", ["Unpaid", "Paid"], [3, 39]);
            createDoughnutChart("myDoughnutChart2", ["Residential", "Commerical", ], [5, 18, ]);
            createDoughnutChart("myDoughnutChart3", ["Open", "Closed", "In Progress"], [20, 15, 7]);
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
