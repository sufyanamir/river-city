@include('layouts.header')
<div class="my-4" id="printable">
    <div class="bg-white w-full rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-3 bg-[#930027] text-white text-xl font-semibold rounded-t-lg flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('branch-reports.index') }}" class="text-white hover:text-gray-200">
                    ← Back to Reports
                </a>
                <span>Monthly Branch Target Report - {{ $year }}</span>
            </div>
            <div class="flex gap-2 no-print">
                <select id="branchSelect" class="px-3 py-1 rounded text-black text-sm">
                    <option value="">All Branches</option>
                    @foreach(\App\Models\CompanyBranches::all() as $branchOption)
                        <option value="{{ $branchOption->branch_name }}" {{ $selected_branch == $branchOption->branch_name ? 'selected' : '' }}>
                            {{ $branchOption->branch_name }}
                        </option>
                    @endforeach
                </select>
                <select id="yearSelect" class="px-3 py-1 rounded text-black text-sm">
                    @for($yearOption = date('Y') - 2; $yearOption <= date('Y') + 1; $yearOption++)
                        <option value="{{ $yearOption }}" {{ $yearOption == $year ? 'selected' : '' }}>{{ $yearOption }}</option>
                    @endfor
                </select>
                <button id="printReport" class="bg-gray-200 text-black px-3 py-1 rounded hover:bg-gray-300" title="Print Report">Print</button>
            </div>
        </div>

        <div class="p-4">
            @foreach($branches as $branch)
                @php 
                    $branchMonthlyData = $monthly_data[$branch->branch_name] ?? [];
                    $branchYearlyTarget = $branch->yearly_target ?: 0;
                @endphp
                
                <!-- Branch Header -->
                <div class="mb-8">
                    <div class="bg-gray-800 text-white p-3 rounded-t">
                        <div class="grid grid-cols-12 gap-2 text-sm font-semibold">
                            <div class="col-span-2">
                                <div class="font-bold text-lg">{{ $branch->branch_name }}</div>
                                <div class="text-xs">Target: ${{ number_format($branchYearlyTarget, 0) }}</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Plan</div>
                                <div class="text-xs">Monthly</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Actual</div>
                                <div class="text-xs">Monthly</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Plan</div>
                                <div class="text-xs">Cumulative</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Actual</div>
                                <div class="text-xs">Cumulative</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Variance</div>
                                <div class="text-xs">Monthly %</div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Data Rows -->
                    <div class="border border-t-0 rounded-b overflow-hidden">
                        @forelse($branchMonthlyData as $monthData)
                            <div class="grid grid-cols-12 gap-2 border-b border-gray-200 py-2 px-3 text-sm hover:bg-gray-50
                                {{ $monthData['variance_percent'] < -20 ? 'bg-red-50' : ($monthData['variance_percent'] > 20 ? 'bg-green-50' : '') }}">
                                
                                <!-- Month Info -->
                                <div class="col-span-2 font-semibold">
                                    <div>{{ $monthData['month_short'] }} {{ $year }}</div>
                                    <div class="text-xs text-gray-600">Month {{ $monthData['month_number'] }}</div>
                                </div>
                                
                                <!-- Planned Monthly -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold">${{ number_format($monthData['planned'], 0) }}</div>
                                </div>
                                
                                <!-- Actual Monthly -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold {{ $monthData['actual'] > $monthData['planned'] ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($monthData['actual'], 0) }}
                                    </div>
                                    <div class="text-xs {{ $monthData['achievement_percent'] >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                        ({{ $monthData['achievement_percent'] }}%)
                                    </div>
                                </div>
                                
                                <!-- Planned Cumulative -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold">${{ number_format($monthData['cumulative_planned'], 0) }}</div>
                                </div>
                                
                                <!-- Actual Cumulative -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold {{ $monthData['cumulative_actual'] > $monthData['cumulative_planned'] ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($monthData['cumulative_actual'], 0) }}
                                    </div>
                                    <div class="text-xs {{ $monthData['cumulative_variance_percent'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ({{ $monthData['cumulative_variance_percent'] }}%)
                                    </div>
                                </div>
                                
                                <!-- Monthly Variance % -->
                                <div class="col-span-2 text-center">
                                    <div class="font-bold {{ $monthData['variance_percent'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $monthData['variance_percent'] }}%
                                    </div>
                                    <div class="text-xs">
                                        ${{ number_format($monthData['variance'], 0) }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                No monthly data available for {{ $branch->branch_name }}
                            </div>
                        @endforelse
                    </div>

                    <!-- Branch Summary -->
                    @if(!empty($branchMonthlyData))
                        @php
                            // Get the last month's cumulative data for accurate YTD figures
                            $lastMonth = end($branchMonthlyData);
                            $cumulativePlanned = $lastMonth['cumulative_planned'];
                            $cumulativeActual = $lastMonth['cumulative_actual'];
                            $overallVariance = $cumulativeActual - $cumulativePlanned;
                            $overallVariancePercent = $cumulativePlanned > 0 ? round(($overallVariance / $cumulativePlanned) * 100, 1) : 0;
                            $overallAchievement = $cumulativePlanned > 0 ? round(($cumulativeActual / $cumulativePlanned) * 100, 1) : 0;
                            
                            // Calculate progress through the year for prorated target
                            $currentMonthNumber = count($branchMonthlyData);
                            $proratedYearlyTarget = ($branchYearlyTarget / 12) * $currentMonthNumber;
                            $yearlyAchievement = $proratedYearlyTarget > 0 ? round(($cumulativeActual / $proratedYearlyTarget) * 100, 1) : 0;
                            $yearlyVariancePercent = $proratedYearlyTarget > 0 ? round((($cumulativeActual - $proratedYearlyTarget) / $proratedYearlyTarget) * 100, 1) : 0;
                        @endphp
                        
                        <div class="bg-gray-100 p-3 rounded-b border-t-2 border-gray-300">
                            <div class="grid grid-cols-12 gap-2 text-sm font-bold">
                                <div class="col-span-2">TOTAL YTD</div>
                                <div class="col-span-2 text-center">${{ number_format($cumulativePlanned, 0) }}</div>
                                <div class="col-span-2 text-center {{ $cumulativeActual > $cumulativePlanned ? 'text-green-600' : 'text-red-600' }}">
                                    ${{ number_format($cumulativeActual, 0) }}
                                </div>
                                <div class="col-span-2 text-center">${{ number_format($proratedYearlyTarget, 0) }}</div>
                                <div class="col-span-2 text-center">{{ $overallAchievement }}%</div>
                                <div class="col-span-2 text-center {{ $overallVariancePercent >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $overallVariancePercent }}%
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            @if(count($branches) == 0)
                <div class="text-center py-8 text-gray-500">
                    <p class="text-lg">No branches found</p>
                    <p>Please add branches in settings first.</p>
                </div>
            @endif

            <!-- Monthly Performance Summary Chart -->
            @if(count($branches) > 0 && !empty($monthly_data))
                <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Monthly Performance Overview</h3>
                    
                    <!-- Chart Legend -->
                    <div class="flex gap-4 mb-4 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-blue-500 rounded"></div>
                            <span>Planned</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-green-500 rounded"></div>
                            <span>Actual</span>
                        </div>
                    </div>

                    @php
                        $labels = [];
                        $plannedTotals = array_fill(1, 12, 0);
                        $actualTotals = array_fill(1, 12, 0);

                        foreach ($branches as $b) {
                            $data = $monthly_data[$b->branch_name] ?? [];
                            foreach ($data as $md) {
                                $m = (int) $md['month_number'];
                                if ($m >= 1 && $m <= 12) {
                                    $plannedTotals[$m] += (float) $md['planned'];
                                    $actualTotals[$m] += (float) $md['actual'];
                                }
                            }
                        }

                        for ($m = 1; $m <= 12; $m++) {
                            $labels[] = date('M', mktime(0, 0, 0, $m, 1));
                        }
                    @endphp

                    <div class="h-64">
                        <canvas id="monthlyChart" height="256"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        (function(){
                            var ctx = document.getElementById('monthlyChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: {!! json_encode($labels) !!},
                                    datasets: [
                                        {
                                            label: 'Planned',
                                            backgroundColor: 'rgba(37, 99, 235, 0.5)',
                                            borderColor: 'rgba(37, 99, 235, 1)',
                                            borderWidth: 1,
                                            data: {!! json_encode(array_values($plannedTotals)) !!}
                                        },
                                        {
                                            label: 'Actual',
                                            backgroundColor: 'rgba(34, 197, 94, 0.5)',
                                            borderColor: 'rgba(34, 197, 94, 1)',
                                            borderWidth: 1,
                                            data: {!! json_encode(array_values($actualTotals)) !!}
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: { stacked: false },
                                        y: { beginAtZero: true }
                                    },
                                    plugins: {
                                        tooltip: { mode: 'index', intersect: false },
                                        legend: { position: 'top' }
                                    }
                                }
                            });
                        })();
                    </script>
                </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
$(document).ready(function() {
    $('#branchSelect, #yearSelect').on('change', function() {
        var selectedBranch = $('#branchSelect').val();
        var selectedYear = $('#yearSelect').val();
        var url = '{{ route("branch-reports.monthly") }}';
        
        if (selectedBranch) { url += '/' + encodeURIComponent(selectedBranch); }
        if (selectedYear) {
            url += (selectedBranch ? '/' : '/0/') + selectedYear;
        }
        
        window.location.href = url;
    });

    $('#printReport').on('click', function(e){
        e.preventDefault();
        window.print();
    });
});
</script>

<style>
/* Custom styles for the report */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}
@media print {
    body * { visibility: hidden; }
    #printable, #printable * { visibility: visible; }
    #printable { position: absolute; left: 0; top: 0; width: 100%; }
    .no-print { display: none !important; }
}
</style>
