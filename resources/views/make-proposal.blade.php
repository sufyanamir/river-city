@include('layouts.header')
<form action="/sendProposal" method="post" id="sendProposalForm">
    @csrf
    <div class="my-4">
        <div class="bg-white w-full overflow-auto rounded-lg shadow-lg">
            <div class="grid grid-cols-12 p-5">
                <div class="col-span-6 p-4 ">
                    <div class="projectLogo ">
                        <img class="w-[288px] h-[73px]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                    </div>
                    <div class="mt-12 p-4">
                        <p class="text-[22px]/[25.78px] font-bold text-[#323C47]">River City Painting Pro Demo</p>
                        <p class=" mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            222 Merrimac ST <br>
                            Newburyport, Massachusetts 01950 <br>
                            Support@rivercitypainting.com <br>
                            978-379-7979
                        </p>
                    </div>
                </div>
                <div class="col-span-6 p-4">
                    <div class="">
                        <p class=" text-end text-[30px]/[35.16px] font-bold text-[#323C47]">Estimate</p>
                        <p class=" text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_project_number }} <br>
                            {{ $estimate->created_at }}
                        </p>
                    </div>
                    <div class="mt-12">
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_primary_address }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_city }} {{ $customer->customer_state }}
                            {{ $customer->customer_zip_code }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_email }}
                        </p>
                        <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_phone }}
                        </p>
                        <br>
                        <p class="text-end mt-8 font-medium text-[17px]/[19.92px] text-[#858585]">
                            {{ $customer->customer_project_name }}
                        </p>
                        <p class=" text-end mt-2 font-bold text-[17px]/[19.92px] text-[#323C47] location">
                            {{ $customer->customer_primary_address }}, {{ $customer->customer_city }},
                            {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}
                        </p>
                    </div>
                </div>
                <div class="col-span-12 p-4">
                    <div class="heading bg-[#930027] ">
                        <p class="text-white  py-2 px-4">
                            <span class="text-[22px]/[25.78px]  font-bold">
                                {{ $customer->customer_project_name }}
                            </span> <br>
                        </p>
                        <p class="py-2 px-4 text-white italic flex justify-between ">
                            <span class="">
                                Description
                            </span>
                            <span>
                                Total
                            </span>
                        </p>
                    </div>
                    <div class="text-[#323C47] font-medium mt-4 border-b border-[#323C47] pb-6 border-solid">
                        @php
                            $subTotal = 0;
                        @endphp

                        @foreach ($items as $item)
                            <p class="flex justify-between pt-1 gap-4">
                                <span class="py-2">
                                    <strong>{{ $item->item_name }}</strong>
                                    <br>
                                    <span class=" text-xs">
                                        {{ $item->item_description }}
                                    </span>
                                </span>
                                <span class="item-price">
                                    ${{ $item->item_total }}
                                </span>
                            </p>
                            <hr>
                            @php
                                $subTotal += $item->item_total;
                            @endphp
                        @endforeach
                    </div>

                    <div class="mt-5 font-medium">
                        <div class="flex justify-end gap-6">
                            <div>
                                <p class="italic text-[#323C47]">
                                    Sub Total
                                </p>
                                <p class="italic text-[#323C47]">
                                    Tax
                                </p>
                                <p class="italic text-[#323C47]">
                                    Total
                                </p>
                            </div>
                            <div>
                                <p class="text-[#858585]">
                                    ${{ number_format($subTotal, 2) }}
                                </p>
                                <p class="text-[#858585]">
                                    {{ number_format($customer->tax_rate, 2) }}%
                                </p>
                                <p class="text-[#858585]">
                                    ${{ number_format($subTotal + ($subTotal * $customer->tax_rate) / 100, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-span-12 p-4">
                <div class=" mt-5">
                    <p class="text-[25px]/[29.23px] font-bold text-[#323C47]">
                        Acceptance
                    </p>
                    <p class="text-[#858585] pt-2">
                        I acknowledge that I have read, understand and agree to what is included in the work described
                        in this
                        document and I agree to the price noted above and the terms and the contract conditions included
                        below.
                    </p>
                    <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                        Compensation
                    </p>
                    <p class="text-[#858585] pt-2">
                        Client shall pay as set forth in this document. Price is subject to change, with customer’s
                        approval
                    </p>
                    <p class="text-[25px]/[29.23px] mt-4 font-bold text-[#323C47]">
                        Invocing & Payment
                    </p>
                    <p class="text-[#858585] pt-2">
                        Invoice will be issued to Client upon Completion of the work client shall pay
                        invoice within 10 days of client’s receipt of the invoice. Client shall also pay a late charge
                        of 1-1/2% per month
                        on all balances unpaid 30 days after the invoice date.
                    </p>
                </div>

            </div>
            <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
            <input type="hidden" name="customer_email" value="{{ $customer->customer_email }}">
            <input type="hidden" name="estimate_total"
                value="{{ number_format($subTotal + ($subTotal * $customer->tax_rate) / 100, 2) }}">
            <div class="col-span-12 p-4 flex justify-end mt-10">
                <button class="bg-[#930027] text-white p-2 rounded-md hover:bg-red-900 " onclick="return confirmSendProposal()">Send Proposal</button>
            </div>
        </div>
    </div>
</form>
@include('layouts.footer')
@php
    $exsistingProposals = $existing_proposals;
@endphp
<script>
    function confirmSendProposal() {
        var existingProposals = @json($exsistingProposals); // Assuming you pass this variable from your controller

        if (existingProposals.length > 0) {
            var userResponse = confirm("If you make this proposal, all the previous proposals of this estimate will be deleted! Do you want to proceed?");

            if (userResponse) {
                return true; // Proceed with form submission
                $('#sendProposalForm').submit();
            } else {
                return false; // Cancel form submission
            }
        }

        return true; // No existing proposals, proceed with form submission
    }
</script>