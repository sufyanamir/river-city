@include('layouts.header')
<style>
    /* Active Tab Style */
    .tab-btn.active {
        background-color: #930027 !important;
        color: white !important;
        border-color: #930027 !important;
    }
    
    .filter-form {
        background: linear-gradient(135deg, #930027 0%, #b8002e 100%);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(147, 0, 39, 0.3);
    }
    
    .date-input {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .date-input:focus {
        border-color: #930027;
        box-shadow: 0 0 0 3px rgba(147, 0, 39, 0.1);
        outline: none;
    }
    
    .filter-btn {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        color: #930027;
        border: 2px solid #ffffff;
        transition: all 0.3s ease;
    }
    
    .filter-btn:hover {
        background: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .reset-btn {
        background: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
        transition: all 0.3s ease;
    }
    
    .reset-btn:hover {
        background: #ffffff;
        color: #930027;
        transform: translateY(-1px);
    }
</style>

<div class="my-4 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl">Sale Analytics</h1>
    <div class="bg-white w-full">
        <div class="p-3">
            <!-- Date Filter Form -->
            <div class="filter-form p-6 mb-6">
                <div class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="from_date" class="block text-sm font-medium text-white mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>From Date
                        </label>
                        <input type="date" id="from_date" 
                               class="date-input w-full px-4 py-2 text-gray-900"
                               value="{{ request('from_date') }}"
                               max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="flex-1 min-w-[200px]">
                        <label for="to_date" class="block text-sm font-medium text-white mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>To Date
                        </label>
                        <input type="date" id="to_date" 
                               class="date-input w-full px-4 py-2 text-gray-900"
                               value="{{ request('to_date') }}"
                               max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="#" onclick="filterByDate(); return false;" class="filter-btn px-6 py-2 rounded-lg font-semibold flex items-center">
                            <i class="fas fa-search mr-2"></i>Filter
                        </a>
                        <a href="/saleAnalytics" class="reset-btn px-6 py-2 rounded-lg font-semibold flex items-center">
                            <i class="fas fa-refresh mr-2"></i>Reset
                        </a>
                    </div>
                </div>
                  
                  <script>
                    function filterByDate() {
                        const fromDate = document.getElementById('from_date').value;
                        const toDate = document.getElementById('to_date').value;
                        
                        let url = '/saleAnalytics';
                        
                        // Add date parameters if they exist
                        if (fromDate || toDate) {
                            url += '?';
                            if (fromDate) {
                                url += 'from_date=' + fromDate;
                            }
                            
                            if (toDate) {
                                if (fromDate) {
                                    url += '&';
                                }
                                url += 'to_date=' + toDate;
                            }
                        }
                        
                        // Navigate to the constructed URL
                        window.location.href = url;
                    }
                  </script>
                
                @if(request('from_date') || request('to_date'))
                    <div class="mt-4 p-3 bg-white bg-opacity-20 rounded-lg">
                        <p class="text-white text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            Showing data 
                            @if(request('from_date') && request('to_date'))
                                from {{ \Carbon\Carbon::parse(request('from_date'))->format('M d, Y') }} 
                                to {{ \Carbon\Carbon::parse(request('to_date'))->format('M d, Y') }}
                            @elseif(request('from_date'))
                                from {{ \Carbon\Carbon::parse(request('from_date'))->format('M d, Y') }} onwards
                            @elseif(request('to_date'))
                                up to {{ \Carbon\Carbon::parse(request('to_date'))->format('M d, Y') }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>

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
                                    <h3 class="font-medium text-gray-700">
                                        @if(request('from_date') && request('to_date'))
                                            Period Sales
                                        @else
                                            Daily Sales
                                        @endif
                                    </h3>
                                    <p class="text-2xl font-bold">${{ number_format($dailySales, 2) }}</p>
                                </div>
                                @if(!request('from_date') && !request('to_date'))
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
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2 text-left">Invoice Status</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="my-auto">
                                    <div class="bg-white p-4 flex justify-between rounded-lg shadow mb-4">
                                        <h3 class="font-medium text-gray-700">Paid Invoices</h3>
                                        <div>
                                            <p class="text-2xl font-bold text-green-600">{{ $paidInvoicesPercent }}%</p>
                                            <p class="text-sm text-gray-500">${{ number_format($paidInvoicesTotal, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bg-white p-4 flex justify-between rounded-lg shadow">
                                        <h3 class="font-medium text-gray-700">Unpaid Invoices</h3>
                                        <div>
                                            <p class="text-2xl font-bold text-red-600">{{ $unpaidInvoicesPercent }}%</p>
                                            <p class="text-sm text-gray-500">
                                                ${{ number_format($unpaidInvoicesTotal, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-auto">
                                    <div class="bg-white my-2 rounded-2xl w-auto xl:w-[100%]">
                                        <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                                            <h3 class="text-lg font-semibold flex justify-start">Invoice Status
                                                Distribution
                                            </h3>
                                        </div>
                                        <div
                                            class="my-2 text-white text-center flex justify-center md:block lg:block xl:block mx-auto">
                                            <canvas id="myDoughnutChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                        aria-labelledby="contacts-tab">
                        <h2 class="text-xl font-semibold mb-4 text-left">Top 10 Highest Value Estimates by Branch</h2>
                        
                        @if(!empty($topEstimatesByBranch))
                            <!-- Branch Tabs Navigation -->
                            <div class="mb-4 border-b border-gray-200">
                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="branch-tabs" role="tablist">
                                    @foreach($topEstimatesByBranch as $branch => $estimates)
                                        @php
                                            $branchId = 'branch-' . Str::slug($branch);
                                            $isFirst = $loop->first;
                                        @endphp
                                        <li class="me-2" role="presentation">
                                            <button class="branch-tab-btn inline-block p-3 border-b-2 rounded-t-lg {{ $isFirst ? 'text-[#930027] border-[#930027]' : 'text-gray-500 border-gray-300 hover:text-[#930027] hover:border-[#930027]' }}"
                                                    id="{{ $branchId }}-tab" 
                                                    data-tabs-target="#{{ $branchId }}" 
                                                    type="button" 
                                                    role="tab" 
                                                    aria-controls="{{ $branchId }}"
                                                    aria-selected="{{ $isFirst ? 'true' : 'false' }}">
                                                <i class="fas fa-building mr-2"></i>{{ $branch }} Branch
                                                <span class="ml-2 bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs">{{ count($estimates) }}</span>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <!-- Branch Tab Content -->
                            <div id="branch-tab-content">
                                @foreach($topEstimatesByBranch as $branch => $estimates)
                                    @php
                                        $branchId = 'branch-' . Str::slug($branch);
                                        $isFirst = $loop->first;
                                    @endphp
                                    <div class="{{ $isFirst ? '' : 'hidden' }} p-4 rounded-lg bg-white" id="{{ $branchId }}" role="tabpanel" aria-labelledby="{{ $branchId }}-tab">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-[#930027]">
                                                <i class="fas fa-chart-line mr-2"></i>{{ $branch }} Branch - Top Estimates
                                            </h3>
                                            <div class="text-sm text-gray-600">
                                                <span class="bg-[#930027] text-white px-3 py-1 rounded-full">
                                                    {{ count($estimates) }} Estimate{{ count($estimates) > 1 ? 's' : '' }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="overflow-x-auto">
                                            <table class="universalTable display" style="width:100%">
                                                <thead class="bg-[#930027] text-white text-center text-sm">
                                                    <tr>
                                                        <th class="py-3 px-3">Rank</th>
                                                        <th class="py-3 px-3">Estimate #</th>
                                                        <th class="py-3 px-3">Date</th>
                                                        <th class="py-3 px-3">Customer</th>
                                                        <th class="py-3 px-3">Project Type</th>
                                                        <th class="py-3 px-3">Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="universalTableBody text-center text-sm">
                                                    @forelse($estimates as $index => $estimate)
                                                        <tr class="border-t hover:bg-gray-50 transition-colors duration-200">
                                                            <td class="py-3 px-3">
                                                                <span >
                                                                    {{ $index + 1 }}
                                                                </span>
                                                            </td>
                                                            <td class="py-3 px-3 font-medium text-[#930027]">{{ $estimate->estimate_id }}</td>
                                                            <td class="py-3 px-3">{{ \Carbon\Carbon::parse($estimate->created_at)->format('M d, Y') }}</td>
                                                            <td class="py-3 px-3 font-medium">{{ $estimate->customer ? $estimate->customer->customer_first_name : 'N/A' }}</td>
                                                            <td class="py-3 px-3">
                                                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                                    {{ $estimate->project_type ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                            <td class="py-3 px-3 text-right">
                                                                <span class="font-bold text-green-600 text-lg">
                                                                    ${{ number_format($estimate->estimate_total, 2) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center py-8">
                                                                <div class="text-gray-500">
                                                                    <i class="fas fa-inbox text-3xl mb-2"></i>
                                                                    <p class="text-lg">No estimates found for this branch</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-gray-500">
                                    <i class="fas fa-chart-bar text-4xl mb-4"></i>
                                    <p class="text-xl font-medium">No estimates found</p>
                                    <p class="text-sm mt-2">Try adjusting your date filters or check back later.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts2" role="tabpanel"
                        aria-labelledby="contacts2-tab">
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
                                                <td class="py-2 px-4">{{ $revenueByProjectTypePercent[$type] ?? 0 }}%
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">No project type data
                                                    available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts3" role="tabpanel"
                        aria-labelledby="contacts3-tab">
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
                                                <td class="py-2 px-4">{{ $revenueByBuildingTypePercent[$type] ?? 0 }}%
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">No building type data
                                                    available</td>
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
</div>

<script>
    $(document).ready(function() {
        $('#universalTable').DataTable();
        $('#universalTable2').DataTable();
        
        // Date validation
        const fromDate = document.getElementById('from_date');
        const toDate = document.getElementById('to_date');
        
        fromDate.addEventListener('change', function() {
            if (this.value && toDate.value && this.value > toDate.value) {
                alert('From date cannot be greater than To date');
                this.value = '';
            }
            if (this.value) {
                toDate.min = this.value;
            }
        });
        
        toDate.addEventListener('change', function() {
            if (this.value && fromDate.value && this.value < fromDate.value) {
                alert('To date cannot be less than From date');
                this.value = '';
            }
            if (this.value) {
                fromDate.max = this.value;
            }
        });
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
                        '#4CAF50' // Paid - green
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
                            font: {
                                size: 14
                            }
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
    
    // Branch tabs functionality
    document.querySelectorAll(".branch-tab-btn").forEach(tab => {
        tab.addEventListener("click", function() {
            // Remove active classes from all branch tabs
            document.querySelectorAll(".branch-tab-btn").forEach(btn => {
                btn.classList.remove("text-[#930027]", "border-[#930027]");
                btn.classList.add("text-gray-500", "border-gray-300");
            });
            
            // Add active classes to clicked tab
            this.classList.remove("text-gray-500", "border-gray-300");
            this.classList.add("text-[#930027]", "border-[#930027]");
            
            // Hide all branch tab content
            document.querySelectorAll("#branch-tab-content > div").forEach(content => {
                content.classList.add("hidden");
            });
            
            // Show target content
            const target = this.getAttribute("data-tabs-target");
            if (target) {
                const targetElement = document.querySelector(target);
                if (targetElement) {
                    targetElement.classList.remove("hidden");
                }
            }
        });
    });
</script>

@include('layouts.footer')