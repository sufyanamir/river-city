@include('layouts.header')
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
                        2201-2009-1174 <br>
                        2023-10-04
                    </p>
                </div>
                <div class="mt-12">
                    <p class="text-end mt-2 font-medium text-[17px]/[19.92px] text-[#858585]"> Jason B <br>
                        225 Merrimac ST <br>
                        Newburyport MA 01950
                    </p>
                    <p class="text-end mt-8 font-medium text-[17px]/[19.92px] text-[#858585]"> Jason B <br>
                        Support@rivercitypainting.com <br>
                        555-555-5555
                    </p>
                    <p class=" text-end mt-2 font-bold text-[17px]/[19.92px] text-[#323C47] location">
                        INT-Bedroom <br>
                        Job Location: 225 Merrimac St, Newburyport, MA, 01950
                    </p>
                </div>

            </div>
            <div class="col-span-12 p-4">
                <div class="heading bg-[#930027] ">
                    <p class="text-white  py-2 px-4">
                        <span class="text-[22px]/[25.78px]  font-bold">
                            Interior Painting
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
                    <p class="flex justify-between pt-1">
                        <span>
                            Bedroom
                        </span>
                        <span>
                            $254.63
                        </span>
                    </p>
                    <p class="flex justify-between pt-1">
                        <span>
                            Paint 2 coats, walls, ceiling, trims, 2 doors and windows
                        </span>
                        <span>
                            $894.63
                        </span>
                    </p>
                    <p class=" pt-1 flex justify-between">
                        <span>
                            Interior Room 12 x 12
                        </span>
                        <span>
                            $954.63
                        </span>
                    </p>

                </div>
                <div class="mt-5 font-medium">
                    <p class=" flex justify-end">
                        <span class=" pr-10 italic text-[#323C47]">
                            Sub Total
                        </span>
                        <span class="  text-[#858585]">
                            $954.63
                        </span>
                    </p>
                    <p class=" flex justify-end">
                        <span class=" pr-10 italic text-[#323C47]">
                            Tax
                        </span>
                        <span class="  text-[#858585]">
                            $654.63
                        </span>
                    </p>
                    <p class=" flex justify-end">
                        <span class=" pr-10 italic text-[#323C47]">
                            Total
                        </span>
                        <span class="  text-[#858585]">
                            $654.63
                        </span>
                    </p>
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
            <div class="col-span-12 p-4 flex justify-end mt-10">
                <x-add-button :title="'I Agree to Pay'" :class="' rounded-sm py-1 px-2'" :id="''" />
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
