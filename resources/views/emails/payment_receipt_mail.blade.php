<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Accepted</title>
</head>

<body style="background-color: #f0f0f0;">
    <div style="background-color: #f0f0f0; border-radius: 10px; margin: 0 auto;">
        <div style="background-color: #930027; padding: 10px 0px 5px 0px; border-radius: 10px; text-align: center;">
            <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="company image">
        </div>
        <div align="center">
            <div style="display: inline-block; background-color: white; border-radius: 0.5rem; text-align: left; overflow: hidden; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); transform: translateZ(0); transition: all 0.3s ease-in-out; margin-top: 2rem; margin-bottom: 2rem; vertical-align: middle; width: 100%; max-width: 48rem;">
                <div style="background-color: white; padding-left: 1rem; padding-right: 1rem; padding-top: 1.25rem; padding-bottom: 1rem; padding: 1.5rem; padding-bottom: 1rem;">
                    <div style="margin-bottom: 1rem; background-color: white; color: white;">
                        <div style="grid-column: span 10 / span 10; padding-left: 0.5rem;">
                            <div style="display: grid; grid-template-columns: (repeat10, 1fr);">
                                <div style="grid-column: span 8 / span 8; padding: 0.75rem;">
                                    <p id="invoiceCustomerName" style="color: #930027; font-size: larger; font-weight: bold;">
                                        {{$estimate->customer_name}} {{$estimate->customer_last_name}}
                                    </p>
                                    <p id="invoiceProjectName" style="color: black; font-size: large;">
                                        {{$estimate->project_name}}
                                    </p>
                                    <p style="color: black; font-weight: bold;">
                                        Estimate
                                    </p>
                                    <p id="invoiceEstimateDate" style="color: black;">
                                        {{$estimate->created_at}}
                                    </p>
                                    <p id="invoiceTotal" style="color: #7f1d1d;">
                                        Total: ${{$estimate->estimate_total}}
                                    </p>
                                    <p id="invoiceInvoiced" style="color: #1e3a8a;">
                                        Invoiced: ${{$estimate->invoiced_payment}}
                                    </p>
                                    <p id="invoicePaid" style="color: #065f46;">
                                        Paid: ${{$estimate->invoice_paid_total}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
    <table style="width: 100%; font-size: 0.875rem; text-align: left; color: #6b7280;">
        <thead style="font-size: 0.75rem; color: #374151; text-transform: uppercase; background-color: #f9fafb;">
            <tr>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Date
                </th>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Name
                </th>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Tax
                </th>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Total
                </th>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Due
                </th>
                <th scope="col" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    Status
                </th>
            </tr>
        </thead>
        <tbody id="invoiceTableBody">
            @foreach($estimate->invoices as $invoice)
            <tr style="background-color: white; border-bottom: 1px solid #e5e7eb;">
                <th scope="row" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem; font-weight: 500; color: #111827; white-space: nowrap;">
                    {{$invoice->complete_invoice_date}}
                </th>
                <td style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    {{$invoice->invoice_name}}
                </td>
                <td style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    {{$invoice->tax_rate ? $invoice->tax_rate : 'N/A'}}
                </td>
                <td style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    {{$invoice->invoice_total}}
                </td>
                <td style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    {{$invoice->invoice_due}}
                </td>
                <td style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    {{$invoice->invoice_status}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    @media (max-width: 600px) {
        table thead {
            display: none;
        }
        table, table tbody, table tr, table td {
            display: block;
            width: 100%;
        }
        table tr {
            margin-bottom: 1rem;
        }
        table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 1.5rem;
            font-weight: bold;
            text-align: left;
        }
    }
</style>

                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</body>

</html>