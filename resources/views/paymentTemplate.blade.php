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
        </div>
    </div>
</div>
@include('layouts.footer')
