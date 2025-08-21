@include('layouts.header')
<div class="my-4" id="printable">
    <div class="bg-white w-full rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-3 bg-[#930027] text-white text-xl font-semibold rounded-t-lg flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('branch-reports.index') }}" class="text-white hover:text-gray-200">
                    ← Back to Reports
                </a>
                <span>Weekly Branch Target Report - {{ $year }}</span>
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
                    $branchWeeklyData = $weekly_data[$branch->branch_name] ?? [];
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
                                <div class="text-xs">Weekly</div>
                            </div>
                            <div class="col-span-2 text-center">
                                <div>Actual</div>
                                <div class="text-xs">Weekly</div>
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
                                <div class="text-xs">Weekly %</div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Data Rows -->
                    <div class="border border-t-0 rounded-b overflow-hidden">
                        @forelse($branchWeeklyData as $weekData)
                            <div class="grid grid-cols-12 gap-2 border-b border-gray-200 py-2 px-3 text-sm hover:bg-gray-50
                                {{ $weekData['variance_percent'] < -20 ? 'bg-red-50' : ($weekData['variance_percent'] > 20 ? 'bg-green-50' : '') }}">
                                
                                <!-- Week Info -->
                                <div class="col-span-2 font-semibold">
                                    <div>Week {{ $weekData['week_number'] }}</div>
                                    <div class="text-xs text-gray-600">{{ $weekData['week_ending'] }}</div>
                                </div>
                                
                                <!-- Planned Weekly -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold">${{ number_format($weekData['planned'], 0) }}</div>
                                </div>
                                
                                <!-- Actual Weekly -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold {{ $weekData['actual'] > $weekData['planned'] ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($weekData['actual'], 0) }}
                                    </div>
                                    <div class="text-xs {{ $weekData['achievement_percent'] >= 100 ? 'text-green-600' : 'text-red-600' }}">
                                        ({{ $weekData['achievement_percent'] }}%)
                                    </div>
                                </div>
                                
                                <!-- Planned Cumulative -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold">${{ number_format($weekData['cumulative_planned'], 0) }}</div>
                                </div>
                                
                                <!-- Actual Cumulative -->
                                <div class="col-span-2 text-center">
                                    <div class="font-semibold {{ $weekData['cumulative_actual'] > $weekData['cumulative_planned'] ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($weekData['cumulative_actual'], 0) }}
                                    </div>
                                    <div class="text-xs {{ $weekData['cumulative_variance_percent'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ({{ $weekData['cumulative_variance_percent'] }}%)
                                    </div>
                                </div>
                                
                                <!-- Weekly Variance % -->
                                <div class="col-span-2 text-center">
                                    <div class="font-bold {{ $weekData['variance_percent'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $weekData['variance_percent'] }}%
                                    </div>
                                    <div class="text-xs">
                                        ${{ number_format($weekData['variance'], 0) }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                No weekly data available for {{ $branch->branch_name }}
                            </div>
                        @endforelse
                    </div>

                    <!-- Branch Summary -->
                    @if(!empty($branchWeeklyData))
                        @php
                            // Get the last week's cumulative data for accurate YTD figures
                            $lastWeek = end($branchWeeklyData);
                            $cumulativePlanned = $lastWeek['cumulative_planned'];
                            $cumulativeActual = $lastWeek['cumulative_actual'];
                            $overallVariance = $cumulativeActual - $cumulativePlanned;
                            $overallVariancePercent = $cumulativePlanned > 0 ? round(($overallVariance / $cumulativePlanned) * 100, 1) : 0;
                            $overallAchievement = $cumulativePlanned > 0 ? round(($cumulativeActual / $cumulativePlanned) * 100, 1) : 0;
                            
                            // Calculate progress through the year for prorated target
                            $currentWeekNumber = count($branchWeeklyData);
                            $firstDayOfYear = \Carbon\Carbon::createFromDate($year, 1, 1);
                            $lastDayOfYear = \Carbon\Carbon::createFromDate($year, 12, 31);
                            $weeksInYear = ceil($lastDayOfYear->diffInDays($firstDayOfYear) / 7);
                            $proratedYearlyTarget = ($branchYearlyTarget / $weeksInYear) * $currentWeekNumber;
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
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
$(document).ready(function() {
    $('#branchSelect, #yearSelect').on('change', function() {
        var selectedBranch = $('#branchSelect').val();
        var selectedYear = $('#yearSelect').val();
        var url = '{{ route("branch-reports.weekly") }}';
        
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
