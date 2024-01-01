@include('layouts.header')
@php
    $userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-transparent w-full">
        <div class=" mb-5 shadow-lg bg-white text-white  rounded-3xl">
            <div class="  flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                <p class="text-lg  px-3 font-medium">
                    Project
                </p>
                <button type="button" class="flex" id="btnStartAdvanced">
                    <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                </button>
            </div>
            <div class="col-span-10  pl-2 ">
                <div class="grid sm:grid-cols-10">
                    <div class="col-span-8 p-3">
                        <p class="text-[#F5222D] text-xl font-bold">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </p>
                        <p class="text-[#323C47] text-lg font-semibold">
                            {{ $customer->customer_project_name }}
                        </p>
                        <p class="mt-2 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $customer->customer_primary_address }}</span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/mail-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $customer->customer_email }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47]  font-medium">
                            <img src="{{ asset('assets/icons/tel-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $customer->customer_phone }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Project Owner: {{ $customer->owner }}
                            </span>
                        </p>
                        <hr class="bg-gray-300 my-2 w-full">
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/page-icon.svg') }}" alt="">
                            <span class="pl-2">Estimate Pending Schedule
                            </span>
                        </p>
                        {{-- <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                            <span class="pl-2 flex">{{ $customer->owner }} Assigned To Schedule Estimate On <span
                                    class="pl-2 text-[#31A613] flex">
                                    <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}"
                                        alt="">
                                    {{ $customer->created_at }}</span>
                            </span>
                        </p> --}}
                    </div>
                    <div class=" col-span-2 p-3 text-right">
                        <p class="text-lg font-bold text-[#323C47]">
                            Estimate
                            <br>
                            <span>{{ $estimate->project_name }}</span>
                        </p>
                        <p class="mt-[2px] text-[#323C47]">
                            {{ $estimate->project_number }}
                        </p>
                        <p class="text-[#323C47]">
                            {{ $estimate->estimate_status }}
                        </p>
                        <p class="text-[#323C47]">
                            {{ $estimate->created_at }}
                        </p>
                        <p class="mt-1 text-red-900">
                            Total: ${{ $estimate->estimate_total }}
                        </p>
                        <p class="flex justify-end text-blue-900">
                            Invoiced: ${{ $estimate->invoiced_payment }}
                        </p>
                        <p class="flex justify-end text-green-900">
                            Paid: ${{ $estimate->invoice_paid_total }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        {{-- <hr class="bg-gray-300"> --}}
        @if (session('user_details')['user_role'] == 'admin')
            <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text- lg py-3 px-3  font-medium text-white">
                        Contacts
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="py-4     ">
                    <p class="text-lg py-3 my-auto  pl-9 text-[#707683] font-medium">
                        Add Contacts to keep track of your project's stakeholders
                    </p>
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($additional_contacts as $contacts)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $contacts->contact_title }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_first_name }} {{ $contacts->contact_last_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_phone }}
                                            </td>
                                            <td>
                                                <button>
                                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}"
                                                        alt="icon">
                                                </button>
                                                <button>
                                                    <form
                                                        action="/delete/additionalContact/{{ $contacts->contact_id }}"
                                                        method="post">
                                                        @csrf
                                                        <button>
                                                            <img src="{{ asset('assets/icons/del-icon.svg') }}"
                                                                alt="icon">
                                                        </button>
                                                    </form>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->contacts) &&
                $userPrivileges->estimate->contacts === 'on')
            <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text- lg py-3 px-3  font-medium text-white">
                        Contacts
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="py-4     ">
                    <p class="text-lg py-3 my-auto  pl-9 text-[#707683] font-medium">
                        Add Contacts to keep track of your project's stakeholders
                    </p>
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($additional_contacts as $contacts)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $contacts->contact_title }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_first_name }} {{ $contacts->contact_last_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $contacts->contact_phone }}
                                            </td>
                                            <td>
                                                <button>
                                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}"
                                                        alt="icon">
                                                </button>
                                                <button>
                                                    <form
                                                        action="/delete/additionalContact/{{ $contacts->contact_id }}"
                                                        method="post">
                                                        @csrf
                                                        <button>
                                                            <img src="{{ asset('assets/icons/del-icon.svg') }}"
                                                                alt="icon">
                                                        </button>
                                                    </form>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        <div class=" border-2  shadow-lg mt-7     bg-white rounded-3xl   ">
            <div class="">
                <div class=" px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg py-3 pl-3  text-white  font-medium">
                        Actions
                    </p>
                </div>
                <div class=" px-3">
                    <div class="my-auto py-4 flex p-2">
                        @if ($estimate->schedule_assigned == 1 && $estimate->work_assigned != 1)
                            <a href="/getEstimateToSetSchedule{{ $estimate->estimate_id }}">
                                <button type="button" id="schedule-estimate"
                                    class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                    <img class="h-[14px] w-[14px] my-auto mx-1"
                                        src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                                    <span class=" my-auto">Schedule Estimate</span>
                                </button>
                            </a>
                        @endif
                        @if ($estimate->work_assigned == 1 && $estimate->invoice_assigned != 1)
                            <button type="button" id="complete-work"
                                class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1"
                                    src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto">Complete Work</span>
                            </button>
                        @endif
                        @if ($estimate->invoice_assigned == 1 && $estimate->payment_assigned != 1)
                            <button type="button" id="complete-invoice"
                                class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1"
                                    src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto">Complete Invoice</span>
                            </button>
                        @endif
                        @if ($estimate->payment_assigned == 1 && $estimate->invoice_paid != 1)
                            <button type="button" id="add-payment"
                                class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <div class=" flex mx-auto">
                                    <img class="h-[14px] w-[14px] my-auto mx-1"
                                        src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                    <span class=" my-auto">Add Payment</span>
                                </div>
                            </button>
                        @endif
                        @if ($estimate->invoice_paid == 1 && $estimate->estimate_status != 'complete')
                            <form action="/completeProject" method="post">
                                @csrf
                                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                                <button id=""
                                    class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                    <div class=" flex mx-auto">
                                        <img class="h-[14px] w-[14px] my-auto mx-1"
                                            src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                        <span class=" my-auto">Complete Project</span>
                                    </div>
                                </button>
                            </form>
                        @endif
                        @if ($estimate->estimate_assigned == 1 && $estimate->schedule_assigned != 1)
                            <button type="button" id="accept-estimate"
                                class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <div class=" flex mx-auto">
                                    <img class="h-[14px] w-[14px] my-auto mx-1"
                                        src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                    <span class=" my-auto">Accept Work</span>
                                </div>
                            </button>
                            <button type="button"
                                class=" complete-estimate flex h-[40px] w-[190px] ml-2 px-auto px-8 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                                <img class="h-[14px] w-[14px] my-auto mx-1"
                                    src="{{ asset('assets/icons/userRole-icon.svg') }}" alt="">
                                <span class=" my-auto">Reassign</span>
                            </button>
                        @endif
                        @if ($estimate->estimate_assigned != 1)
                            <button type="button" id="complete-estimate"
                                class=" complete-estimate flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1"
                                    src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto">Complete Estimate</span>
                            </button>
                        @endif
                        {{-- <button type="button"
                            class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]"
                            id=" action-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img class="h-[14px] w-[14px] my-auto mx-1"
                                src="{{ asset('assets/icons/settings-icon.svg') }}" alt="">
                            <span class=" my-auto">More</span>
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button> --}}
                    </div>
                </div>
            </div>
            <hr class="bg-gray-300">
            <div class="">
                <div class="flex justify-between items-center px-3 py-2 mt-3  bg-[#930027]  ">
                    <p class="text-lg pl-4  text-white  font-medium">
                        Document
                    </p>

                </div>
                <div>
                    <div class="my-auto flex  py-4">
                        <a href="" class="pl-3">
                            <button type="button"
                                class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]"
                                id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                                <svg class=" my-auto mx-1" width="14" height="14" viewBox="0 0 12 14"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0 1.4C0 0.626801 0.619911 0 1.38462 0H8.9604L12 3.07336V12.6C12 13.3732 11.3801 14 10.6154 14H1.38462C0.619911 14 0 13.3732 0 12.6V1.4ZM2.76923 3.73333H5.53846V4.66667H2.76923V3.73333ZM9.23077 6.53333H2.76923V7.46667H9.23077V6.53333ZM9.23077 9.33333H6.46154V10.2667H9.23077V9.33333Z"
                                        fill="white" />
                                </svg>
                                <span class=" my-auto">Preview</span>
                                <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                        <button type="button"
                            class=" flex h-[40px] w-[190px] ml-2 px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]">
                            <img class="h-[14px] w-[14px]  my-auto mx-1"
                                src="{{ asset('assets/icons/emailTemplate-icon.svg') }}" alt="">
                            <span class=" my-auto">Email</span>
                        </button>
                        <button type="button"
                            class=" flex h-[40px] w-[190px] ml-2 px-auto px-5 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#E36152]">
                            <svg class="h-[14px] w-[14px]  my-auto mx-1" width="14" height="14"
                                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3.5" y="3.5" width="7" height="7" fill="white" />
                                <rect x="0.5" y="0.5" width="13" height="13" stroke="white" />
                            </svg>
                            <span class=" my-auto">Stop Campaign</span>
                        </button>


                    </div>
                </div>
            </div>
        </div>
        @if ($user_details['user_role'] == 'admin')
            <div class="  border-2  shadow-lg my-5  bg-white rounded-3xl mt-7 ">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg text-white pl-3 font-medium">
                        Profitability
                    </p>
                    <button type="button" id="profitability-btn" class="flex">
                        <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                            alt="">
                    </button>
                </div>
                <div class="p-2">
                    <div class=" relative overflow-x-auto">
                        <table class=" w-full  ">
                            <thead class=" text-center">
                                <tr class="border border-solid border-l-0 border-r-0 border-t-0">
                                    <th></th>
                                    <th class="">Hours</th>
                                    <th class="">Cost</th>
                                    <th class="">Profit</th>
                                    <th class="">Margin</th>
                                </tr>
                            </thead>
                            <tbody class=" text-center">
                                <tr>
                                    <td class="font-semibold text-xl">Estimated</td>
                                    <td class="">120.66</td>
                                    <td class="">$250.55</td>
                                    <td class="">$25.565</td>
                                    <td class="">40.41%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="  border-2  shadow-lg mt-7  bg-white rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white font-medium">
                        Items
                    </p>
                    <button type="button" class="flex addItems bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                    @php
                        $totalPrice = 0; // Initialize total price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        <div
                            class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                            <div class="flex">
                                <button type="button" class="inline">
                                    <img class="h-[50px] w-[50px]"
                                        src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                                <div>
                                    <label class="text-lg font-semibold text-[#323C47]"
                                        for="">{{ $item->item_name }}</label>
                                    <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span>${{ $item->item_price }}</span>
                                @php
                                    $totalPrice += $item->item_price; // Add item price to total
                                @endphp

                                {{-- Check if the item is of type 'assemblies' --}}
                                @if ($item->item_type === 'assemblies')
                                    {{-- Get associated items from item_assemblies table --}}
                                    @php
                                        $associatedItems = \App\Models\ItemAssembly::where('item_id', $item->item_id)->get();
                                    @endphp

                                    {{-- Display associated items for assembly item --}}
                                    @foreach ($associatedItems as $associatedItem)
                                        <div class="">
                                            {{-- Query the actual item based on assembly_name --}}
                                            @php
                                                $actualItem = \App\Models\Items::where('item_id', $associatedItem->assembly_name)->first();
                                            @endphp

                                            <label class="text-lg font-semibold text-[#323C47]"
                                                for="">{{ $actualItem->item_name }}</label>
                                            <p class="text-[16px]/[18px] text-[#323C47] font">
                                                {{ $actualItem->item_type }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Total</span>
                        <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->items) &&
                $userPrivileges->estimate->items === 'on')
            <div class="  border-2  shadow-lg mt-7  bg-white rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white font-medium">
                        Items
                    </p>
                    <button type="button" class="flex addItems bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                    @php
                        $totalPrice = 0; // Initialize total price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        <div
                            class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                            <div class="flex">
                                <button type="button" class="inline">
                                    <img class="h-[50px] w-[50px]"
                                        src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                                <div>
                                    <label class="text-lg font-semibold text-[#323C47]"
                                        for="">{{ $item->item_name }}</label>
                                    <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span>${{ $item->item_price }}</span>
                                @php
                                    $totalPrice += $item->item_price; // Add item price to total
                                @endphp

                                {{-- Check if the item is of type 'assemblies' --}}
                                @if ($item->item_type === 'assemblies')
                                    {{-- Get associated items from item_assemblies table --}}
                                    @php
                                        $associatedItems = \App\Models\ItemAssembly::where('item_id', $item->item_id)->get();
                                    @endphp

                                    {{-- Display associated items for assembly item --}}
                                    @foreach ($associatedItems as $associatedItem)
                                        <div class="">
                                            {{-- Query the actual item based on assembly_name --}}
                                            @php
                                                $actualItem = \App\Models\Items::where('item_id', $associatedItem->assembly_name)->first();
                                            @endphp

                                            <label class="text-lg font-semibold text-[#323C47]"
                                                for="">{{ $actualItem->item_name }}</label>
                                            <p class="text-[16px]/[18px] text-[#323C47] font">
                                                {{ $actualItem->item_type }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Total</span>
                        <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white  rounded-3xl mt-7">
                <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3  text-white font-medium">
                        Labor
                    </p>
                </div>
                <div class=" itemDiv ">
                    @php
                        $totalLaborPrice = 0; // Initialize total labor price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'labour')
                            <div
                                class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                                <div class="flex">
                                    <button type="button" class="inline">
                                        <img class="h-[50px] w-[50px] "
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>
                                        <label class="text-lg font-semibold text-[#323C47]"
                                            for="groupName">{{ $item->item_name }}</label>
                                        <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span>${{ $item->item_price }}</span>
                                    @php
                                        $totalLaborPrice += $item->item_price; // Add labor item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalLaborPrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->items) &&
                $userPrivileges->estimate->items === 'on')
            <div class="mb-5 shadow-lg bg-white  rounded-3xl mt-7">
                <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3  text-white font-medium">
                        Labor
                    </p>
                </div>
                <div class=" itemDiv ">
                    @php
                        $totalLaborPrice = 0; // Initialize total labor price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'labour')
                            <div
                                class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                                <div class="flex">
                                    <button type="button" class="inline">
                                        <img class="h-[50px] w-[50px] "
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>
                                        <label class="text-lg font-semibold text-[#323C47]"
                                            for="groupName">{{ $item->item_name }}</label>
                                        <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span>${{ $item->item_price }}</span>
                                    @php
                                        $totalLaborPrice += $item->item_price; // Add labor item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalLaborPrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class=" mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class=" flex py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium">
                        Materials
                    </p>
                </div>
                <div class=" itemDiv col-span-10">
                    @php
                        $totalMaterialPrice = 0; // Initialize total material price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'material')
                            <div
                                class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center">
                                <div class="flex">
                                    <button type="button" class="inline">
                                        <img class="h-[50px] w-[50px] "
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>
                                        <label class="text-lg font-semibold text-[#323C47]"
                                            for="groupName">{{ $item->item_name }}</label>
                                        <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span>${{ $item->item_price }}</span>
                                    @php
                                        $totalMaterialPrice += $item->item_price; // Add material item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="pt-4 px-4 pl-2 flex justify-end  py-7">
                        <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->items) &&
                $userPrivileges->estimate->items === 'on')
            <div class=" mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class=" flex py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium">
                        Materials
                    </p>
                </div>
                <div class=" itemDiv col-span-10">
                    @php
                        $totalMaterialPrice = 0; // Initialize total material price variable
                    @endphp

                    @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'material')
                            <div
                                class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center">
                                <div class="flex">
                                    <button type="button" class="inline">
                                        <img class="h-[50px] w-[50px] "
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>
                                        <label class="text-lg font-semibold text-[#323C47]"
                                            for="groupName">{{ $item->item_name }}</label>
                                        <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span>${{ $item->item_price }}</span>
                                    @php
                                        $totalMaterialPrice += $item->item_price; // Add material item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="pt-4 px-4 pl-2 flex justify-end  py-7">
                        <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Files
                    </p>
                    <button type="button" id="addFile-btn" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="col-span-10">
                    <div class="itemDiv">
                        <div class=" px-5 py-7">
                            @foreach ($estimate_files as $file)
                                <a href="{{ asset('storage/' . $file->estimate_file) }}"
                                    class=" text-[#930027] hover:border-b border-[#930027]" target="_blank">
                                    {{ $file->estimate_file_name }} ,
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->files) &&
                $userPrivileges->estimate->files === 'on')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Files
                    </p>
                    <button type="button" id="addFile-btn" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="col-span-10">
                    <div class="itemDiv">
                        <div class=" px-5 py-7">
                            @foreach ($estimate_files as $file)
                                <a href="{{ asset('storage/' . $file->estimate_file) }}"
                                    class=" text-[#930027] hover:border-b border-[#930027]" target="_blank">
                                    {{ $file->estimate_file_name }} ,
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Photos
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addImage-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" mx-auto  px-5 py-7">
                    <div class="itemDiv">
                        @foreach ($estimate_images as $image)
                            <div class=" inline-block p-2 mx-auto">
                                <img class=" w-16 h-16" src="{{ asset('storage/' . $image->estimate_image) }}"
                                    alt="Estimate Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->photos) &&
                $userPrivileges->estimate->photos === 'on')
            <div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Photos
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addImage-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" mx-auto  px-5 py-7">
                    <div class="itemDiv">
                        @foreach ($estimate_images as $image)
                            <div class=" inline-block p-2 mx-auto">
                                <img class=" w-16 h-16" src="{{ asset('storage/' . $image->estimate_image) }}"
                                    alt="Estimate Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Proposals
                    </p>
                    <a href="/makeProposal/{{ $estimate->estimate_id }}">
                        <button type="button" class="flex bg-white p-1 m-2 rounded-lg">
                            <div class=" bg-[#930027] rounded-lg">
                                <i class="fa-solid fa-plus text-white p-2"></i>
                            </div>
                        </button>
                    </a>
                </div>
                <div>
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Accepted
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposals as $proposal)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $proposal->created_at }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_total }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_accepted }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->proposals) &&
                $userPrivileges->estimate->proposals === 'on')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Proposals
                    </p>
                    <a href="/makeProposal/{{ $estimate->estimate_id }}">
                        <button type="button" class="flex">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}"
                                alt="">
                        </button>
                    </a>
                </div>
                <div>
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Accepted
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposals as $proposal)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $proposal->created_at }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_total }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_accepted }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proposal->proposal_status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Notes
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addNote-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <br>
                <div class=" py-5 px-4  text-black mx-auto">
                    <div class="itemDiv">
                        @foreach ($estimate_notes as $note)
                            <p class=" text-sm my-2 ">
                                {{ $note->estimate_note }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->notes) &&
                $userPrivileges->estimate->notes === 'on')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Notes
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addNote-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <br>
                <div class=" py-5 px-4  text-black mx-auto">
                    <div class="itemDiv">
                        @foreach ($estimate_notes as $note)
                            <p class=" text-sm my-2 ">
                                {{ $note->estimate_note }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Emails
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addEmail-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" py-2">
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Sent To
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email Subject
                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_emails as $email)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $email->created_at }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $email->email_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $email->email_to }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $email->email_subject }}
                                            </td>
                                            <td>
                                                <span
                                                    class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded">Sent</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->emails) &&
                $userPrivileges->estimate->emails === 'on')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Emails
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addEmail-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class=" py-2">
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Sent To
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email Subject
                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_emails as $email)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $email->created_at }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $email->email_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $email->email_to }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $email->email_subject }}
                                            </td>
                                            <td>
                                                <span
                                                    class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded">Sent</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Time Entries
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <br>
                <div class=" p-3 mx-auto">
                    <p class=" text-sm">
                        Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum
                        ha
                        sido el texto de relleno estándar de las.
                    </p>
                    <p class=" text-sm text-[#930027]">
                        Find out more about using time tracking.
                    </p>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimates) &&
                isset($userPrivileges->estimates->timeentries) &&
                $userPrivileges->estimates->timeentries === 'on')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Time Entries
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <br>
                <div class=" p-3 mx-auto">
                    <p class=" text-sm">
                        Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum
                        ha
                        sido el texto de relleno estándar de las.
                    </p>
                    <p class=" text-sm text-[#930027]">
                        Find out more about using time tracking.
                    </p>
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        To-Dos
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="to-do-button">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="p-2">
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Assign By
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Assigned To
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Satrt Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($toDos as $toDo)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $toDo->to_do_title }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $toDo->added_user_id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->to_do_assigned_to }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->start_date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->end_date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->to_do_status }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button id=""
                                                    class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->todos) &&
                $userPrivileges->estimate->todos === 'on')
            <div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        To-Dos
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="to-do-button">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="p-2">
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Assign By
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Assigned To
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Satrt Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($toDos as $toDo)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $toDo->to_do_title }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $toDo->added_user_id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->to_do_assigned_to }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->start_date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->end_date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $toDo->to_do_status }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button id=""
                                                    class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
            <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                <p class="text-lg px-3 text-white  font-medium ">
                    Invoices
                </p>
                <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                    <div class=" bg-[#930027] rounded-lg">
                        <i class="fa-solid fa-plus text-white p-2"></i>
                    </div>
                </button>
            </div>
            <div class="p-2">
                <div class="relative overflow-x-auto py-2">
                    <div class="itemDiv">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tax
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Due
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoices)
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $invoices->complete_invoice_date }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $invoices->invoice_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $invoices->tax_rate }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $invoices->invoice_total }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $invoices->invoice_due }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $invoices->invoice_status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
            <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                <p class="text-lg px-3 text-white  font-medium ">
                    Payments
                </p>
                <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                    <div class=" bg-[#930027] rounded-lg">
                        <i class="fa-solid fa-plus text-white p-2"></i>
                    </div>
                </button>
            </div>
            <div class="p-2">
                <div class="relative overflow-x-auto py-2">
                    <div class="itemDiv">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payments)
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $payments->complete_invoice_date }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $payments->note }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $payments->invoice_total }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white   rounded-3xl ">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Expenses
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="expenses-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="p-2">
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Vendor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Hours
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Paid
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $expense->expense_date }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_vendor }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->labour_hours }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_paid }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->expenses) &&
                $userPrivileges->estimate->expenses === 'on')
            <div class="mb-5 shadow-lg bg-white   rounded-3xl ">
                <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3 text-white  font-medium ">
                        Expenses
                    </p>
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="expenses-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                </div>
                <div class="p-2">
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Vendor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Hours
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Paid
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr class="bg-white border-b">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $expense->expense_date }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_vendor }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->labour_hours }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_paid }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $expense->expense_total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addContact-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/additionalContact" method="post" id="addContact-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Contacts</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div class=" col-span-2" id="">
                            <label for="" class=" block">Title:</label>
                            <input type="text" name="contact_title" id="contact_title" required
                                placeholder="Contact title" autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">First Name:</label>
                            <input type="text" name="first_name" id="first_name" required
                                placeholder="First Name" autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Email:</label>
                            <input type="text" name="email" id="email" required placeholder="Email"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Phone:</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone" required
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addImage-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateImage" enctype="multipart/form-data" method="post" id="addImage-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Images</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2  py-2">
                        <div>
                            <input type="hidden" name="estimate_id" id="estimate_id"
                                value="{{ $estimate->estimate_id }}">
                            <input type="file" name="upload_image[]" id="upload_image" multiple>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addFile-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateFile" enctype="multipart/form-data" method="post" id="addFile-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Files</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2  py-2">
                        <div>
                            <input type="hidden" name="estimate_id" id="estimate_id"
                                value="{{ $estimate->estimate_id }}">
                            <input type="file" name="upload_file" id="upload_file">
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="to-do-button-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addToDos" method="post" id="to-do-button-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add To-Dos</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div class=" col-span-2" id="">
                            <label for="" class=" block">Title:</label>
                            <input type="text" name="task_name" id="task_name" required placeholder="Title"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2" id="">
                            <label for="" class=" block">Who:</label>
                            <select name="assign_work" id="assign_work"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach ($employees as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                        {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            When Should it be completed?
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" placeholder="Last Name"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">End Date:</label>
                            <input type="date" name="end_date" id="end_date" required placeholder=""
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="estimate_note">Add Note:</label>
                            <textarea name="note" id="note" placeholder="Add Note"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8"
                                onclick="voice('note-mic', 'note')"><i
                                    class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="expenses-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateExpense" method="post" id="expenses-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Expenses</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div class="" id="">
                            <label for="" class=" block">Date:</label>
                            <input type="date" name="date" id="date" autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Item Type:</label>
                            <select name="item_type" id="item_type"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="material">material</option>
                                <option value="labour">labour</option>
                            </select>
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Vendor:</label>
                            <input type="text" name="vendor" id="vendor" placeholder="Vendor"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Hours:</label>
                            <input type="number" name="hours" id="hours" placeholder="Hours"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Subtotal:</label>
                            <input type="number" name="subtotal" id="subtotal" placeholder="Subtotal"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Tax:</label>
                            <input type="number" name="tax" id="tax" placeholder="Tax"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Total:</label>
                            <input type="number" name="total" id="total" placeholder="Total"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-5" id="">
                            <input type="checkbox" name="paid" id="paid" value="paid">
                            <label for="paid">Paid</label>
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" placeholder="Description"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8"
                                onclick="voice('note-mic', 'note')"><i
                                    class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEmail-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" flex justify-between border-b">
                    <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Emails</h2>
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <!-- task details -->
                <div class="grid grid-cols-2 gap-2">
                    <div class="col-span-2" id="emailDetailsContainer">
                        <label for="" class="block">Select Email:</label>
                        <select name="" id="emailDropdown"
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select Email</option>
                            @foreach ($email_templates as $emails)
                                <option value="{{ $emails->email_id }}">{{ $emails->email_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <form action="/sendEmail" method="post" id="addEmail-form">
                    @csrf
                    <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                        id="estimate_id">
                    <!-- Display email details here -->
                    <div class=" grid grid-cols-2 gap-4 my-2">
                        <input type="hidden" name="email_id" id="email_id">
                        <div>
                            <label for="email_title">Email title:</label>
                            <input type="text" name="email_name" id="email_name"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <label for="email_to">Email to:</label>
                            <input type="text" name="email_to" id="email_to"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"
                                value="{{ $customer->customer_email }}">
                        </div>
                        <div class=" col-span-2">
                            <label for="email_subject">Email Subject:</label>
                            <textarea name="email_subject" id="email_subject"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                        <div class=" col-span-2">
                            <label for="email_body">Email body:</label>
                            <textarea name="email_body" id="email_body"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addNote-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateNote" method="post" id="addNote-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Note</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div class=" col-span-2 my-2">
                            <label for="estimate_note">Add Note:</label>
                            <textarea name="estimate_note" id="estimate_note" placeholder="Add Note"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8"
                                onclick="voice('note-mic', 'estimate_note')"><i
                                    class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
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
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" text-right">
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <div class="">
                    <div class=" " id="">
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="items-tab"
                                data-tabs-toggle="#items-tab-content" role="tablist">
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="all-tab" data-tabs-target="#all" type="button" role="tab"
                                        aria-controls="all" aria-selected="false">all</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="labour-tab" data-tabs-target="#labour" type="button" role="tab"
                                        aria-controls="labour" aria-selected="false">labour</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="material-tab" data-tabs-target="#material" type="button"
                                        role="tab" aria-controls="material"
                                        aria-selected="false">material</button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="assemblies-tab" data-tabs-target="#assemblies" type="button"
                                        role="tab" aria-controls="assemblies"
                                        aria-selected="false">assemblies</button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="addItem-tab" data-tabs-target="#addItem" type="button"
                                        role="tab" aria-controls="addItem" aria-selected="false">Add
                                        Item</button>
                                </li>
                            </ul>
                        </div>
                        <div id="items-tab-content">
                            {{-- <div class=" my-2">
                                <input type="text" name="search" id="search" placeholder="Search"
                                    autocomplete="given-name"
                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div> --}}
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="all"
                                role="tabpanel" aria-labelledby="all-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="labour"
                                role="tabpanel" aria-labelledby="labour-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($labour_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="material"
                                role="tabpanel" aria-labelledby="material-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($material_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="assemblies"
                                role="tabpanel" aria-labelledby="assemblies-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assembly_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="addItem"
                                role="tabpanel" aria-labelledby="addItem-tab">
                                <form action="/addItemInEstimateAndItems" method="post"
                                    enctype="multipart/form-data" id="">
                                    @csrf
                                    <input type="hidden" name="estimate_id"
                                        value="{{ $estimate->estimate_id }}">
                                    <div class="">
                                        <!-- Modal content here -->
                                        <div class=" flex justify-between">
                                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Items</h2>
                                        </div>
                                        <!-- task details -->
                                        <div class=" text-center grid grid-cols-2 gap-2">
                                            <div class="  col-span-2 my-2">
                                                <label for="" class="block text-left mb-1"> Items
                                                    Type</label>
                                                <select id="type" name="item_type"
                                                    autocomplete="customer-name"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                    <option>type</option>
                                                    <option value="labour">labour</option>
                                                    <option value="material">Material</option>
                                                </select>
                                            </div>
                                            <div class=" my-2">
                                                <label for="" class="block  text-left mb-1"> Item
                                                    Name</label>
                                                <input type="text" name="item_name" id="itemName"
                                                    placeholder="Item Name" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2">
                                                <label for="" class="block text-left mb-1"> Item
                                                    Unit</label>
                                                <select id="item_units" name="item_units"
                                                    autocomplete="customer-name"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                    <option>Units</option>
                                                    <option value="hour">Hour</option>
                                                    <option value="gal">Gal</option>
                                                </select>
                                            </div>
                                            <div class="my-2 text-left">
                                                <label for="" class=" block text-left mb-1">Cost:</label>
                                                <input type="number" name="item_cost" id="item_cost"
                                                    placeholder="00.0" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2 text-left">
                                                <label for="" class=" block text-left mb-1">Price:</label>
                                                <input type="number" name="item_price" id="item_price"
                                                    placeholder="00.0" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2 col-span-2" id="labourExpense">
                                                <label for="" class="block text-left mb-1"> Labour
                                                    Expense</label>
                                                <input type="number" name="labour_expense" id="labourExpense"
                                                    placeholder="Labour Expense" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class=" my-2 col-span-2 hidden" id="multiAdd-items">
                                                <div id="mulitple_input">
                                                    <label for="" class="block text-left mb-1"> Assembly
                                                        Name </label>
                                                    <select name="assembly_name[]" id=""
                                                        placeholder="Item Name" autocomplete="given-name"
                                                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                        <option value="">Select Item</option>

                                                    </select>
                                                </div>
                                                <div class=" text-right mt-2">
                                                    <button type="button"
                                                        class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                                                        id="addbtn" aria-expanded="true" aria-haspopup="true">
                                                        <img src="{{ asset('assets/icons/plus-icon.svg') }}"
                                                            alt="icon">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="my-2 col-span-2 relative">
                                                <label for="" class="block text-left mb-1"> Item Description
                                                </label>
                                                <textarea name="item_description" id="item_description" placeholder="Description"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                                                <button type="button" id="items-mic"
                                                    class=" absolute mt-8 right-4"
                                                    onclick="voice('items-mic', 'item_description')"><i
                                                        class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button id="updateEvent"
                                                class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <form action="/addEstimateItems" method="post" id="formData">
                                    @csrf
                                    <input type="hidden" name="estimate_id"
                                        value="{{ $estimate->estimate_id }}">
                                    <div id="selectedItemsContainer" class="mt-4">
                                        <!-- Badges will be dynamically added here -->

                                    </div>
                                    <div class=" flex justify-between pt-2 border-t">
                                        <button type="button" class=" mb-2 py-1 px-7 rounded-md border ">Cancel
                                        </button>
                                        <button
                                            class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="profitability-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" flex justify-between">
                    <div class=" " id="">
                        Profitability
                    </div>
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <hr>
                <!-- task details -->
                <div class="my-2">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        Hours
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Estimated
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Actual
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Tracked Hours
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Other Labour Hours
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Expense Hours
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class=" bg-gray-100">
                                <tr class="font-semibold text-gray-900">
                                    <th scope="row" class="px-6 py-3 text-base">Total Hours</th>
                                    <td class="px-6 py-3">0.50</td>
                                    <td class="px-6 py-3">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="my-2">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        Labour
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Estimated
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Actual
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Tracked Labour
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Other Labour
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Expense Labour
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class=" bg-gray-100">
                                <tr class="font-semibold text-gray-900">
                                    <th scope="row" class="px-6 py-3 text-base">Total Labour</th>
                                    <td class="px-6 py-3">12.50</td>
                                    <td class="px-6 py-3">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="my-2">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        Material
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Estimated
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Actual
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Other Materials
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Expense Materials
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $10.00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class=" bg-gray-100">
                                <tr class="font-semibold text-gray-900">
                                    <th scope="row" class="px-6 py-3 text-base">Total Materials</th>
                                    <td class="px-6 py-3">$100.00</td>
                                    <td class="px-6 py-3">$10.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="my-2">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        Profit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Estimated
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Actual
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Sales
                                    </th>
                                    <td class="px-6 py-4">
                                        $175.00
                                    </td>
                                    <td class="px-6 py-4">
                                        $175.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Costs
                                    </th>
                                    <td class="px-6 py-4">
                                        $112.50
                                    </td>
                                    <td class="px-6 py-4">
                                        $10.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Profit
                                    </th>
                                    <td class="px-6 py-4">
                                        $62.50
                                    </td>
                                    <td class="px-6 py-4">
                                        $165.00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class=" bg-gray-100">
                                <tr class="font-semibold text-gray-900">
                                    <th scope="row" class="px-6 py-3 text-base">Total Hours</th>
                                    <td class="px-6 py-3">35.7%</td>
                                    <td class="px-6 py-3">94.3%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="schedule-estimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/setSchedule" id="schedule-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_primary_address }},
                            {{ $customer->customer_city }}, {{ $customer->customer_state }},
                            {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                                alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete work?</p>
                            <select name="assign_work" id="assign_work"
                                class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach ($employees as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                        {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name"
                            class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name"
                            class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <textarea placeholder="Note "
                        class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                        name="note" id="note"></textarea>
                    <!-- You can customize this part according to your needs -->
                    <div>
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Set
                            Schedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="complete-estimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeEstimate" id="complete-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_primary_address }},
                            {{ $customer->customer_city }}, {{ $customer->customer_state }},
                            {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                                alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete estimate?</p>
                            <input type="text" id="estimator_name" disabled
                                value="{{ $user_details['name'] }}" name="estimator_name"
                                autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" id="estimator_id" value="{{ $user_details['id'] }}"
                                name="estimator_id" autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will follow up on work acceptence:</label>
                        <select name="assign_estimate" id="assign_estimate"
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select User</option>
                            @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note"
                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4"
                            onclick="voice('note-mic', 'note')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                            Estimate
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="complete-work-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeWorkAndAssignInvoice" method="post" id="complete-work-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_primary_address }},
                            {{ $customer->customer_city }}, {{ $customer->customer_state }},
                            {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who completed the work Order?</p>
                            <input type="text" id="estimator_name" disabled
                                value="{{ $user_details['name'] }}" name="estimator_name"
                                autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" id="work_completed_by" value="{{ $user_details['id'] }}"
                                name="work_completed_by" autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">What is the complete work date?</p>
                            <input type="date" id="complete_work_date" name="complete_work_date"
                                autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <hr>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will Complete and Send Invoice?</label>
                        <select name="assign_invoice" id="assign_invoice"
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select User</option>
                            @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note"
                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4"
                            onclick="voice('note-mic', 'note')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                            Estimate
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="complete-invoice-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeInvoiceAndAssignPayment" method="post" id="complete-invoice-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_primary_address }},
                            {{ $customer->customer_city }}, {{ $customer->customer_state }},
                            {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">What is the complete invoice date?</p>
                            <input type="date" id="complete_invoice_date" name="complete_invoice_date"
                                autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <hr>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will follow up on payment?</label>
                        <select name="assign_payment" id="assign_payment"
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select User</option>
                            @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note"
                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4"
                            onclick="voice('note-mic', 'note')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                            Invoice
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="add-payment-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addPayment" method="post" id="add-payment-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Payment</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    @if ($invoice)
                        <!-- task details -->
                        <div class=" mb-2">
                            <div id="dropdown-div" class="">
                                <p class=" font-medium items-center">Invoice:</p>
                                <input type="text" id="invoice" name="invoice"
                                    value="{{ $invoice->invoice_name }} (Due {{ $invoice->invoice_due }})"
                                    autocomplete="customer-name"
                                    class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <input type="hidden" name="invoice_id"
                                    value="{{ $invoice->estimate_complete_invoice_id }}">
                                <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                            </div>
                        </div>
                        <hr>
                        <div id="dropdown-div" class="">
                            <label for="assiegne-estimate">Details:</label>
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                        </div>
                        <div class=" grid grid-cols-2 gap-3">
                            <div>
                                <label for="">Date:</label>
                                <input type="date" id="invoice_date" name="invoice_date"
                                    value="{{ date('Y-m-d', strtotime($invoice->complete_invoice_date)) }}"
                                    autocomplete="customer-name"
                                    class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            </div>
                            <div>
                                <label for="">Amount:</label>
                                <input type="text" id="invoice_amount" name="invoice_amount"
                                    value="{{ $invoice->invoice_due }}" autocomplete="customer-name"
                                    class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    @endif
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note"
                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4"
                            onclick="voice('note-mic', 'note')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="accept-estimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/scheduleEstimate" id="accept-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id"
                    value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_primary_address }},
                            {{ $customer->customer_city }}, {{ $customer->customer_state }},
                            {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                            alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}"
                                alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label for="assiegne-estimate">Who will schedule Work?</label>
                        <select name="schedule_work" id="schedule_work"
                            class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select User</option>
                            @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p class=" font-medium inline-block items-center">When should it be Completed?</p>
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>Start date:</label>
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name"
                            class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note"
                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4"
                            onclick="voice('note-mic', 'note')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button"
                            class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id=""
                            class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                            Estimate
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2"></script>
<script>
    // Initialize Dropzone
    Dropzone.options.myDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        success: function(file, response) {
            // Handle successful uploads
            console.log(response);
        },
        error: function(file, response) {
            // Handle errors
            console.log(response);
        }
    };
</script>
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
    $("#addImage-btn").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").addClass('hidden');
        $("#addImage-btn-form")[0].reset()
    });
</script>
<script>
    $("#addFile-btn").click(function(e) {
        e.preventDefault();
        $("#addFile-btn-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addFile-btn-modal").addClass('hidden');
        $("#addFile-btn-form")[0].reset()
    });
</script>
<script>
    $("#to-do-button").click(function(e) {
        e.preventDefault();
        $("#to-do-button-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#to-do-button-modal").addClass('hidden');
        $("#to-do-button-form")[0].reset()
    });
</script>
<script>
    $("#expenses-btn").click(function(e) {
        e.preventDefault();
        $("#expenses-btn-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#expenses-btn-modal").addClass('hidden');
        $("#expenses-btn-form")[0].reset()
    });
</script>
<script>
    $(".complete-estimate").click(function(e) {
        e.preventDefault();
        $("#complete-estimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#complete-estimate-modal").addClass('hidden');
        $("#complete-estimate-form")[0].reset()
    });
</script>
<script>
    $("#complete-work").click(function(e) {
        e.preventDefault();
        $("#complete-work-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#complete-work-modal").addClass('hidden');
        $("#complete-work-form")[0].reset()
    });
</script>
<script>
    $("#complete-invoice").click(function(e) {
        e.preventDefault();
        $("#complete-invoice-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#complete-invoice-modal").addClass('hidden');
        $("#complete-invoice-form")[0].reset()
    });
</script>
<script>
    $("#add-payment").click(function(e) {
        e.preventDefault();
        $("#add-payment-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#add-payment-modal").addClass('hidden');
        $("#add-payment-form")[0].reset()
    });
</script>
<script>
    $("#accept-estimate").click(function(e) {
        e.preventDefault();
        $("#accept-estimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#accept-estimate-modal").addClass('hidden');
        $("#accept-estimate-form")[0].reset()
    });
</script>
<script>
    $(".addItems").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").addClass('hidden');
        $("#formData")[0].reset()
    });
</script>
<script>
    $("#profitability-btn").click(function(e) {
        e.preventDefault();
        $("#profitability-btn-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#profitability-btn-modal").addClass('hidden');
        $("#formData")[0].reset()
    });
</script>
<script>
    $("#addNote-btn").click(function(e) {
        e.preventDefault();
        $("#addNote-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addNote-modal").addClass('hidden');
        $("#addNote-form")[0].reset()
    });
</script>
<script>
    $("#addEmail-btn").click(function(e) {
        e.preventDefault();
        $("#addEmail-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEmail-modal").addClass('hidden');
        $("#addEmail-form")[0].reset()
    });
</script>
<script>
    $(document).ready(function() {
        var emailTitle = $('#email_name');
        var emailSubjectInput = $('#email_subject');
        var emailBodyTextarea = $('#email_body');
        var email_id = $('#email_id');

        $('#emailDropdown').change(function() {
            var selectedEmailId = $(this).val();

            // Make an AJAX request to fetch email details based on the selected ID
            $.ajax({
                url: '/getemailDetails/' + selectedEmailId, // Replace with your actual endpoint
                type: 'GET',
                success: function(response) {
                    // Check if the response has a success property and email_detail
                    if (response.success && response.email_detail) {
                        // Access the email properties
                        var emailName = response.email_detail.email_name;
                        var emailSubject = response.email_detail.email_subject;
                        var emailBody = response.email_detail.email_body;
                        var emailId = response.email_detail.email_id;

                        // Update the email details container with input fields
                        email_id.val(emailId);
                        emailTitle.val(emailName);
                        emailSubjectInput.val(emailSubject); // Use .val() for input fields
                        emailBodyTextarea.val(emailBody); // Use .val() for textarea

                    } else {
                        console.error('Invalid response format:', response);
                    }
                },
                error: function(error) {
                    console.error('Error fetching email details:', error);
                }
            });
        });

        var subtotalInput = $('#subtotal');
        var taxInput = $('#tax');
        var totalInput = $('#total');

        // Add event listener to the subtotal and tax inputs
        subtotalInput.on('input', updateTotal);
        taxInput.on('input', updateTotal);

        // Function to update the total based on subtotal and tax
        function updateTotal() {
            var subtotalValue = parseFloat(subtotalInput.val()) || 0;
            var taxValue = parseFloat(taxInput.val()) || 0;

            // Calculate the total
            var totalValue = subtotalValue + taxValue;

            // Update the total input
            totalInput.val(totalValue);
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Function to create a badge element
        function createBadge(item) {
            var badge = $('<span/>', {
                id: 'badge-' + item.item_id,
                class: 'inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-gray-800 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-300',
                text: item.item_name
            });

            // Add hidden input for item ID
            var hiddenInput = $('<input/>', {
                type: 'hidden',
                name: 'selected_items[]',
                value: item.item_id
            });

            badge.append(hiddenInput);

            // Add the cross button to remove the badge
            var closeButton = $('<button/>', {
                type: 'button',
                class: 'inline-flex items-center p-1 ms-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300',
                'data-dismiss-target': 'badge-' + item.item_id,
                'aria-label': 'Remove'
            });

            // Replace the SVG code with the img tag
            var closeIcon = $('<img/>', {
                src: '{{ asset('assets/icons/close-icon.svg') }}',
                alt: 'Remove badge',
                class: 'w-2 h-2'
            });

            // Append elements to the badge and add to the container
            closeButton.append(closeIcon);
            badge.append(closeButton);
            $('#selectedItemsContainer').append(badge);

            // Add event listener to the cross button for badge removal
            closeButton.on('click', function() {
                var badgeId = closeButton.attr('data-dismiss-target');
                var checkboxId = badgeId.replace('badge-', 'selected_items');
                var checkbox = $('#' + checkboxId);

                // Uncheck the corresponding checkbox
                if (checkbox.length) {
                    checkbox.prop('checked', false);
                }

                // Remove the badge
                badge.remove();
            });
        }

        // Function to update the selected items badges
        function updateSelectedItems() {
            $('#selectedItemsContainer').empty(); // Clear previous badges

            $('input[name="selected_items[]"]:checked').each(function() {
                var checkboxValue = $(this).val();
                var item = {};

                // Find the corresponding table row and extract data
                var tableRow = $(this).closest('tr');
                item.item_id = checkboxValue;
                item.item_name = tableRow.find('td:eq(0)')
            .text(); // Assuming the item name is in the first column

                if (item.item_name.trim() !== '') {
                    createBadge(item);
                }
            });
        }

        // Get all checkboxes
        var checkboxes = $('input[name="selected_items[]"]');

        // Add event listener to each checkbox
        checkboxes.on('change', function() {
            updateSelectedItems();
        });

        // Sample data for items (replace with your actual items data)
        var items = [{
                item_id: 1,
                item_name: 'Construction Material A'
            },
            {
                item_id: 2,
                item_name: 'Labor Service B'
            },
            {
                item_id: 3,
                item_name: 'Assembly C'
            },
            {
                item_id: 4,
                item_name: 'Equipment D'
            },
            // Add more items as needed
        ];

        // Initial badge rendering
        updateSelectedItems();
    });
</script>
<script>
    $(document).ready(function() {
        // Initially hide the form

        $("button[role='tab']").click(function() {
            // Check if the clicked tab is not the "Add Item" tab
            if ($(this).attr("id") !== "addItem-tab") {
                // Show the form
                $("#formData").show();
            } else {
                // Hide the form
                $("#formData").hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Set the "all" tab as the default tab
        let activeTab = $("#all");
        activeTab.removeClass("hidden").addClass("active");

        // Add click event listeners to tab buttons
        $("[role='tab']").click(function() {
            // Hide all tab contents
            $("[role='tabpanel']").addClass("hidden");

            // Remove the 'active' class from all tab buttons
            $("[role='tab']").removeClass("active");

            // Get the target tab content and display it
            const targetId = $(this).attr("aria-controls");
            activeTab = $("#" + targetId);
            activeTab.removeClass("hidden").addClass("active");

            // Set the 'active' class for the clicked tab button
            $(this).addClass("active");
        });
    });
</script>
