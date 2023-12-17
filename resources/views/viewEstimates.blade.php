@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2  flex justify-between p-3 pr-0">
                <p class="text-lg font-medium">
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
                        <p class="text-[#F5222D] text-xl font-bold">
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </p>
                        <p class="text-[#323C47] text-lg font-semibold">
                            Webinar - Painting
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
                        <p class="mt-1 flex text-[#323C47]font-medium">
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
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                            <span class="pl-2 flex">{{ $customer->owner }} Assigned To Schedule Estimate On <span class="pl-2 text-[#31A613] flex">
                                    <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}" alt="">
                                    {{ $customer->created_at }}</span>
                            </span>
                        </p>
                    </div>
                    <div class=" col-span-2 p-3 text-right">
                        <p class="text-lg font-bold">
                            Estimate
                            <br>
                            <span>{{ $customer->customer_project_name }}</span>
                        </p>
                        <p class="mt-[2px] ">
                            {{ $customer->customer_project_number }}
                        </p>
                        <p class="">
                            {{ $customer->created_at }}
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
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg py-3 px-3  font-medium">
                    Contacts
                </p>
                <button type="button" class="flex" id="addContact">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10 ">
                <p class="text-lg py-3 my-auto  pl-9 text-[#707683] font-medium">
                    Add Contacts to keep track of your project's stakeholders
                </p>
                <div class="relative overflow-x-auto">
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
                            @foreach($additional_contacts as $contacts)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                    </button>
                                    <button>
                                        <a href="/delete/additionalContact/{{ $contacts->contact_id }}">
                                            <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                        </a>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg py-3 pl-3  font-medium">
                    Actions
                </p>
            </div>
            <div class="col-span-10">
                <div class="my-auto flex p-2">
                    <a href="" class="pl-3">
                        <button type="button" id="schedule-estimate" class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                            <span class=" my-auto">Schedule Estimate</span>
                        </button>
                    </a>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                        <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                        <span class=" my-auto">Complete Estimate</span>
                    </button>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-8 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]">
                        <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/userRole-icon.svg') }}" alt="">
                        <span class=" my-auto">Reassign</span>
                    </button>
                    <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]" id=" action-menubutton" aria-expanded="true" aria-haspopup="true">
                        <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/settings-icon.svg') }}" alt="">
                        <span class=" my-auto">More</span>
                        <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg py-3 px-3  font-medium">
                    Document
                </p>

            </div>
            <div class="col-span-10">
                <div class="my-auto flex py-2">
                    <a href="" class="pl-3">
                        <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                            <svg class=" my-auto mx-1" width="14" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.4C0 0.626801 0.619911 0 1.38462 0H8.9604L12 3.07336V12.6C12 13.3732 11.3801 14 10.6154 14H1.38462C0.619911 14 0 13.3732 0 12.6V1.4ZM2.76923 3.73333H5.53846V4.66667H2.76923V3.73333ZM9.23077 6.53333H2.76923V7.46667H9.23077V6.53333ZM9.23077 9.33333H6.46154V10.2667H9.23077V9.33333Z" fill="white" />
                            </svg>
                            <span class=" my-auto">Preview</span>
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]">
                        <img class="h-[14px] w-[14px]  my-auto mx-1" src="{{ asset('assets/icons/emailTemplate-icon.svg') }}" alt="">
                        <span class=" my-auto">Email</span>
                    </button>
                    <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-5 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#E36152]">
                        <svg class="h-[14px] w-[14px]  my-auto mx-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3.5" y="3.5" width="7" height="7" fill="white" />
                            <rect x="0.5" y="0.5" width="13" height="13" stroke="white" />
                        </svg>
                        <span class=" my-auto">Stop Campaign</span>
                    </button>


                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2  flex justify-between gap-5">
                <p class="text-lg pl-3 font-medium">
                    Profitability
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10">
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
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3 font-medium">
                    Items
                </p>
                <button type="button" class="flex addItems">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class=" itemDiv col-span-10 ml-2 overflow-auto bg-gray-300 rounded-lg border-[#0000004D] m-3">
                @php
                $totalPrice = 0; // Initialize total price variable
                @endphp

                @foreach($estimate_items as $item)
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                    <div class="flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div>
                            <label class="text-lg font-semibold text-[#323C47]" for="">{{ $item->item_name }}</label>
                            <p class="text-[16px]/[18px] text-[#323C47] font">{{ $item->item_type }} </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span>${{ $item->item_price }}</span>
                        @php
                        $totalPrice += $item->item_price; // Add item price to total
                        @endphp
                    </div>
                </div>
                @endforeach

                <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                    <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Total</span>
                    <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3 font-medium">
                    Labor
                </p>
            </div>
            <div class=" itemDiv  col-span-10">
                @php
                $totalLaborPrice = 0; // Initialize total labor price variable
                @endphp

                @foreach($estimate_items as $item)
                @if($item->item_type === 'labour')
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                    <div class="flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div>
                            <label class="text-lg font-semibold text-[#323C47]" for="groupName">{{ $item->item_name }}</label>
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

                <div class="text-right mr-4">
                    <span>${{ number_format($totalLaborPrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3 font-medium">
                    Materials
                </p>
            </div>
            <div class=" itemDiv col-span-10">
                @php
                $totalMaterialPrice = 0; // Initialize total material price variable
                @endphp

                @foreach($estimate_items as $item)
                @if($item->item_type === 'material')
                <div class="flex border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center">
                    <div class="flex">
                        <button type="button" class="inline">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                        </button>
                        <div>
                            <label class="text-lg font-semibold text-[#323C47]" for="groupName">{{ $item->item_name }}</label>
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

                <div class="pt-4 px-4 pl-2 flex justify-end">
                    <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Files
                </p>
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Photos
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  hidden p-2" id="image-field">
                <form action="/additionalImage" enctype="multipart/form-data" method="post" class="dropzone" id="myDropzone">
                    @csrf
                    <input type="text" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                    <div class="fallback">
                        <input name="estimate_image" type="file" multiple />
                    </div>
                </form>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Proposals
                </p>
                <a href="/makeProposal/{{ $estimate->estimate_id }}">
                    <button type="button" class="flex">
                        <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                    </button>
                </a>
            </div>
            <div class="col-span-10 ">
                <div class="relative overflow-x-auto py-2">
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
                            @foreach($proposals as $proposal)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Notes
                </p>
                <button type="button" class="flex" id="addNote-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 py-3 mx-auto">
                @foreach($estimate_notes as $note)
                <p class=" text-sm my-2 ">
                    {{ $note->estimate_note }}
                </p>
                @endforeach
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Emails
                </p>
                <button type="button" class="flex" id="addEmail-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 py-1">
                <div class="relative overflow-x-auto">
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
                            @foreach($estimate_emails as $email)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded">Sent</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Time Entries
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 p-3 mx-auto">
                <p class=" text-sm">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las.
                </p>
                <p class=" text-sm text-[#930027]">
                    Find out more about using time tracking.
                </p>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    To-Dos
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 p-3 mx-auto">
                <p class=" text-sm">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las.
                </p>
                <p class=" text-sm text-[#930027]">
                    Find out more about using time tracking.
                </p>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Invoices
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 p-3 mx-auto">
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Payments
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 p-3 mx-auto">
                <p class=" text-sm">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las.
                </p>
                <p class=" text-sm text-[#930027]">
                    Find out more about using time tracking.
                </p>
            </div>
        </div>
        <hr class="bg-gray-300">
        <div class="grid sm:grid-cols-12">
            <div class="col-span-2 flex justify-between gap-5">
                <p class="text-lg px-3  font-medium">
                    Expenses
                </p>
                <button type="button" class="flex" id="addImage-btn">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/pluss-icon.svg') }}" alt="">
                </button>
            </div>
            <br>
            <div class="col-span-12 p-3 mx-auto">
                <p class=" text-sm">
                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las.
                </p>
                <p class=" text-sm text-[#930027]">
                    Find out more about using time tracking.
                </p>
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
                            <input type="text" name="contact_title" id="contact_title" required placeholder="Contact title" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">First Name:</label>
                            <input type="text" name="first_name" id="first_name" required placeholder="First Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Email:</label>
                            <input type="text" name="email" id="email" required placeholder="Email" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Phone:</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone" required autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                <div class="grid grid-cols-2 gap-2">
                    <div class="col-span-2" id="emailDetailsContainer">
                        <label for="" class="block">Select Email:</label>
                        <select name="" id="emailDropdown" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <option value="">Select Email</option>
                            @foreach($email_templates as $emails)
                            <option value="{{ $emails->email_id }}">{{ $emails->email_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <form action="/sendEmail" method="post" id="addEmail-form">
                    @csrf
                    <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                    <!-- Display email details here -->
                    <div class=" grid grid-cols-2 gap-4 my-2">
                        <input type="hidden" name="email_id" id="email_id">
                        <div>
                            <label for="email_title">Email title:</label>
                            <input type="text" name="email_name" id="email_name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <label for="email_to">Email to:</label>
                            <input type="text" name="email_to" id="email_to" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $customer->customer_email }}">
                        </div>
                        <div class=" col-span-2">
                            <label for="email_subject">Email Subject:</label>
                            <textarea name="email_subject" id="email_subject" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                        <div class=" col-span-2">
                            <label for="email_body">Email body:</label>
                            <textarea name="email_body" id="email_body" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateNote" method="post" id="addNote-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
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
                            <textarea name="estimate_note" id="estimate_note" placeholder="Add Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8" onclick="voice('note-mic', 'estimate_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
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
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <div class=" my-2">
                    <input type="text" name="search" id="search" placeholder="Search" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                </div>
                <!-- task details -->

                <form action="/addEstimateItems" method="post" id="formData">
                    <div class="relative overflow-x-auto h-60 overflow-y-auto my-2">
                        @csrf
                        <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                        <table class="w-full text-sm text-left">
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
                                @foreach($items as $item)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->item_name }}
                                        <input type="hidden" name="selected_item_names[]" value="{{ $item->item_name }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->item_type }}
                                        <input type="hidden" name="selected_item_types[]" value="{{ $item->item_type }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->item_unit }}
                                        <input type="hidden" name="selected_item_units[]" value="{{ $item->item_unit }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{ $item->item_cost }}
                                        <input type="hidden" name="selected_item_costs[]" value="{{ $item->item_cost }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{ $item->item_price }}
                                        <input type="hidden" name="selected_item_prices[]" value="{{ $item->item_price }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="selected_items[]" id="selected_items{{ $item->item_id }}" value="{{ $item->item_id }}">
                                        <label for="selected_items{{ $item->item_id }}"></label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" flex justify-between pt-2 border-t">
                        <button type="submit" class=" mb-2 py-1 px-7 rounded-md border ">Cancel
                        </button>
                        <button class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </form>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/setSchedule" id="schedule-estimate-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{$customer->customer_primary_address}}, {{$customer->customer_city}}, {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}</p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete estimate?</p>
                            <input type="text" id="estimator_name" disabled value="{{ $user_details['name'] }}" name="estimator_name" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <textarea placeholder="Note " class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="note" id="note"></textarea>
                    <!-- task details -->
                    <p class="text-sm mb-4" id="modal-description"></p>
                    <!-- You can customize this part according to your needs -->
                    <div>
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Set Schedule
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
    $("#schedule-estimate").click(function(e) {
        e.preventDefault();
        $("#schedule-estimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#schedule-estimate-modal").addClass('hidden');
        $("#schedule-estimate-form")[0].reset()
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
    });
</script>