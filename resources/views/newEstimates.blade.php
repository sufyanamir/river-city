@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full max-h-[809px] rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-12 p-4">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] font-medium">
                    Project
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                        alt="">
                </button>
            </div>
            <div class="col-span-10  pl-2 ">
                <div class="grid grid-cols-10">
                    <div class="col-span-8 p-3">
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
                        <hr class="bg-gray-300 my-3 h-[2px] w-full">
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/page-icon.svg') }}" alt="">
                            <span class="pl-2">Estimate Pending Schedule
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                            <span class="pl-2 flex">Tom D Assigned To Schedule Estimate On <span
                                    class="pl-2 text-[#31A613] flex">
                                    <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}"
                                        alt="">
                                    April 24th, 2019</span>
                            </span>
                        </p>
                    </div>
                    <div class=" col-span-2 p-3 text-right">
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
                            <img class="pr-1" src="{{ asset('assets/icons/clipboard-icon.svg') }}" alt="">
                            0.00
                        </p>
                        <p class="flex justify-end">
                            <img class="pr-1" src="{{ asset('assets/icons/card-icon.svg') }}" alt="">
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
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10 pl-2 py-3">
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
            <div class="col-span-10 pl-2 py-3">
                <div class="my-auto flex p-3 pl-0">
                    <a href="" class="pl-3">
                        <button type="button"
                            class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/calendar-icon.svg') }}"
                                alt="">Schedule Estimate
                        </button>
                    </a>
                    <button type="button" 
                            class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/check-icon.svg') }}"
                                alt="">Complete Estimate
                        </button>
                    <button type="button" 
                            class=" flex h-[40px] w-[190px] ml-2 px-auto px-8 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/userRole-icon.svg') }}"
                                alt="">Reassign
                        </button>
                        <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]"" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/settings-icon.svg') }}"
                                alt="">
                            More
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Document
                </p>
                
            </div>
            <div class="col-span-10 pl-2 py-3">
                <div class="my-auto flex p-3 pl-0">
                    <a href="" class="pl-3">
                        <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                            <svg class="m-1" width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.4C0 0.626801 0.619911 0 1.38462 0H8.9604L12 3.07336V12.6C12 13.3732 11.3801 14 10.6154 14H1.38462C0.619911 14 0 13.3732 0 12.6V1.4ZM2.76923 3.73333H5.53846V4.66667H2.76923V3.73333ZM9.23077 6.53333H2.76923V7.46667H9.23077V6.53333ZM9.23077 9.33333H6.46154V10.2667H9.23077V9.33333Z" fill="white"/>
                                </svg>
                                Preview
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                    <button type="button" 
                            class=" flex h-[40px] w-[190px] ml-2 px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/emailTemplate-icon.svg') }}"
                                alt="">Email
                        </button>
                    <button type="button" 
                            class=" flex h-[40px] w-[190px] ml-2 px-auto px-5 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                            <svg class="h-[14px] w-[14px] m-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3.5" y="3.5" width="7" height="7" fill="white"/>
                                <rect x="0.5" y="0.5" width="13" height="13" stroke="white"/>
                                </svg>
                                Stop Campaign
                        </button>
                        
                    
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid grid-cols-12 p-4 py-0">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] font-medium">
                    Profitablity
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                        alt="">
                </button>
            </div>
            <div class="col-span-10 pl-2 py-3 grid grid-cols-10">
                <p class="col-span-2 font-semibold text-xl pl-2 pt-5">
                    Estimated
                </p>
                <table class="col-span-8 ">
                    <thead>
                        <tr>
                            <th>Hours</th>
                            <th>Cost</th>
                            <th>Profit</th>
                            <th>Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>120.66</td>
                            <td>$250.55</td>
                            <td>$25.565</td>
                            <td>40.41%</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
