<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
<script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
@vite('resources/css/app.css')
<link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
<div class="my-4" id="printableArea">
    <div class="bg-white w-full overflow-auto rounded-lg shadow-lg">
        <div class="p-4 flex gap-4 justify-end">
            <div>
                <button id="download" class="px-4 py-2 bg-[#930027] text-white rounded-lg">Download</button>
            </div>
            @if(session()->has('user_details'))
            @if(isset($invoice) && $invoice != null)
            <form action="/sendInvoiceMail" method="post">
                @csrf
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="invoice_id" value="{{ $invoice->estimate_invoice_id }}">
                <button id="sendEmail-btn" class="px-4 py-2 bg-[#930027] text-white rounded-lg">Send Email</button>
            </form>
            @elseif(isset($payment) && $payment != null)
            <form action="/sendPaymentMail" method="post">
                @csrf
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="payment_id" value="{{ $payment->estimate_payment_id }}">
                <button id="sendEmail-btn" class="px-4 py-2 bg-[#930027] text-white rounded-lg">Send Email</button>
            </form>
            @endif
            @endif
        </div>
        <div class="grid grid-cols-12 p-5">
            <div class="col-span-6 px-4 ">
                <div class="projectLogo ">
                    <img class="w-[35%] h-[35%]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                </div>
                <div class=" px-4">
                    <p class="text-[16px] font-bold text-[#323C47]">River City Painting, Inc</p>
                    <p class=" mt-2 font-medium text-[12px] text-[#858585]">
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
            <div class="col-span-6 px-4">
                <div class="">
                    <p class=" text-end text-[16px] font-bold text-[#323C47]">Estimate</p>
                    <p class=" text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_project_number }} <br>
                        {{ $estimate->created_at }}
                    </p>
                </div>
                <div class="">
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ ucfirst($estimate->customer->customer_first_name) }} {{ ucfirst($estimate->customer->customer_last_name) }}
                    </p>
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_primary_address }}
                    </p>
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_city }} {{ $estimate->customer->customer_state }}
                        {{ $estimate->customer->customer_zip_code }}
                    </p>
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_email }}
                    </p>
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_phone }}
                    </p>
                    <br>
                    <p class="text-end font-medium text-[12px] text-[#858585]">
                        {{ $estimate->customer->customer_project_name }}
                    </p>
                </div>
            </div>
            <div class=" col-span-12 mx-auto">
                <div class=" flex gap-6">
                    <div>
                        <img src="{{asset('assets/images/PCA-Logo-RGB .png')}}" class=" w-[60%] h-[70%]" alt="image">
                    </div>
                    <div>
                        <img src="{{asset('assets/images/RCP Badges-02.png')}}" class=" w-[60%] h-[70%]" alt="image">
                    </div>
                    <div>
                        <img src="{{asset('assets/images/Lead-Safe-EPA-Certified-Firm .png')}}" class=" w-[60%] h-[70%]" alt="image">
                    </div>
                    <div>
                        <img src="{{asset('assets/images/RCP-Badges-01.png')}}" class=" w-[60%] h-[70%]" alt="image">
                    </div>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto mb-3">
            <div class="itemDiv">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 border-b border-black uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="text-left px-6 py-3">Description</th>
                            <th scope="col" class="text-right px-6 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($payment) && $payment != null)
                        <tr class="border-b border-black">
                            <td class=" px-6 py-3"><strong>{{ $payment->invoice->invoice_name }}</strong> <br> {{$payment->note}}</td>
                            <td class=" text-right px-6 py-3">${{ number_format($payment->invoice_total, 2)}}</td>
                        </tr>
                        @elseif(isset($invoice) && $invoice != null)
                        <tr class="border-b border-black">
                            <td class=" px-6 py-3"><strong>{{ $invoice->invoice_name }}</strong> <br> {{$invoice->note}}</td>
                            <td class=" text-right px-6 py-3">${{ number_format($invoice->invoice_total, 2)}}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3"> {{$estimate->estimate_internal_note}} </td>
                            <td class="px-6 py-3 text-right flex justify-end gap-5">
                                <p>Total: <br> Paid: <br> Due:</p>
                                <p>${{ $invoice->invoice_total }} <br> ${{$invoice->invoice_status == "unpaid" ? 0.00 : $invoice->invoice_due}} <br> ${{$invoice->invoice_status == "paid" ? 0.00 : $invoice->invoice_due}}</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($invoice) && $invoice != null)
        <div class=" p-4">
            <p class="text-[12px] font-medium text-[#858585]">
                <strong class="text-bold">Due upon completion.</strong> Overdue invoices are subject to late charges. A reminder notice will be sent at 5 business days past invoice date.

                Acceptable forms of payment: Cash, Check and all major Credit Cards. A 3% processing fee will be added to all credit card transactions: Mail checks to the address at the top of this invoice.

                <strong>Invoicing & Payment. ** River City Painting Inc. shall invoice Client upon completion of the Work. Client shall pay invoice within **5 business days of receipt of the invoice.</strong> Client shall also pay to River City Painting Inc. a late charge of 1-1/2% per month on all balances unpaid 30 days after the invoice date. If client fails to pay on time and River City Painting refers your account(s) to a third party for collection, River City Painting will charge all costs associated with the non-payment, including but not limited to, accumulated late fees, return check fees ($30.00), insufficient funds fees, collection agency fees, and court and attorney costs. River City Painting will try in every attempt to collect in house, but if all attempts are failed River City Painting will refer account to a third party collection, in this event all correspondents and/or payments must be made through the collection agency.

                <strong>Thank you for your business and please remember us for all your project needs!</strong>
            </p>
        </div>
        @endif
    </div>
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="sendEmail-modal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
            </div>

            <!-- Modal panel -->
            <form action="/sendInvoiceOrPaymentMail">
                @csrf
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal content here -->
                        <div class=" flex justify-between border-b-2">
                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Send Proposal Mail!</h2>
                            <button class="modal-close" type="button">
                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                        <!-- task details -->
                        <div class=" grid grid-cols-2 gap-4 my-2">
                            <input type="hidden" name="email_id" id="email_id">
                            <div>
                                <label for="email_title">Email title:</label>
                                <input type="text" name="email_title" id="email_title" value="Proposal Email" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div>
                                <label for="email_to">Email to:</label>
                                <input type="text" name="email_to" id="email_to" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $estimate->customer->customer_email }}">
                                <p class="text-[#930027] text-xs">Please use "," to send mail to multiple persons.</p>
                            </div>
                            <div class=" col-span-2">
                                <label for="email_subject">Email Subject:</label>
                                <textarea name="email_subject" id="email_subject" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">Proposal Mail</textarea>
                            </div>
                            <div class=" col-span-2">
                                <label for="email_body">Email body:</label>
                                <textarea name="email_body" id="email_body" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" rows="10">Hi {{ ucfirst($estimate->customer->customer_first_name)}} {{ ucfirst($estimate->customer->customer_last_name)}}!
