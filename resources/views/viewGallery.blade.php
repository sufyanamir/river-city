@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full max-h-[809px] overflow-auto rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-11 p-4">
            <div class="col-span-1  flex justify-end p-3 pr-0">
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                        alt="">
                </button>
            </div>
            <div class="col-span-10  pl-3 ">
                <p class="text-[#F5222D] text-[25px]/[29.3px] font-bold">
                    Coyne Development Corp - Steve Coyne
                </p>
                <p class="text-[#323C47] text-[20px]/[23.44px] font-semibold">
                    Webinar - Painting
                </p>
                <p class="mt-4 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                    <span class="pl-2">65 Water St, Newburyport, MA, 01950</span>
                </p>
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/mail-icon.svg') }}" alt="">
                    <span class="pl-2">tom.droste-sc@gmail.com
                    </span>
                </p>
                <p class="mt-1 flex text-[#323C47]font-medium">
                    <img src="{{ asset('assets/icons/tel-icon.svg') }}" alt="">
                    <span class="pl-2">949-300-9632
                    </span>
                </p>
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                    <span class="pl-2">Project Owner: Tom D
                    </span>
                </p>
            </div>
        </div>
        <hr class="bg-gray-300 my-3 h-[2px] w-full">
        <div class=" grid sm:grid-cols-11 pb-4 px-4">
            <div class="col-span-1"></div>
            <div class="col-span-10 px-3  flex justify-between">
                <p class="text-[22px]/[25.78px] font-medium">Images</p>
                <x-add-button :title="'Add Image'" :class="'px-4'" :id="''" />
           </div>
        </div>
        <hr class="bg-gray-300 h-[2px] w-full">
        .grid

    </div>
</div>
@include('layouts.footer')
