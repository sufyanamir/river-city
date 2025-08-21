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

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    .status-paid {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status-unpaid {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .invoice-row:hover {
        background-color: #f9fafb;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
</style>

<div class="my-4 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold bg-[#930027] text-white py-3 px-4 rounded-t-xl flex items-center">
        <i class="fas fa-file-invoice-dollar mr-3"></i>
        {{ ucfirst($status) }} Invoices
        @if($fromDate || $toDate)
            <span class="ml-2 text-sm font-normal opacity-80">
                ({{ $fromDate && $toDate ? 'From ' . \Carbon\Carbon::parse($fromDate)->format('M d, Y') . ' to ' . \Carbon\Carbon::parse($toDate)->format('M d, Y') : ($fromDate ? 'From ' . \Carbon\Carbon::parse($fromDate)->format('M d, Y') . ' onwards' : 'Up to ' . \Carbon\Carbon::parse($toDate)->format('M d, Y')) }})
            </span>
        @endif
    </h1>
    
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
                               value="{{ $fromDate }}"
                               max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="flex-1 min-w-[200px]">
                        <label for="to_date" class="block text-sm font-medium text-white mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>To Date
                        </label>
                        <input type="date" id="to_date" 
                               class="date-input w-full px-4 py-2 text-gray-900"
                               value="{{ $toDate }}"
                               max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="#" onclick="filterByDate(); return false;" class="filter-btn px-6 py-2 rounded-lg font-semibold flex items-center">
                            <i class="fas fa-search mr-2"></i>Filter
                        </a>
                        <a href="{{ route('invoiceDetails', ['status' => $status]) }}" class="reset-btn px-6 py-2 rounded-lg font-semibold flex items-center">
                            <i class="fas fa-refresh mr-2"></i>Reset
                        </a>
                        <a href="{{ route('saleAnalytics') }}" class="reset-btn px-6 py-2 rounded-lg font-semibold flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Analytics
                        </a>
                    </div>
                </div>
                
                <script>
                    function filterByDate() {
                        const fromDate = document.getElementById('from_date').value;
                        const toDate = document.getElementById('to_date').value;
                        
                        let url = '{{ route("invoiceDetails", ["status" => $status]) }}';
                        
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
                
                @if($fromDate || $toDate)
                    <div class="mt-4 p-3 bg-white bg-opacity-20 rounded-lg">
                        <p class="text-white text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            Showing data 
                            @if($fromDate && $toDate)
                                from {{ \Carbon\Carbon::parse($fromDate)->format('M d, Y') }} 
                                to {{ \Carbon\Carbon::parse($toDate)->format('M d, Y') }}
                            @elseif($fromDate)
                                from {{ \Carbon\Carbon::parse($fromDate)->format('M d, Y') }} onwards
                            @elseif($toDate)
                                up to {{ \Carbon\Carbon::parse($toDate)->format('M d, Y') }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 {{ $status === 'paid' ? 'border-green-500' : 'border-red-500' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-600">Total {{ ucfirst($status) }} Invoices</h3>
                            <p class="text-2xl font-bold {{ $status === 'paid' ? 'text-green-600' : 'text-red-600' }}">{{ $invoices->count() }}</p>
                        </div>
                        <div class="p-3 rounded-full {{ $status === 'paid' ? 'bg-green-100' : 'bg-red-100' }}">
                            <i class="fas fa-file-invoice text-xl {{ $status === 'paid' ? 'text-green-600' : 'text-red-600' }}"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-600">Total Amount</h3>
                            <p class="text-2xl font-bold text-blue-600">${{ number_format($invoices->sum('invoice_total'), 2) }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100">
                            <i class="fas fa-dollar-sign text-xl text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-600">Average Amount</h3>
                            <p class="text-2xl font-bold text-purple-600">
                                ${{ $invoices->count() > 0 ? number_format($invoices->sum('invoice_total') / $invoices->count(), 2) : '0.00' }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100">
                            <i class="fas fa-chart-bar text-xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#930027] text-white px-6 py-4">
                    <h2 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-list mr-3"></i>
                        {{ ucfirst($status) }} Invoices Details
                        <span class="ml-2 bg-white bg-opacity-20 px-2 py-1 rounded-full text-sm">
                            {{ $invoices->count() }} invoice{{ $invoices->count() != 1 ? 's' : '' }}
                        </span>
                    </h2>
                </div>
                
                <div class="overflow-x-auto">
                    @if($invoices->count() > 0)
                        <table class="universalTable display w-full" style="width:100%">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th class="py-3 px-6 text-left font-semibold">Invoice ID</th>
                                    <th class="py-3 px-6 text-left font-semibold">Invoice Name</th>
                                    <th class="py-3 px-6 text-left font-semibold">Date</th>
                                    <th class="py-3 px-6 text-left font-semibold">Customer</th>
                                    <th class="py-3 px-6 text-left font-semibold">Project</th>
                                    <th class="py-3 px-6 text-right font-semibold">Subtotal</th>
                                    <th class="py-3 px-6 text-right font-semibold">Tax Rate</th>
                                    <th class="py-3 px-6 text-right font-semibold">Total</th>
                                    <th class="py-3 px-6 text-center font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($invoices as $invoice)
                                    <tr class="invoice-row">
                                        <td class="py-4 px-6 text-sm">
                                            <span class="font-mono font-semibold text-[#930027]">
                                                #{{ str_pad($invoice->estimate_complete_invoice_id, 5, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium">
                                            {{ $invoice->invoice_name ?: 'N/A' }}
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            {{ \Carbon\Carbon::parse($invoice->complete_invoice_date)->format('M d, Y') }}
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            @if($invoice->estimate && $invoice->estimate->customer)
                                                <div>
                                                    <div class="font-medium">
                                                        {{ $invoice->estimate->customer->customer_first_name }} {{ $invoice->estimate->customer->customer_last_name }}
                                                    </div>
                                                    <div class="text-gray-500 text-xs">
                                                        {{ $invoice->estimate->customer->customer_phone }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm">
                                            @if($invoice->estimate)
                                                <div>
                                                    <div class="font-medium">{{ $invoice->estimate->project_name ?: 'N/A' }}</div>
                                                    @if($invoice->estimate->project_type)
                                                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mt-1">
                                                            {{ $invoice->estimate->project_type }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-right font-semibold">
                                            ${{ number_format($invoice->invoice_subtotal ?: 0, 2) }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-right">
                                            {{ $invoice->tax_rate ? $invoice->tax_rate . '%' : 'N/A' }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-right">
                                            <span class="font-bold text-lg {{ $status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                                ${{ number_format($invoice->invoice_total, 2) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="status-badge status-{{ $invoice->invoice_status }}">
                                                <i class="fas {{ $invoice->invoice_status === 'paid' ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                                                {{ $invoice->invoice_status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-16">
                            <div class="text-gray-400">
                                <i class="fas fa-file-invoice text-6xl mb-4"></i>
                                <h3 class="text-xl font-medium mb-2">No {{ $status }} invoices found</h3>
                                <p class="text-sm">
                                    @if($fromDate || $toDate)
                                        Try adjusting your date filters or check a different period.
                                    @else
                                        There are currently no {{ $status }} invoices in the system.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.universalTable').DataTable({
            "pageLength": 25,
            "order": [[ 2, "desc" ]],
            "responsive": true,
            "columnDefs": [
                { "orderable": false, "targets": [8] }
            ]
        });
        
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

@include('layouts.footer')