Click on the link below to view the {{ $type }}.</textarea>
                            </div>
                        </div>
                        <div class="">
                            <button id="saveButton" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md">
                                <div class=" text-center hidden spinner" id="spinner">
                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                </div>
                                <div class="text" id="text">
                                    Send
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    $("#sendEmail-btn").click(function(e) {
        e.preventDefault();
        $("#sendEmail-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#sendEmail-modal").addClass('hidden');
        $("#formData")[0].reset()
    });
    document.getElementById('download').addEventListener('click', function() {
    // Hide the download button
    const downloadBtn = document.getElementById('download');
    const sendEmailBtn = document.getElementById('sendEmail-btn');

    if (downloadBtn) {
        downloadBtn.style.display = 'none';
    }
    if (sendEmailBtn) {
        sendEmailBtn.style.display = 'none';
    }

    var element = document.getElementById('printableArea');
    var opt = {
        margin: 0.3,
        filename: 'Download-{{ $estimate->id }}.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    };

    html2pdf().set(opt).from(element).save()
        .then(() => {
            // Show the buttons again after download
            if (downloadBtn) {
                downloadBtn.style.display = 'inline-block';
            }
            if (sendEmailBtn) {
                sendEmailBtn.style.display = 'inline-block';
            }
        });
});
</script>