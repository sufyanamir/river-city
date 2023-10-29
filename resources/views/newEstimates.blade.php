@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full max-h-[809px] rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-12 p-4">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] font-medium">
                    Project
                </p>
                <img class="h-[50px] w-[50px]" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
            </div>
            <div class="col-span-10  pl-2 ">
                <div class="grid grid-cols-10">
                    <div class="col-span-7 p-3">
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
                        <hr class="bg-gray-300 my-3 h-[2px]">
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/page-icon.svg') }}" alt="">
                            <span class="pl-2">Estimate Pending Schedule
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                            <span class="pl-2 flex">Tom D Assigned To Schedule Estimate On   <span class="pl-2 text-[#31A613] flex">
                                <img class="pr-1" src="{{asset('assets/icons/green-calendar.svg')}}" alt="">
                                April 24th, 2019</span>
                            </span>
                        </p>
                    </div>
                    <div class=" col-span-3 p-3 text-right">
                        <p class="text-2xl font-bold">
                            Estimate
                        </p>
                        <p class="mt-[2px] ">
                            1904-2413-2841
                        </p>
                        <p class="">
                            2023-10-14
                        </p>
                        <p class="mt-1 ">
                            $8,206.75
                        </p>
                        <p class="flex justify-end  ">
                            <img class="pr-1" src="{{asset('assets/icons/clipboard-icon.svg')}}" alt="">
                            0.00
                        </p>
                        <p class="flex justify-end">
                            <img class="pr-1" src="{{asset('assets/icons/card-icon.svg')}}" alt="">
                            0.00
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Contacts
                </p>
                    <img class="h-[50px] w-[50px]" src="{{asset('assets/icons/pluss-icon.svg')}}" alt="">
            </div>
            <div class="col-span-10 pl-2 py-3" >
                <p class="text-[17px]/[19.92px] py-3 my-auto  pl-9 text-[#707683] font-medium">
                    Add Contacts to keep track of your project's stakeholders
                </p>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Actions
                </p>
            </div>
            <div class="col-span-10 pl-2 py-3" >
                <div class="my-auto flex p-3 pl-0">
                    <img class="h-[40px] w-[190px] pl-3" src="{{asset('assets/images/estimateDemoImages/btn1.svg')}}" alt="">
                    <img class="h-[40px] w-[190px] pl-3" src="{{asset('assets/images/estimateDemoImages/btn2.svg')}}" alt="">
                    <img class="h-[40px] w-[190px] pl-3" src="{{asset('assets/images/estimateDemoImages/btn3.svg')}}" alt="">
                    <img class="h-[40px] w-[190px] pl-3" src="{{asset('assets/images/estimateDemoImages/btn4.svg')}}" alt="">
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
    </div>
</div>

@include('layouts.footer')
