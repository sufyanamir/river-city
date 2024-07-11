<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Accepted</title>
    <style>
        .container {
            background-color: #f0f0f0;
            border-radius: 10px;
            margin: 0 auto;
        }

        i {
            font-size: small;
        }

        @media (max-width: 1016px) {
            .footerImage {
                height: 50px !important;
            }
        }

        .card-header {
            background-color: #930027;
            padding: 10px 0px 5px 0px;
            border-radius: 10px;
            text-align: center;
        }

        .align-bottom {
            vertical-align: bottom;
        }

        .bg-white {
            background-color: white;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .text-left {
            text-align: left;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .shadow-xl {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .transform {
            transform: translateZ(0);
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .my-8 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .align-middle {
            vertical-align: middle;
        }

        .max-w-lg {
            max-width: 32rem;
        }

        .w-full {
            width: 100%;
        }

        .max-w-screen-md {
            max-width: 48rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .pt-5 {
            padding-top: 1.25rem;
        }

        .pb-4 {
            padding-bottom: 1rem;
        }

        .sm\:p-6 {
            padding: 1.5rem;
        }

        .sm\:pb-4 {
            padding-bottom: 1rem;
        }

        .text-white {
            color: white;
        }

        .col-span-10 {
            grid-column: span 10 / span 10;
        }

        .pl-2 {
            padding-left: 0.5rem;
        }

        .grid {
            display: grid;
        }

        .sm\:grid-cols-10 {
            grid-template-columns: repeat(10, 1fr);
        }

        .col-span-8 {
            grid-column: span 8 / span 8;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .text-[#F5222D] {
            color: #F5222D;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-[#323C47] {
            color: #323C47;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .col-span-2 {
            grid-column: span 2 / span 2;
        }

        .text-right {
            text-align: right;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .flex {
            display: flex;
        }

        .justify-evenly {
            justify-content: space-evenly;
        }

        .gap-3 {
            gap: 0.75rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .text-red-900 {
            color: #7f1d1d;
        }

        .text-blue-900 {
            color: #1e3a8a;
        }

        .text-green-900 {
            color: #065f46;
        }

        .w-full {
            width: 100%;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-left {
            text-align: left;
        }

        .rtl\:text-right {
            text-align: right;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-gray-700 {
            color: #374151;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .bg-white {
            background-color: white;
        }

        .border-b {
            border-bottom: 1px solid #e5e7eb;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-900 {
            color: #111827;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-header">
            <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="company image">
        </div>
        <div align="center">
            <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all my-8 align-middle w-full max-w-screen-md">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-5 bg-white text-white">
                        <div class="col-span-10 pl-2">
                            <div class="grid sm:grid-cols-10">
                                <div class="col-span-8 p-3">
                                    <p id="invoiceCustomerName" style=" color:#930027; font-size:larger;" class="font-bold">
                                        {{$estimate->customer_name}} {{$estimate->customer_last_name}}
                                    </p>
                                    <p id="invoiceProjectName" style=" color:black; font-size:large;">
                                        {{$estimate->project_name}}
                                    </p>
                                </div>
                                <div class="col-span-2 p-3 text-right">
                                    <p style=" color:black;" class="font-bold">
                                        Estimate
                                    </p>
                                    <p id="invoiceEstimateDate" style=" color:black;">
                                        {{$estimate->created_at}}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-evenly gap-3">
                                <p id="invoiceTotal" class=" text-red-900">
                                    Total: ${{$estimate->estimate_total}}
                                </p>
                                <p id="invoiceInvoiced" class="flex justify-end text-blue-900">
                                    Invoiced: ${{$estimate->invoiced_payment}}
                                </p>
                                <p id="invoicePaid" class="flex justify-end text-green-900">
                                    Paid: ${{$estimate->invoice_paid_total}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
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
                                </tr>
                            </thead>
                            <tbody id="invoiceTableBody">
                                @foreach($estimate->invoices as $invoice)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$invoice->complete_invoice_date}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$invoice->invoice_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$invoice->tax_rate ? $invoice->tax_rate : 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$invoice->invoice_total}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$invoice->invoice_due}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$invoice->invoice_status}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- <div style=" margin-top: 8px; text-align: center;">
            <a href="https://thewebconcept.com/" style="color: #930027;">
                <span style="font-size: smaller; color:#930027; margin:auto;">Powered by : The Web Concept™.
                </span>
            </a>
        </div> -->
    </div>
</body>

</html>