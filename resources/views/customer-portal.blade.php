<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
    <style>
        * {
            overflow-y: visible !important;
        }
        /* Apply to the entire page */
::-webkit-scrollbar {
    width: 8px; /* Thickness of vertical scrollbar */
}

::-webkit-scrollbar-track {
    background: #f1f1f1; /* Track color */
}

::-webkit-scrollbar-thumb {
    background: #930027; /* Scroll thumb color */
    border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555; /* Thumb hover color */
}
        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table,
            table tbody,
            table tr,
            table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #fff;
                padding: 10px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 12px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>

<body class="bg-slate-300">
    <div class=" flex justify-center items-center  p-3">
        <div class=" bg-white rounded-lg  w-[100%] p-4">
            <div class="flex flex-wrap items-center justify-between gap-4 md:gap-8">
                <div class="w-full md:w-auto text-center md:text-left">
                    <div class="projectLogo">
                        <img class="w-[180px] md:w-[250px] lg:w-[288px] h-auto mx-auto md:mx-0"
                            src="{{ asset('assets/icons/tproject-logo.svg') }}"
                            alt="Logo">
                    </div>
                </div>
                <div class="w-full md:w-auto text-center md:text-left">
                    <p class="text-lg md:text-xl lg:text-[22px] font-bold text-[#323C47]">
                        River City Painting, Inc
                    </p>
                    <p class="mt-2 font-medium text-sm md:text-base lg:text-[17px] text-[#858585]">
                        @if($estimate->customer->branch == 'wichita')
                        4425 W Walker St<br>
                        Wichita Kansas 67209 <br>
                        info@paintwichita.com <br>
                        (316) 262-3289
                        @elseif($estimate->customer->branch == 'kansas')
                        12022 Blue Valley Pkwy<br>
                        Overland Park, Ks 66213 <br>
                        913-660-9099
                        <br>
                        office@rivercitypaintinginc.com <br>
                        @elseif($estimate->customer->branch == 'tulsa')
                        1904 W Iola St unit 101, <br>
                        Broken Arrow, OK 74012 <br>
                        918-973-0242
                        <br>
                        @endif
                    </p>
                </div>
            </div>
            <div class="mt-10 mb-10 text-center text-black font-bold text-xl">
                Active Proposal & Change Orders
            </div>
            <div>
                <div class="relative h-72 overflow-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $index => $proposal)
                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 dark:border-gray-700">
                                <td data-label="#" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </td>
                                <td data-label="Date" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ date('m/d/y H:i:s', strtotime($proposal->created_at)) }}
                                </td>
                                <td data-label="Type" class="px-6 py-4">
                                    {{ $proposal->proposal_type === 'estimate' ? 'Estimate' : 'Change Order' }}
                                </td>
                                <td data-label="Total" class="px-6 py-4">
                                    {{ $proposal->proposal_total }}
                                </td>
                                <td data-label="Status" class="px-6 py-4">
                                    {{ $proposal->proposal_status }}
                                </td>
                                <td data-label="Action" class="px-6 py-4">
                                    @if(!empty($proposal->proposal_data))
                                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ $proposal->proposal_status === 'pending' 
                ? '/viewProposal?estimateId=' . $proposal->estimate_proposal_id 
                : '/viewProposal?proposalId=' . $proposal->estimate_proposal_id }}{{ $proposal->group_id ? '&group_id=' . $proposal->group_id : '' }}">
                                        <button class="px-2 py-2 bg-blue-500 text-white rounded-md">view</button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-10 mb-10 text-center text-black font-bold text-xl">
                Invoices
            </div>
            <div>
                <div class="relative h-72 overflow-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tax
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Due
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $index => $invoice)
                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 dark:border-gray-700">
                                <td data-label="#" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </td>
                                <td data-label="Date" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ date('m/d/y H:i:s', strtotime($invoice->complete_invoice_date)) }}
                                </td>
                                <td data-label="Type" class="px-6 py-4">
                                    {{ $invoice->invoice_name }}
                                </td>
                                <td data-label="Type" class="px-6 py-4">
                                    {{ $invoice->tax_rate }}
                                </td>
                                <td data-label="Total" class="px-6 py-4">
                                    {{ $invoice->invoice_total }}
                                </td>
                                <td data-label="Status" class="px-6 py-4">
                                    {{ $invoice->invoice_due }}
                                </td>
                                <td data-label="Status" class="px-6 py-4">
                                    {{ $invoice->invoice_status }}
                                </td>
                                <td data-label="Action" class="px-6 py-4">
                                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/viewInvoice/{{ $invoice->estimate_complete_invoice_id }}">
                                        <button class="px-2 py-2 bg-blue-500 text-white rounded-md">view</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-10 mb-10 text-center text-black font-bold text-xl">
                Payments
            </div>
            <div>
                <div class="relative h-72 overflow-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $index => $payment)
                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 dark:border-gray-700">
                            <td data-label="#" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </td>    
                            <td data-label="Date" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ date('m/d/y H:i:s', strtotime($payment->complete_invoice_date)) }}
                                </td>
                                <td data-label="Total" class="px-6 py-4">
                                    {{ $payment->note }}
                                </td>
                                <td data-label="Status" class="px-6 py-4">
                                    {{ $payment->invoice_total }}
                                </td>
                                <td data-label="Action" class="px-6 py-4">
                                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/viewPayment/{{ $payment->estimate_payment_id }}">
                                        <button class="px-2 py-2 bg-blue-500 text-white rounded-md">view</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" mt-3 text-center">
                <a target="_blank" href="https://thewebconcept.com/" class="text-[#930027] hover:underline">
                    <span class="text-sm text-[#930027] sm:text-center my-auto dark:text-gray-400">Powered by : The Web Concept™.
                    </span>
                </a>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/topbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>