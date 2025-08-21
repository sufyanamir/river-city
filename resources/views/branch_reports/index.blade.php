@include('layouts.header')
<div class="my-4">
    <div class="bg-white w-full rounded-lg shadow-lg">
        <div class="p-3 bg-[#930027] text-white text-xl font-semibold rounded-t-lg flex justify-between items-center">
            <span>Branch Target Reports - {{ $current_year }}</span>
            <div class="flex gap-2">
                <select id="yearSelect" class="px-3 py-1 rounded text-black text-sm">
                    @for($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                        <option value="{{ $year }}" {{ $year == $current_year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                @php
                    $totalTarget = collect($branches)->sum('yearly_target');
                    $totalActual = collect($branches)->sum('actual_revenue');
                    $totalVariance = $totalActual - $totalTarget;
                    $totalVariancePercent = $totalTarget > 0 ? round(($totalVariance / $totalTarget) * 100, 1) : 0;
                @endphp
                
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800">Total Target</h3>
                    <p class="text-2xl font-bold text-blue-600">${{ number_format($totalTarget, 0) }}</p>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800">Total Actual</h3>
                    <p class="text-2xl font-bold text-green-600">${{ number_format($totalActual, 0) }}</p>
                </div>
                
                <div class="bg-{{ $totalVariance >= 0 ? 'green' : 'red' }}-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-{{ $totalVariance >= 0 ? 'green' : 'red' }}-800">Total Variance</h3>
                    <p class="text-2xl font-bold text-{{ $totalVariance >= 0 ? 'green' : 'red' }}-600">
                        ${{ number_format($totalVariance, 0) }} ({{ $totalVariancePercent }}%)
                    </p>
                </div>
                
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-purple-800">Achievement</h3>
                    <p class="text-2xl font-bold text-purple-600">
                        {{ $totalTarget > 0 ? round(($totalActual / $totalTarget) * 100, 1) : 0 }}%
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mb-6">
                <a href="{{ route('branch-reports.weekly') }}" class="bg-[#930027] text-white px-4 py-2 rounded-md hover:bg-[#7a0020] transition">
                    Weekly Reports
                </a>
                <a href="{{ route('branch-reports.monthly') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Monthly Reports
                </a>
            </div>

            <!-- Branch Performance Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Branch</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Location</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Yearly Target</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Actual Revenue</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Variance</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Achievement %</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $branchData)
                            @php $branch = $branchData['branch']; @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2 font-semibold">
                                    {{ $branch->branch_name }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    {{ $branch->branch_city }}{{ $branch->branch_city && $branch->branch_state ? ', ' : '' }}{{ $branch->branch_state }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    ${{ number_format($branchData['yearly_target'], 0) }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    ${{ number_format($branchData['actual_revenue'], 0) }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    <span class="text-{{ $branchData['variance'] >= 0 ? 'green' : 'red' }}-600 font-semibold">
                                        ${{ number_format($branchData['variance'], 0) }} 
                                        ({{ $branchData['variance_percent'] }}%)
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <span class="inline-block px-2 py-1 rounded text-sm font-semibold
                                        @if($branchData['achievement_percent'] >= 100) bg-green-100 text-green-800
                                        @elseif($branchData['achievement_percent'] >= 75) bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $branchData['achievement_percent'] }}%
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <div class="flex gap-1 justify-center">
                                        <a href="{{ route('branch-reports.weekly', [$branch->branch_name, $current_year]) }}" 
                                           class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 transition"
                                           title="Weekly Report">
                                            Weekly
                                        </a>
                                        <a href="{{ route('branch-reports.monthly', [$branch->branch_name, $current_year]) }}" 
                                           class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600 transition"
                                           title="Monthly Report">
                                            Monthly
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                    No branches found. Please add branches in settings first.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(count($branches) > 0)
            <!-- Performance Chart Placeholder -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Branch Performance Overview</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($branches as $branchData)
                            @php $branch = $branchData['branch']; @endphp
                            <div class="bg-white p-4 rounded border">
                                <h4 class="font-semibold mb-2">{{ $branch->branch_name }}</h4>
                                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                                    <div class="bg-[#930027] h-4 rounded-full" 
                                         style="width: {{ min($branchData['achievement_percent'], 100) }}%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>${{ number_format($branchData['actual_revenue'], 0) }}</span>
                                    <span>${{ number_format($branchData['yearly_target'], 0) }}</span>
                                </div>
                                <p class="text-center text-sm font-semibold mt-1">
                                    {{ $branchData['achievement_percent'] }}% Achievement
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
$(document).ready(function() {
    $('#yearSelect').on('change', function() {
        var selectedYear = $(this).val();
        window.location.href = '{{ route("branch-reports.index") }}?year=' + selectedYear;
    });
});
</script>
