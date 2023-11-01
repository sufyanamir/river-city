@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full max-h-[809px] overflow-auto rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-12 p-4">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] font-medium">
                    Project
                </p>
                <a href="/editQoutation">
                    <button type="button" class="flex" id="qoutation">
                        <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                    </button>
                </a>
            </div>
            <div class="col-span-10  pl-2 ">
                <div class="grid sm:grid-cols-10">
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
                            <span class="pl-2 flex">Tom D Assigned To Schedule Estimate On <span class="pl-2 text-[#31A613] flex">
                                    <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}" alt="">
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
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Contacts
                </p>
                <button type="button" class="flex" id="addContact">
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
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Actions
                </p>
            </div>
            <div class="col-span-10 pl-2 py-3">
                <div class="my-auto flex p-3 pl-0">
                    <a href="" class="pl-3">
                        <button type="button" class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">Schedule Estimate
                        </button>
                    </a>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                        <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">Complete Estimate
                    </button>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-8 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                        <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/userRole-icon.svg') }}" alt="">Reassign
                    </button>
                    <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]"" id=" action-menubutton" aria-expanded="true" aria-haspopup="true">
                        <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/settings-icon.svg') }}" alt="">
                        More
                        <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
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
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.4C0 0.626801 0.619911 0 1.38462 0H8.9604L12 3.07336V12.6C12 13.3732 11.3801 14 10.6154 14H1.38462C0.619911 14 0 13.3732 0 12.6V1.4ZM2.76923 3.73333H5.53846V4.66667H2.76923V3.73333ZM9.23077 6.53333H2.76923V7.46667H9.23077V6.53333ZM9.23077 9.33333H6.46154V10.2667H9.23077V9.33333Z" fill="white" />
                            </svg>
                            Preview
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]">
                        <img class="h-[14px] w-[14px] m-1" src="{{ asset('assets/icons/emailTemplate-icon.svg') }}" alt="">Email
                    </button>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-5 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                        <svg class="h-[14px] w-[14px] m-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3.5" y="3.5" width="7" height="7" fill="white" />
                            <rect x="0.5" y="0.5" width="13" height="13" stroke="white" />
                        </svg>
                        Stop Campaign
                    </button>


                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] font-medium">
                    Profitability
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10 pl-2 py-3 ">
                <table class=" w-auto  ">
                    <thead>
                        <tr class="border border-solid border-l-0 border-r-0 border-t-0">
                            <th></th>
                            <th class=" pl-36  px-5">Hours</th>
                            <th class="px-10">Cost</th>
                            <th class="px-10">Profit</th>
                            <th class="px-10">Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-semibold text-xl pr-44">Estimated</td>
                            <td class="pl-36 px-5">120.66</td>
                            <td class="px-10">$250.55</td>
                            <td class="px-10">$25.565</td>
                            <td class="px-10">40.41%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Items
                </p>
                <button type="button" class="flex addItems">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10 relative  ml-2 h-[445px] overflow-auto bg-gray-300 rounded-lg border-[#0000004D] my-2 py-3">
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0  justify-between items-center mb-4">
                    <div class=" flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div class="">
                            <label class="text-[20px]/[23.44px] font-semibold text-[#323C47]" for="groupName">Item name</label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">Description about item </p>
                        </div>
                    </div>
                    <div class="text-right ">
                        <span>$0.00</span>
                    </div>
                </div>
                <div class="flex border-b border-[#0000001A] w-full pl-0 px-4 justify-between items-center mb-4">
                    <div class=" flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div class="">
                            <label class="text-[20px]/[23.44px] font-semibold text-[#323C47]" for="groupName">Group name</label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">living room items</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span>$0.00</span>
                    </div>
                </div>
                <div class="border-t absolute bottom-2  mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                    <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Total</span>
                    <span>$0.00</span>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Labor
                </p>
                <button type="button" class="flex addItems">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  pl-2  py-3">
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0  justify-between items-center mb-4">
                    <div class=" flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div class="">
                            <label class="text-[20px]/[23.44px] font-semibold text-[#323C47]" for="groupName">Service name</label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">Description about service </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span>$0.00</span>
                    </div>
                </div>
                <div class="  w-full pl-0 px-4  items-center pb-4">
                    <div class="text-right">
                        <span>$0.00</span>
                    </div>
                </div>

            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Materials
                </p>
                <button type="button" class="flex addItems">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  pl-2  py-3">
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0  justify-between items-center mb-4">
                    <div class=" flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div class="">
                            <label class="text-[20px]/[23.44px] font-semibold text-[#323C47]" for="groupName">Material name</label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">Description about material </p>
                        </div>
                    </div>
                    <div class="text-right ">
                        <span>$0.00</span>
                    </div>
                </div>
                <div class="flex border-b border-[#0000001A] w-full pl-0 px-4 justify-between items-center mb-4">
                    <div class=" flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div class="">
                            <label class="text-[20px]/[23.44px] font-semibold text-[#323C47]" for="groupName">Material Group </label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">living room items</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span>$0.00</span>
                    </div>
                </div>
                <div class=" pt-4 px-4 pl-2 flex justify-end">
                    <span>$0.00</span>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Files
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  pl-2  py-3 hidden" id="image-field">
                <div class="w-56 h-56">
                    <x-drop-zone :value="''" :name="'upload_image'"></x-drop-zone>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 mt-0 h-[2px]">
        <div class="grid sm:grid-cols-12 p-4 py-0">
            <div class="col-span-2 flex justify-between p-3 pr-0">
                <p class="text-[20px]/[23.44px] py-3  font-medium">
                    Proposals
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  pl-2  py-3">
                <div class="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addContact-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="addContact-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Contacts</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" my-2 col-span-2" id="multiAdd-items">
                            <label for="" class=" inline-block">Phone no.</label>
                            <input type="tel" name="contacts" id="contacts" placeholder="Phone Number" autocomplete="given-name" class=" w-[76%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <button type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                            </button>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id="updateEvent" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addItems-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <form action="" id="addItems-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <div class=" " id="">
                            <x-add-button :id="''" :title="'All'" :class="' bg-[#E02B20] px-6'"></x-add-button>
                            <x-add-button :id="''" :title="'Product'" :class="''"></x-add-button>
                            <x-add-button :id="''" :title="'Labour'" :class="''"></x-add-button>
                            <x-add-button :id="''" :title="'Assemblies'" :class="''"></x-add-button>
                            <x-add-button :id="''" :title="'Groups'" :class="''"></x-add-button>
                        </div>
                        <button class="addItemsModal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <div class=" my-2">
                        <input type="text" name="search" id="search" placeholder="Search" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <!-- task details -->

                    <div class="relative overflow-x-auto h-60 overflow-y-auto my-2">
                        <table class="w-full text-sm text-left ">
                            <thead class="text-xs text-white uppercase bg-[#930027]">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item name
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Units
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cost
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Item Name
                                    </th>
                                    <td class="px-6 py-4">
                                        Product
                                    </td>
                                    <td class="px-6 py-4">
                                        gal
                                    </td>
                                    <td class="px-6 py-4">
                                        $10
                                    </td>
                                    <td class="px-6 py-4">
                                        $15
                                    </td>
                                    <td>
                                        <x-add-button :id="''" :title="'Choose'" :class="''"></x-add-button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Item Name
                                    </th>
                                    <td class="px-6 py-4">
                                        Product
                                    </td>
                                    <td class="px-6 py-4">
                                        gal
                                    </td>
                                    <td class="px-6 py-4">
                                        $10
                                    </td>
                                    <td class="px-6 py-4">
                                        $15
                                    </td>
                                    <td>
                                        <x-add-button :id="''" :title="'Choose'" :class="''"></x-add-button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Item Name
                                    </th>
                                    <td class="px-6 py-4">
                                        Product
                                    </td>
                                    <td class="px-6 py-4">
                                        gal
                                    </td>
                                    <td class="px-6 py-4">
                                        $10
                                    </td>
                                    <td class="px-6 py-4">
                                        $15
                                    </td>
                                    <td>
                                        <x-add-button :id="''" :title="'Choose'" :class="''"></x-add-button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Item Name
                                    </th>
                                    <td class="px-6 py-4">
                                        Product
                                    </td>
                                    <td class="px-6 py-4">
                                        gal
                                    </td>
                                    <td class="px-6 py-4">
                                        $10
                                    </td>
                                    <td class="px-6 py-4">
                                        $15
                                    </td>
                                    <td>
                                        <x-add-button :id="''" :title="'Choose'" :class="''"></x-add-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class=" flex justify-between pt-2 border-t">
                        <button id="updateEvent" class=" mb-2 py-1 px-7 rounded-md border ">Cancel
                        </button>
                        <button id="updateEvent" class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addImage-btn").click(function(e) {
        e.preventDefault();
        $("#image-field").toggleClass('hidden');
    });
</script>
<script>
    $("#addContact").click(function(e) {
        e.preventDefault();
        $("#addContact-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addContact-modal").addClass('hidden');
        $("#addContact-form")[0].reset()
    });
</script>
<script>
    $(".addItems").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").removeClass('hidden');
    });

    $(".addItemsModal-close").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").addClass('hidden');
        $("#addItems-form")[0].reset()
    });
</script>