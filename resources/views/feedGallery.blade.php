@include('layouts.header')
<div class="my-4">
    <h1 class=" text-2xl font-semibold mb-3">Gallery</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="m-2  just grid sm:grid-cols-12 ">
            <div class="col-span-6 flex justify-between p-4">
                <h2 class="my-auto pr-3 font-medium text-[22px]/[25.78px] text-black font-[Roboto]">Gallery list</h2>
                <x-add-button :title="'All'" :id="''" :class="'bg-[#E02B20] px-6'"></x-add-button>
                <x-add-button :title="'New'" :id="''" :class="' px-6'"></x-add-button>
                <x-add-button :title="'Pending'" :id="''" :class="' px-6'"></x-add-button>
                <x-add-button :title="'Complete'" :id="''" :class="' px-6'"></x-add-button>
            </div>
            <div class="col-span-6 flex justify-end">.
                <div class="my-auto">
                    <img class=" m-2" src="{{asset('assets/images/searchbox.svg')}}" alt="">
                </div>
            </div>
        </div>
        <hr class="bg-gray-900">
        <div class=" grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Estimate Name</h3>
                    <p class=" font-medium text-[17px]/[25px] text-[#858585]">
                        Customer Name / 949-300-9632
                        65 Water St, Newburyport, MA, 01950
                    </p>
                </div>
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Images</h3>
                    <p class="font-medium text-[17px]/[25px] text-[#858585]">12</p>
                </div>
            </div>
            <div class="col-span-1 p-3  ">
                <div class="h-full mx-auto rounded bg-[#D9D9D9]   w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 mx-2 my-auto"> 
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
            </div>
        </div>
        <div class=" grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Estimate Name</h3>
                    <p class=" font-medium text-[17px]/[25px] text-[#858585]">
                        Customer Name / 949-300-9632
                        65 Water St, Newburyport, MA, 01950
                    </p>
                </div>
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Images</h3>
                    <p class="font-medium text-[17px]/[25px] text-[#858585]">4</p>
                </div>
            </div>
            <div class="col-span-1 p-3  ">
                <div class="h-full mx-auto rounded bg-[#D9D9D9]   w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 mx-2 my-auto">
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
            </div>
        </div>
        <div class=" grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Estimate Name</h3>
                    <p class=" font-medium text-[17px]/[25px] text-[#858585]">
                        Customer Name / 949-300-9632
                        65 Water St, Newburyport, MA, 01950
                    </p>
                </div>
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Images</h3>
                    <p class="font-medium text-[17px]/[25px] text-[#858585]">5</p>
                </div>
            </div>
            <div class="col-span-1 p-3  ">
                <div class="h-full mx-auto rounded bg-[#D9D9D9]   w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 mx-2 my-auto">
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
            </div>
        </div>
        <div class=" grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Estimate Name</h3>
                    <p class=" font-medium text-[17px]/[25px] text-[#858585]">
                        Customer Name / 949-300-9632
                        65 Water St, Newburyport, MA, 01950
                    </p>
                </div>
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Images</h3>
                    <p class="font-medium text-[17px]/[25px] text-[#858585]">20</p>
                </div>
            </div>
            <div class="col-span-1 p-3  ">
                <div class="h-full mx-auto rounded bg-[#D9D9D9]   w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 mx-2 my-auto">
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
            </div>
        </div>
        <div class=" grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Estimate Name</h3>
                    <p class=" font-medium text-[17px]/[25px] text-[#858585]">
                        Customer Name / 949-300-9632
                        65 Water St, Newburyport, MA, 01950
                    </p>
                </div>
                <div class="pl-3">
                    <h3 class="text-[22px]/[25.78px] text-[#323C47] font-bold">Images</h3>
                    <p class="font-medium text-[17px]/[25px] text-[#858585]">12</p>
                </div>
            </div>
            <div class="col-span-1 p-3  ">
                <div class="h-full mx-auto rounded bg-[#D9D9D9]   w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 mx-2 my-auto">
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image2.svg')}}" alt="">
                </div>
                <div class="col-span-1">
                    <img src="{{asset('assets/images/feed-gallery-image1.svg')}}" alt="">
                </div>
            </div>
        </div>

    </div>

</div>
@include('layouts.footer')
