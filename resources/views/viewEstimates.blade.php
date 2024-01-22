@include('layouts.header')
@php
    $userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-transparent w-full">
        <div class=" mb-5 shadow-lg bg-white text-white  rounded-3xl">
            <div class="  flex gap-x-1 items-center px-3  bg-[#930027] rounded-t-3xl">
                <button type="button" class="flex" id="btnStartAdvanced">
                    <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                </button>
                <p class="text-lg  font-medium">
                    Project
                </p>
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
                <div class="flex  items-center gap-2 px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text- lg py-3  font-medium text-white">
                        Contacts
                    </p>
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
                                                <button id="edit-Con-modal{{ $contacts->contact_id }}">
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
                                            <div class="fixed z-10 inset-0 overflow-y-auto hidden"
                                                id="edit_contact_modal{{ $contacts->contact_id }}">
                                                <div
                                                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <!-- Background overlay -->
                                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                                    </div>

                                                    <!-- Modal panel -->
                                                    <div
                                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                        <form action="/updateAdditionalContact" method="post"
                                                            id="editContact-form">
                                                            @csrf
                                                            <input type="hidden" value="{{ $estimate->estimate_id }}"
                                                                name="estimate_id" id="estimate_id">
                                                            <input type="hidden" name="contact_id"
                                                                value="{{ $contacts->contact_id }}">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <!-- Modal content here -->
                                                                <div class=" flex justify-between border-b">
                                                                    <h2 class=" text-xl font-semibold mb-2 "
                                                                        id="modal-title">Add Contacts</h2>
                                                                    <button
                                                                        class="modal-close{{ $contacts->contact_id }}"
                                                                        type="button">
                                                                        <img src="{{ asset('assets/icons/close-icon.svg') }}"
                                                                            alt="icon">
                                                                    </button>
                                                                </div>
                                                                <!-- task details -->
                                                                <div class=" grid grid-cols-2 gap-2">
                                                                    <div class=" col-span-2" id="">
                                                                        <label for=""
                                                                            class=" block">Title:</label>
                                                                        <input value="{{ $contacts->contact_title }}"
                                                                            type="text" name="contact_title"
                                                                            id="contact_title" required
                                                                            placeholder="Contact title"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for="" class=" block">First
                                                                            Name:</label>
                                                                        <input
                                                                            value="{{ $contacts->contact_first_name }}"
                                                                            type="text" name="first_name"
                                                                            id="first_name" required
                                                                            placeholder="First Name"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for="" class=" block">Last
                                                                            Name:</label>
                                                                        <input
                                                                            value="{{ $contacts->contact_last_name }}"
                                                                            type="text" name="last_name"
                                                                            id="last_name" placeholder="Last Name"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for=""
                                                                            class=" block">Email:</label>
                                                                        <input value="{{ $contacts->contact_email }}"
                                                                            type="text" name="email"
                                                                            id="email" required
                                                                            placeholder="Email"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for=""
                                                                            class=" block">Phone:</label>
                                                                        <input value="{{ $contacts->contact_phone }}"
                                                                            type="tel" name="phone"
                                                                            id="phone" placeholder="Phone"
                                                                            required autocomplete="given-name"
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
                                            <script>
                                                document.getElementById("edit-Con-modal{{ $contacts->contact_id }}").addEventListener("click", function(e) {
                                                    e.preventDefault();
                                                    document.getElementById("edit_contact_modal{{ $contacts->contact_id }}").classList.remove('hidden');
                                                });

                                                document.querySelector(".modal-close{{ $contacts->contact_id }}").addEventListener("click", function(e) {
                                                    e.preventDefault();
                                                    document.getElementById("edit_contact_modal{{ $contacts->contact_id }}").classList.add('hidden');
                                                });
                                            </script>
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
                                                <button id="edit-Con-modal{{ $contacts->contact_id }}">
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
                                            <div class="fixed z-10 inset-0 overflow-y-auto hidden"
                                                id="edit_contact_modal{{ $contacts->contact_id }}">
                                                <div
                                                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <!-- Background overlay -->
                                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                                    </div>

                                                    <!-- Modal panel -->
                                                    <div
                                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                        <form action="/updateAdditionalContact" method="post"
                                                            id="editContact-form">
                                                            @csrf
                                                            <input type="hidden"
                                                                value="{{ $estimate->estimate_id }}"
                                                                name="estimate_id" id="estimate_id">
                                                            <input type="hidden" name="contact_id"
                                                                value="{{ $contacts->contact_id }}">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <!-- Modal content here -->
                                                                <div class=" flex justify-between border-b">
                                                                    <h2 class=" text-xl font-semibold mb-2 "
                                                                        id="modal-title">Add Contacts</h2>
                                                                    <button
                                                                        class="modal-close{{ $contacts->contact_id }}"
                                                                        type="button">
                                                                        <img src="{{ asset('assets/icons/close-icon.svg') }}"
                                                                            alt="icon">
                                                                    </button>
                                                                </div>
                                                                <!-- task details -->
                                                                <div class=" grid grid-cols-2 gap-2">
                                                                    <div class=" col-span-2" id="">
                                                                        <label for=""
                                                                            class=" block">Title:</label>
                                                                        <input value="{{ $contacts->contact_title }}"
                                                                            type="text" name="contact_title"
                                                                            id="contact_title" required
                                                                            placeholder="Contact title"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for="" class=" block">First
                                                                            Name:</label>
                                                                        <input
                                                                            value="{{ $contacts->contact_first_name }}"
                                                                            type="text" name="first_name"
                                                                            id="first_name" required
                                                                            placeholder="First Name"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for="" class=" block">Last
                                                                            Name:</label>
                                                                        <input
                                                                            value="{{ $contacts->contact_last_name }}"
                                                                            type="text" name="last_name"
                                                                            id="last_name" placeholder="Last Name"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for=""
                                                                            class=" block">Email:</label>
                                                                        <input value="{{ $contacts->contact_email }}"
                                                                            type="text" name="email"
                                                                            id="email" required
                                                                            placeholder="Email"
                                                                            autocomplete="given-name"
                                                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                                    </div>
                                                                    <div class="" id="">
                                                                        <label for=""
                                                                            class=" block">Phone:</label>
                                                                        <input value="{{ $contacts->contact_phone }}"
                                                                            type="tel" name="phone"
                                                                            id="phone" placeholder="Phone"
                                                                            required autocomplete="given-name"
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
                                            <script>
                                                document.getElementById("edit-Con-modal{{ $contacts->contact_id }}").addEventListener("click", function(e) {
                                                    e.preventDefault();
                                                    document.getElementById("edit_contact_modal{{ $contacts->contact_id }}").classList.remove('hidden');
                                                });

                                                document.querySelector(".modal-close{{ $contacts->contact_id }}").addEventListener("click", function(e) {
                                                    e.preventDefault();
                                                    document.getElementById("edit_contact_modal{{ $contacts->contact_id }}").classList.add('hidden');
                                                });
                                            </script>
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
                            <a href="/getEstimateToSetScheduleWork{{ $estimate->estimate_id }}">
                                <button type="button" id="schedule-estimate"
                                    class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                    <img class="h-[14px] w-[14px] my-auto mx-1"
                                        src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                                    <span class=" my-auto">Schedule Work</span>
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
                        @if ($estimate->estimate_schedule_assigned != 1)
                            <a href="/getEstimateToSetSchedule{{ $estimate->estimate_id }}">
                                <button type="button" id="schedule-estimate"
                                    class=" schedule-estimate flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                    <img class="h-[14px] w-[14px] my-auto mx-1"
                                        src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                                    <span class=" my-auto">Schedule Estimate</span>
                                </button>
                            </a>
                        @endif
                        @if ($estimate->estimate_schedule_assigned_to != 1 && $estimate->estimate_assigned != 1)
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
                    <div class="p-4 text-white">
                        <h1><i class="fa-solid fa-circle-exclamation"></i> Not Functioned!</h1>
                    </div>
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
                        <a href="https://maps.google.com/?q={{ $customer->customer_primary_address }}"
                            target="_blank" class="pl-3">
                            <button type="button"
                                class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]"
                                id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                                <span class=" my-auto">Location</span>
                                <i class="fa-solid fa-location-dot my-auto mx-auto"></i>
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
                    <div class="flex items-center gap-2">
                        <button type="button" id="profitability-btn" class="flex">
                            <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                alt="">
                        </button>
                        <p class="text-lg text-white pl-3 font-medium">
                            Profitability
                        </p>
                    </div>
                    <div class="p-4 text-white">
                        <h1><i class="fa-solid fa-circle-exclamation"></i> Not Functioned!</h1>
                    </div>
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
            <div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" id="addItem-menubutton" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="absolute top-14 z-10">
                        <div id="addItem-menu"
                            class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li>
                                    <button id="" type="button"
                                        class=" addItems block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Add Item
                                    </button>
                                </li>
                                <hr>
                                {{-- <li>
                                    <button id="addTemplate" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Template Name</button>
                                </li> --}}
                                @foreach ($item_templates as $template)
                                    <li>
                                        <button id="addTemplate{{ $template->item_template_id }}"
                                            class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $template->item_template_name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <p class="text-lg px-3 text-white font-medium">
                        Items
                    </p>
                </div>
                @php
                    $totalPrice = 0; // Initialize total price variable
                @endphp
                <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                    @if ($estimate_items->count() > 0)
                        <div class="relative overflow-x-auto">
                            <div class="itemDiv">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">

                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Item Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Item Description
                                            </th>
                                            <th scope="col" class="text-center">
                                                Item Cost
                                            </th>
                                            <th scope="col" class="text-center">
                                                Item Qty
                                            </th>
                                            <th scope="col" class="text-center">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estimate_items as $item)
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-full w-full"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalPrice += $item->item_total; // Add item price to total
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @foreach ($estimateItemTemplates as $estItemTemplate)
                        <div class="mb-2 bg-white shadow-xl">
                            <div class=" flex p-1 bg-[#930027] text-white w-full rounded-t-lg">
                                <button type="button"
                                    id="editEstimate-template{{ $estItemTemplate['est_template_id'] }}"
                                    class="inline my-auto">
                                    <img class="h-full w-full"
                                        src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                                <h1 class=" font-medium my-auto">{{ $estItemTemplate['item_template_name'] }}</h1>
                            </div>
                            <div class="relative overflow-x-auto">
                                <div class="itemDiv">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">

                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Price
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estItemTemplate['estimateItemTemplateItems'] as $item)
                                                <tr class="bg-white border-b">
                                                    <th scope="row"
                                                        class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                        <button type="button"
                                                            id="editEstimateTemplate-item{{ $item['est_template_item_id'] }}"
                                                            class="inline">
                                                            <img class="h-full w-full"
                                                                src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                                alt="">
                                                        </button>
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        <label class="text-lg font-semibold text-[#323C47]"
                                                            for="">{{ $item['item_name'] }}</label>
                                                    </td>
                                                    <td class="px-6 py-4 w-[40%]">
                                                        <p class="text-[16px]/[18px] text-[#323C47] font">
                                                            @if ($item['item_description'])
                                                                <p class="font-medium">Description:</p>
                                                                {{ $item['item_description'] }}
                                                            @endif
                                                            @if ($item['item_note'])
                                                                <p class="font-medium">Note:</p>
                                                                {{ $item['item_note'] }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_price'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_qty'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_total'] }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalPrice += $item['item_total']; // Add item price to total
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- @foreach ($estimate_items as $item)
                        <div class=" border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <button type="button" id="editEstimate-item{{$item->item_id}}" class="inline">
                                        <img class="h-[50px] w-[50px]"
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>


                                    </div>
                                </div>
                                <div class="float-right pt-2">
                                    <div class="flex flex-col gap-3">
                                        <div>

                                        </div>
                                        <p class=""><strong>Qty:</strong> {{ $item->item_qty ?: 0 }}</p>
                                        <p class=""><strong> Total:</strong> ${{ $item->item_total }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 pb-">



                                @if ($item->item_type === 'assemblies')
                                    @php
                                        $associatedItems = \App\Models\ItemAssembly::where('item_id', $item->item_id)->get();
                                    @endphp

                                    @foreach ($associatedItems as $associatedItem)
                                        <div class="">
                                            @php
                                                $actualItem = \App\Models\Items::where('item_id', $associatedItem->assembly_name)->first();
                                            @endphp

                                            <label class="text-lg font-semibold text-[#323C47]"
                                                for="">{{ $actualItem->item_name }}</label>
                                            <p class="text-[16px]/[18px] text-[#323C47] font">
                                                {{ $actualItem->item_type }}</p>
                                        </div>
                                        <hr class="my-3 px-[100px] border-gray-900">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach --}}
                    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
                        <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
                    </div>
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->items) &&
                $userPrivileges->estimate->items === 'on')
            <div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" id="addItem-menubutton" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <!-- Dropdown menu -->
                    <div class=" absolute z-10 top-14">
                        <div id="addItem-menu"
                            class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li>
                                    <button id="" type="button"
                                        class=" addItems block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Add Item
                                    </button>
                                </li>
                                <hr>
                                {{-- <li>
                                    <button id="addTemplate" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Template Name</button>
                                </li> --}}
                                @foreach ($item_templates as $template)
                                    <li>
                                        <button id="addTemplate{{ $template->item_template_id }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $template->item_template_name }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <p class="text-lg px-3 text-white font-medium">
                        Items
                    </p>
                </div>
                @php
                    $totalPrice = 0; // Initialize total price variable
                @endphp
                <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                    @if ($estimate_items->count() > 0)
                        <div class="relative overflow-x-auto">
                            <div class="itemDiv">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">

                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Item Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Item Description
                                            </th>
                                            <th scope="col" class="text-center">
                                                Item Cost
                                            </th>
                                            <th scope="col" class="text-center">
                                                Item Qty
                                            </th>
                                            <th scope="col" class="text-center">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estimate_items as $item)
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-full w-full"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalPrice += $item->item_total; // Add item price to total
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @foreach ($estimateItemTemplates as $estItemTemplate)
                        <div class="mb-2 bg-white shadow-xl">
                            <div class=" flex p-1 bg-[#930027] text-white w-full rounded-t-lg">
                                <button type="button"
                                    id="editEstimate-template{{ $estItemTemplate['est_template_id'] }}"
                                    class="inline my-auto">
                                    <img class="h-full w-full"
                                        src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                                <h1 class=" font-medium my-auto">{{ $estItemTemplate['item_template_name'] }}</h1>
                            </div>
                            <div class="relative overflow-x-auto">
                                <div class="itemDiv">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">

                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Price
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estItemTemplate['estimateItemTemplateItems'] as $item)
                                                <tr class="bg-white border-b">
                                                    <th scope="row"
                                                        class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                        <button type="button"
                                                            id="editEstimateTemplate-item{{ $item['est_template_item_id'] }}"
                                                            class="inline">
                                                            <img class="h-full w-full"
                                                                src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                                alt="">
                                                        </button>
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        <label class="text-lg font-semibold text-[#323C47]"
                                                            for="">{{ $item['item_name'] }}</label>
                                                    </td>
                                                    <td class="px-6 py-4 w-[40%]">
                                                        <p class="text-[16px]/[18px] text-[#323C47] font">
                                                            @if ($item['item_description'])
                                                                <p class="font-medium">Description:</p>
                                                                {{ $item['item_description'] }}
                                                            @endif
                                                            @if ($item['item_note'])
                                                                <p class="font-medium">Note:</p>
                                                                {{ $item['item_note'] }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_price'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_qty'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['item_total'] }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalPrice += $item['item_total']; // Add item price to total
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- @foreach ($estimate_items as $item)
                        <div class=" border-b border-[#0000001A] w-full px-4 pl-0 justify-between items-center mb-4">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <button type="button" id="editEstimate-item{{$item->item_id}}" class="inline">
                                        <img class="h-[50px] w-[50px]"
                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div>


                                    </div>
                                </div>
                                <div class="float-right pt-2">
                                    <div class="flex flex-col gap-3">
                                        <div>

                                        </div>
                                        <p class=""><strong>Qty:</strong> {{ $item->item_qty ?: 0 }}</p>
                                        <p class=""><strong> Total:</strong> ${{ $item->item_total }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 pb-">



                                @if ($item->item_type === 'assemblies')
                                    @php
                                        $associatedItems = \App\Models\ItemAssembly::where('item_id', $item->item_id)->get();
                                    @endphp

                                    @foreach ($associatedItems as $associatedItem)
                                        <div class="">
                                            @php
                                                $actualItem = \App\Models\Items::where('item_id', $associatedItem->assembly_name)->first();
                                            @endphp

                                            <label class="text-lg font-semibold text-[#323C47]"
                                                for="">{{ $actualItem->item_name }}</label>
                                            <p class="text-[16px]/[18px] text-[#323C47] font">
                                                {{ $actualItem->item_type }}</p>
                                        </div>
                                        <hr class="my-3 px-[100px] border-gray-900">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach --}}
                    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
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
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'labour')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalLaborPrice += $item->item_total; // Add labor item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalLaborPrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                    @endforeach --}}
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
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'labour')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalLaborPrice += $item->item_total; // Add labor item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalLaborPrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                    @endforeach --}}
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
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'material')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalMaterialPrice += $item->item_total; // Add material item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pt-4 px-4 pl-2 flex justify-end  py-7">
                        <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                    @endforeach --}}
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
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'material')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalMaterialPrice += $item->item_total; // Add material item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pt-4 px-4 pl-2 flex justify-end  py-7">
                        <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                    @endforeach --}}
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white  rounded-3xl mt-7">
                <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3  text-white font-medium">
                        Upgrade
                    </p>
                </div>
                <div class=" itemDiv ">
                    @php
                        $totalUpgradePrice = 0; // Initialize total labor price variable
                    @endphp
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Upgrade Status
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'upgrades')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->upgrade_status }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalUpgradePrice += $item->item_total; // Add labor item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalUpgradePrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                                        $totalUpgradePrice += $item->item_price; // Add labor item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach --}}
                </div>
            </div>
        @elseif(isset($userPrivileges->estimate) &&
                isset($userPrivileges->estimate->items) &&
                $userPrivileges->estimate->items === 'on')
            <div class="mb-5 shadow-lg bg-white  rounded-3xl mt-7">
                <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg px-3  text-white font-medium">
                        Upgrade
                    </p>
                </div>
                <div class=" itemDiv ">
                    @php
                        $totalUpgradePrice = 0; // Initialize total labor price variable
                    @endphp
                    <div class="relative overflow-x-auto">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item Description
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estimate_items as $item)
                                        @if ($item->item_type === 'upgrades')
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                                    <button type="button"
                                                        id="editEstimate-item{{ $item->estimate_item_id }}"
                                                        class="inline">
                                                        <img class="h-[50px] w-[50px]"
                                                            src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                                                            alt="">
                                                    </button>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <label class="text-lg font-semibold text-[#323C47]"
                                                        for="">{{ $item->item_name }}</label>
                                                </td>
                                                <td class="px-6 py-4 w-[50%]">
                                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                                        @if ($item->item_description)
                                                            <p class="font-medium">Description:</p>
                                                            {{ $item->item_description }}
                                                        @endif
                                                        @if ($item->item_note)
                                                            <p class="font-medium">Note:</p>
                                                            {{ $item->item_note }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_cost }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_qty }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->item_total }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalUpgradePrice += $item->item_total; // Add labor item price to total
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right mr-4 py-6">
                        <span>${{ number_format($totalUpgradePrice, 2) }}</span> {{-- Display the formatted total labor price --}}
                    </div>
                    {{-- @foreach ($estimate_items as $item)
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
                                        $totalUpgradePrice += $item->item_price; // Add labor item price to total
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endforeach --}}
                </div>
            </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
            <div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" id="addFile-btn" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Files
                    </p>
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
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addImage-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Photos
                    </p>
                </div>
                <div class=" mx-auto  px-5 py-7">
                    <div class="itemDiv">
                        @foreach ($estimate_images as $image)
                            <a href="/viewGallery{{ $image->estimate_id }}">
                                <div class=" inline-block p-2 mx-auto">
                                    <img class=" w-16 h-16 rounded-md hover:scale-105 duration-300"
                                        src="{{ asset('storage/' . $image->estimate_image) }}" alt="Estimate Image">
                                </div>
                            </a>
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
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <a href="/makeProposal/{{ $estimate->estimate_id }}">
                        <button type="button" class="flex bg-white p-1 m-2 rounded-lg">
                            <div class=" bg-[#930027] rounded-lg">
                                <i class="fa-solid fa-plus text-white p-2"></i>
                            </div>
                        </button>
                    </a>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Proposals
                    </p>
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
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addNote-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Notes
                    </p>
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
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addNote-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Notes
                    </p>
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
                <div class="flex items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addEmail-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Emails
                    </p>
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
                    <div class="flex items-center ">
                        <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                            <div class=" bg-[#930027] rounded-lg">
                                <i class="fa-solid fa-plus text-white p-2"></i>
                            </div>
                        </button>
                        <p class="text-lg px-3 text-white  font-medium ">
                            Time Entries
                        </p>
                    </div>
                    <div class="p-4 text-white">
                        <h1><i class="fa-solid fa-circle-exclamation"></i> Not Functioned!</h1>
                    </div>

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
                    <div class="p-4 text-white">
                        <h1><i class="fa-solid fa-circle-exclamation"></i> Not Functioned!</h1>
                    </div>
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
                <div class="flex items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="to-do-button">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        To-Dos
                    </p>
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
            <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                    <div class=" bg-[#930027] rounded-lg">
                        <i class="fa-solid fa-plus text-white p-2"></i>
                    </div>
                </button>
                <p class="text-lg px-3 text-white  font-medium ">
                    Invoices
                </p>
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
            <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                    <div class=" bg-[#930027] rounded-lg">
                        <i class="fa-solid fa-plus text-white p-2"></i>
                    </div>
                </button>
                <p class="text-lg px-3 text-white  font-medium ">
                    Payments
                </p>
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
                <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="expenses-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Expenses
                    </p>
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
                <div class="flex items-center px-3  bg-[#930027] rounded-t-3xl">
                    <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="expenses-btn">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <p class="text-lg px-3 text-white  font-medium ">
                        Expenses
                    </p>
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
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
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
            <form action="/addEstimateImage" enctype="multipart/form-data" method="post"
                id="addImage-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
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
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
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
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id"
                    id="estimate_id">
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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addItems-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateItems" method="post" enctype="multipart/form-data" id="itemsForm">
                @csrf
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="item_id" id="item_id" value="">
                <input type="hidden" name="is_upgrade" id="is_upgrade" value="">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Items</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-12 gap-2">
                        <div class="  col-span-12 my-0">
                            <label for="" class="block text-left mb-1">Select Item</label>
                            <select id="selected_item" name="selected_item" autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md  -0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">select item</option>
                                <option value="upgrades">Upgrades</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="  col-span-12 my-0">
                            <label for="" class="block text-left mb-1"> Items Type</label>
                            <select id="type" name="item_type" autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option value="upgrades">Upgrades</option>
                                <option value="labour">labour</option>
                                <option value="material">Material</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class=" my-0 col-span-6">
                            <label for="" class="block  text-left mb-1"> Item Name</label>
                            <input type="text" name="item_name" id="itemName" placeholder="Item Name"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 col-span-6">
                            <label for="" class="block text-left mb-1"> Item Unit</label>
                            <input type="text" id="item_units" name="item_units" autocomplete="customer-name"
                                placeholder="Units(Optional)"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="my-0 col-span-6" id="labourExpense">
                            <label for="" class="block text-left mb-1"> Labour Cost (min/<span
                                    class="unit">unit</span>)</label>
                            <input type="number" name="labour_expense" id="labour_expense"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Labour Cost: $25.00/hr</span>
                        </div>
                        <div class="my-0 hidden col-span-6" id="materialExpense">
                            <label for="" class="block text-left mb-1"> material Cost ($/<span
                                    class="unit">unit</span>)</label>
                            <input type="number" name="material_expense" id="material_expense"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 text-left col-span-6">
                            <label for="" class=" block text-left mb-1">Cost ($/<span
                                    class="unit">unit</span>)</label>
                            <input type="number" name="item_cost" id="item_cost" placeholder="0.00"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 col-span-4 text-left">
                            <label for="" class=" block text-left mb-1">Price:</label>
                            <input type="number" name="item_price" id="item_price" placeholder="00.0"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Margin: <span
                                    id="price_margin">0.00</span>%</span>
                        </div>
                        <div class="my-0 text-left col-span-4">
                            <div class="flex justify-around items-center">
                                <div class="relative inline-block text-left mt-2">
                                    <button type="button"
                                        class="bg-[#930027] py-[6px] px-2 mt-5 rounded-l-md text-white">
                                        <div id="cal-menubutton" class=" cursor-pointer" aria-expanded="true"
                                            aria-haspopup="true">
                                            {{-- <img id="calculater-modal"  class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}"
                                            alt="icon"> --}}
                                            <i id="calculater-modal" class="fa-solid fa-calculator"></i>
                                        </div>
                                    </button>
                                    {{-- ====================== --}}
                                    <div class="absolute  text-left h-[100%]  z-[999] " <div id="cal-menu"
                                        style="background-color:#3a4655 !important;"
                                        class=" topbar-manuLeaving   z-10 mt-2 w-56 origin-top-right rounded-md bg-[#3a4655] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        tabindex="-1">
                                        <div class="py-1 left-5" role="none">
                                            <div class="relative  bg-[#3a4655]">
                                                <input
                                                    class="block mx-2 mt-2 border bg-[#3a4655] h-[30px] rounded text-white border-white "
                                                    type="text" readonly id="cal_display">
                                                <div class="grid text-white grid-cols-4 gap-y-3  p-2 mt-3">
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">%</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">/</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px] ">
                                                        << /button>
                                                            <button id="clear_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">C</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">7</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">8</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">9</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">*</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">4</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">5</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">6</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">-</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">1</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">2</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">3</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">+</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">0</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">00</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">.</button>
                                                            <button id="equal_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">=</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- ====================== --}}
                                <div>
                                    <label for="" class=" block text-left mb-1">Quantity:</label>
                                    <input type="number" name="item_qty" id="item_qty" placeholder="00.0"
                                        autocomplete="given-name"
                                        class=" w-[100%] outline-none rounded-r-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="my-0 text-left col-span-4">
                            <label for="" class=" block text-left mb-1">Total:</label>
                            <input type="number" name="item_total" id="item_total" placeholder="00.0"
                                autocomplete="given-name"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-0 col-span-12 hidden" id="multiAdd-items">
                            <div id="mulitple_input">
                                <label for="" class="block text-left mb-1"> Assembly Name </label>
                                <div id="item_main">
                                    <select name="assembly_name[]" id="assembly_name" placeholder="Item Name"
                                        autocomplete="given-name"
                                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <option value="">Select Item</option>
                                        @foreach ($itemsForAssemblies as $item)
                                            <option value="{{ $item->item_name }}"
                                                data-unit="{{ $item->item_units }}">{{ $item->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class=" grid grid-cols-2 gap-3 mt-2">
                                        <div>
                                            <input type="number" name="assembly_unit_by_item_unit[]"
                                                id="assembly_unit_by_item_unit" placeholder="00.0"
                                                autocomplete="given-name"
                                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            <span class=" m-0 p-0 text-xs float-left text-gray-400"><span
                                                    class="unit">unit</span>/<span
                                                    class="addedItemUnit">LNFT</span></span>
                                        </div>
                                        <div>
                                            <input type="number" name="item_unit_by_assembly_unit[]"
                                                id="item_unit_by_assembly_unit" placeholder="00.0"
                                                autocomplete="given-name"
                                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            <span class=" m-0 p-0 text-xs float-left text-gray-400"><span
                                                    class="addedItemUnit">LNFT</span>/<span
                                                    class="unit">unit</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" text-right mt-2">
                                <button type="button"
                                    class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                                    id="addbtn" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Item Description </label>
                            <textarea name="item_description" id="item_description" placeholder="Description"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4"
                                onclick="voice('description-mic', 'item_description')"><i
                                    class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Note </label>
                            <textarea name="item_note" id="item_note" placeholder="Description"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4"
                                onclick="voice('note-mic', 'item_note')"><i
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
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addTemplate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateItemTemplate" method="post" enctype="multipart/form-data"
                id="itemTemplatesForm">
                @csrf
                <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="est_template_id" id="estimate_template_id">
                <input type="hidden" name="est_template_name" id="estimate_template_name">
                {{-- <input type="hidden" name="is_upgrade" id="is_upgrade" value=""> --}}
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="itemTemplate-title"></h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-12 gap-2">
                        <div id="template-items" class=" col-span-12">

                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Item Description </label>
                            <textarea name="estimate_template_description" id="estimate_template_description" placeholder="Description"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4"
                                onclick="voice('description-mic', 'estimate_template_description')"><i
                                    class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Note </label>
                            <textarea name="estimate_template_note" id="estimate_template_note" placeholder="Description"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4"
                                onclick="voice('note-mic', 'estimate_template_note')"><i
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
    $(document).ready(function() {
        var type = $('#type');
        // Get references to the relevant elements
        var selectedItemDropdown = $('#selected_item');
        var typeDropdown = $('#type');
        var itemNameInput = $('#itemName');
        var itemUnitsInput = $('#item_units');
        var labourExpenseDiv = $('#labourExpense');
        var materialExpenseDiv = $('#materialExpense');
        var labourExpense = $('#labour_expense');
        var materialExpense = $('#material_expense');
        var itemCost = $('#item_cost');
        var itemPrice = $('#item_price');
        var itemId = $('#item_id');
        var assemblyName = $('#assembly_name');
        var assByItem = $('#assembly_unit_by_item_unit');
        var itemByAss = $('#item_unit_by_assembly_unit');
        var isUpgrade = $('#is_upgrade');

        // Add a change event listener to the selected_item dropdown
        selectedItemDropdown.on('change', function() {
            // Get the selected item value
            var selectedItem = selectedItemDropdown.val();
            if (selectedItem == 'upgrades') {

                typeDropdown.val('upgrades');
                isUpgrade.val('yes');
                type.trigger('change');

            } else {
                isUpgrade.val('');
                $.ajax({
                    url: '/getItemData/' + selectedItem, // Use the correct URL with the item ID
                    type: 'GET',
                    success: function(data) {
                        var itemData = data.item;
                        var assemblyItemData = data.assembly_items;

                        // Update the other input fields based on the item data
                        typeDropdown.val(itemData.item_type);
                        itemNameInput.val(itemData.item_name);
                        itemUnitsInput.val(itemData.item_units);
                        labourExpense.val(itemData.labour_expense);
                        materialExpense.val(itemData.material_expense);
                        itemCost.val(itemData.item_cost);
                        itemPrice.val(itemData.item_price);
                        itemId.val(itemData.item_id);
                        console.log(assemblyItemData);
                        // assemblyName.val(assemblyItemData.assembly_name);
                        // assByItem.val(assemblyItemData.item_unit_by_ass_unit);
                        // itemByAss.val(assemblyItemData.ass_unit_by_item_unit);
                        type.trigger('change');




                        let mulitple_input = $('#mulitple_input');
                        mulitple_input.html('');
                        $.each(assemblyItemData, function(index, itemData) {
                            let id = Math.floor(Math.random() * 999 + 1);
                            console.log(itemData.assembly_name);
                            let newele = $('<div class="mt-5" id="ele' + id + '"></div>');
                            let delbtn = $('<span></span>');
                            // ============
                            newele.html(`
                                <select name="assembly_name[]" id="" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <option value="">Select Item</option>
                                    <option selected value="${itemData.assembly_name}" data-unit="{{ $item->item_units }}">${itemData.assembly_name}</option>
                                    @foreach ($itemsForAssemblies as $item)
                                    <option value="{{ $item->item_name }}"  data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                                <div class=" grid grid-cols-2 gap-3 mt-2 inline-block">
                                    <div>
                                        <input value="${itemData.item_unit_by_ass_unit}" type="number" name="assembly_unit_by_item_unit[]" id="assembly_unit_by_item_unit" placeholder="00.0" autocomplete="given-name"
                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                                    </div>
                                    <div class="flex ">
                    <div class="w-[80%]  ">
                    <input  value="${itemData.ass_unit_by_item_unit}"  type="number" name="item_unit_by_assembly_unit[]" id="item_unit_by_assembly_unit" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">LNFT</span>/<span class="unit">unit</span></span>
                  </div>
                   <div class="mt-1" >
                    <button   type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                                <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                            </button>
                    </div>
                </div>
                                </div>
                            `);
                            $(document).on('click', `#ele${id} button`, function() {
        reminputs(`#ele${id}`);
    });


                            mulitple_input.append(newele);
                            newele.append(delbtn);
                            delbtn.on('click', function() {
                                newele.remove();
                            });
                            // ============

                        });

                        function reminputs(e) {
    let ele = document.querySelector(e);
    if (ele) {
        ele.remove();
    }
}


                        // Show/hide expense fields based on the selected item type
                        // if (itemData.type === 'labour') {
                        //     labourExpenseDiv.removeClass('hidden');
                        //     materialExpenseDiv.addClass('hidden');
                        // } else if (itemData.type === 'material') {
                        //     labourExpenseDiv.addClass('hidden');
                        //     materialExpenseDiv.removeClass('hidden');
                        // } else {
                        //     // Handle other item types if needed
                        //     labourExpenseDiv.addClass('hidden');
                        //     materialExpenseDiv.addClass('hidden');
                        // }
                    },
                    error: function(error) {
                        console.error('Error fetching item data:', error);
                    }
                });
            }
            // Check if a valid item is selected
            // if (selectedItem) {
            //     // Your AJAX request to fetch item data based on the selected item

            // }
        });


        type.on('change', function() {
            var typeDropdown = $('#type');
            var multiAddItemsDiv = $('#multiAdd-items');
            var labourExpenseDiv = $('#labourExpense');
            var materialExpenseDiv = $('#materialExpense');
            var unitItemInput = $('#item_units');
            var unitLabel = $('.unit');
            var itemCost = $('#item_cost');
            var labourCost = $('#labour_expense');
            var materialCost = $('#material_expense');
            var itemPrice = $('#item_price');
            var itemqty = $('#item_qty');
            var itemTotal = $('#item_total');
            var priceMargin = $('#price_margin')
            var item_main = $('#item_main')
            if (type.val() === 'assemblies' || type.val() === 'upgrades') {
                multiAddItemsDiv.removeClass('hidden');
                item_main.addClass('hidden');
                labourExpenseDiv.addClass('hidden');

            } else {
                multiAddItemsDiv.addClass('hidden');
                labourExpenseDiv.removeClass('hidden');
            }

            if (type.val() === 'material') {
                materialExpenseDiv.removeClass('hidden');
                labourExpenseDiv.addClass('hidden');
            } else {
                materialExpenseDiv.addClass('hidden');
                labourExpenseDiv.removeClass('hidden');
            }

            if (type.val() === 'labour') {
                unitItemInput.val('hour');
                unitLabel.text('hour');
            } else {
                unitItemInput.val(null);
                unitLabel.text('unit');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Get references to the select element and the relevant divs
        var typeDropdown = $('#type');
        var multiAddItemsDiv = $('#multiAdd-items');
        var labourExpenseDiv = $('#labourExpense');
        var materialExpenseDiv = $('#materialExpense');
        var unitItemInput = $('#item_units');
        var unitLabel = $('.unit');
        var itemCost = $('#item_cost');
        var labourCost = $('#labour_expense');
        var materialCost = $('#material_expense');
        var itemPrice = $('#item_price');
        var itemqty = $('#item_qty');
        var itemTotal = $('#item_total');
        var priceMargin = $('#price_margin')
        // Initial state on page load
        if (typeDropdown.val() === 'assemblies') {
            multiAddItemsDiv.removeClass('hidden');
            labourExpenseDiv.addClass('hidden');
        }

        // Add change event handler to the select element
        typeDropdown.on('change', function() {
            if (typeDropdown.val() === 'assemblies' || typeDropdown.val() === 'upgrades') {
                multiAddItemsDiv.removeClass('hidden');
                labourExpenseDiv.addClass('hidden');
            } else {
                multiAddItemsDiv.addClass('hidden');
                labourExpenseDiv.removeClass('hidden');
            }

            if (typeDropdown.val() === 'material') {
                materialExpenseDiv.removeClass('hidden');
                labourExpenseDiv.addClass('hidden');
            } else {
                materialExpenseDiv.addClass('hidden');
                labourExpenseDiv.removeClass('hidden');
            }

            if (typeDropdown.val() === 'labour') {
                unitItemInput.val('hour');
                unitLabel.text('hour');
            } else {
                unitItemInput.val(null);
                unitLabel.text('unit');
            }

        });

        unitItemInput.on('input', function() {
            unitLabel.text(unitItemInput.val());
        });

        labourCost.on('input', function() {
            itemCost.val(25 / 60 * labourCost.val());
        });

        materialCost.on('input', function() {
            itemCost.val(materialCost.val());
        });


        itemPrice.on('input', function() {
            var priceMinusCost = itemPrice.val() - itemCost.val();
            var priceMinusCostbyitemPrice = priceMinusCost / itemPrice.val();
            var finalMargin = priceMinusCostbyitemPrice * 100;
            priceMargin.text(finalMargin.toFixed(2));
        });

        itemqty.on('input', function() {
            itemTotal.val(itemqty.val() * itemPrice.val());
        });
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
        // $("#formData")[0].reset()
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
    $('[id^="editEstimate-template"]').click(function() {
        var itemId = this.id.replace('editEstimate-template', '');
        $.ajax({
            url: '/getEstItemTemplateToEdit/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var itemTemplate = response.data.estimate_template;
                    var itemTemplateItems = response.data.estimate_item_template_items;
                    var itemsData = response.data.item_data;

                    for (var i = 0; i < itemTemplateItems.length; i++) {
                        var currentItem = itemTemplateItems[i];

                        // Find the corresponding item data based on item_id
                        var correspondingItemData = itemsData.find(item => item.item_id ===
                            currentItem.item_id);

                        // Assuming currentItem has properties 'name' and 'quantity'
                        var itemNameInput = $('#template_item_name');
                        // var itemQtyInput = $('#template_item_qty');
                        var itemTemplateTitle = $('#itemTemplate-title');
                        itemTemplateTitle.text(itemTemplate.item_template_name)
                        $('#estimate_template_description').val(itemTemplate.description);
                        $('#estimate_template_note').val(itemTemplate.note);
                        // Update input values with currentItem and item data
                        var estimateTemplateId = $('#estimate_template_id');
                        var estimateTemplateName = $('#estimate_template_name');
                        estimateTemplateId.val(itemTemplate.est_template_id);
                        estimateTemplateName.val(itemTemplate.item_template_name);
                        var demoInput = $('<div>').html(`
                            <input type="hidden" name="est_template_item_id[]" id="est_template_item_id" placeholder="Item Name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <div class="my-0 flex items-center gap-2 text-left">
                                <div class="relative text-left my-1">
                                    <button type="button"
                                        class="bg-[#930027] py-[6px] px-2 rounded-md text-white">
                                        <div id="cal-menubutton" class=" cursor-pointer" aria-expanded="true"
                                            aria-haspopup="true">
                                            {{-- <img id="calculater-modal"  class="" src="{{ asset('assets/icons/calculator-icon.svg') }}"
                                            alt="icon"> --}}
                                            <i id="calculater-modal" class="fa-solid fa-calculator"></i>
                                        </div>
                                    </button>
                                    {{-- ====================== --}}
                                    <div class="absolute hidden  text-left h-[100%]  z-[999] " <div id="cal-menu"
                                        style="background-color:#3a4655 !important;"
                                        class=" topbar-manuLeaving   z-10 mt-2 w-56 origin-top-right rounded-md bg-[#3a4655] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        tabindex="-1">
                                        <div class="py-1 left-5" role="none">
                                            <div class="relative  bg-[#3a4655]">
                                                <input
                                                    class="block mx-2 mt-2 border bg-[#3a4655] h-[30px] rounded text-white border-white "
                                                    type="text" readonly id="cal_display">
                                                <div class="grid text-white grid-cols-4 gap-y-3  p-2 mt-3">
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">%</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">/</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px] ">
                                                        << /button>
                                                            <button id="clear_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">C</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">7</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">8</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">9</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">*</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">4</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">5</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">6</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">-</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">1</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">2</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">3</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">+</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">0</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">00</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">.</button>
                                                            <button id="equal_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">=</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="number" name="template_item_qty[]" id="template_item_qty" placeholder="" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <p id="template_item_name" class=" font-medium overflow-hidden whitespace-nowrap items-center bg-[#EBEAEB] py-1 px-2 rounded-lg w-[75%]"></p>
                            </div>
                            `);
                        var itemNameInput = demoInput.find('#template_item_name');
                        var itemQtyInput = demoInput.find('#template_item_qty');
                        var itemIdInput = demoInput.find('#est_template_item_id');

                        itemNameInput.attr('id', 'template_item_name_' + i);
                        itemQtyInput.attr('id', 'template_item_qty_' + i);
                        itemIdInput.attr('id', 'est_template_item_id_' + i);
                        var templateItemDiv = $('#template-items');

                        // demoInput.addClass('flex justify-start');

                        templateItemDiv.append(demoInput);

                        $('#template_item_name_' + i).text(correspondingItemData.item_name +
                            correspondingItemData.item_description + correspondingItemData
                            .item_note);
                        $('#est_template_item_id_' + i).val(currentItem.est_template_item_id);
                        itemQtyInput.val(currentItem.item_qty);
                        $('#itemTemplatesForm').attr('action', '/updateEstimateItemTemplate');
                        // console.log(itemTemplateItems.length)

                        $('#addTemplate-modal').removeClass('hidden');
                    }
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });
</script>
<script>
    $('[id^="addTemplate"]').click(function() {
        var itemId = this.id.replace('addTemplate', '');
        $.ajax({
            url: '/getItemTemplateItems/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var itemTemplate = response.data.item_template;
                    var itemTemplateItems = response.data.item_template_items;
                    var itemsData = response.data.items_data;

                    for (var i = 0; i < itemTemplateItems.length; i++) {
                        var currentItem = itemTemplateItems[i];

                        // Find the corresponding item data based on item_id
                        var correspondingItemData = itemsData.find(item => item.item_id ===
                            currentItem.item_id);

                        // Assuming currentItem has properties 'name' and 'quantity'
                        var itemNameInput = $('#template_item_name');
                        // var itemQtyInput = $('#template_item_qty');
                        var itemTemplateTitle = $('#itemTemplate-title');
                        itemTemplateTitle.text(itemTemplate.item_template_name)
                        // Update input values with currentItem and item data
                        var estimateTemplateId = $('#estimate_template_id');
                        var estimateTemplateName = $('#estimate_template_name');
                        $('#estimate_template_description').val(itemTemplate.description);
                        $('#estimate_template_note').val(itemTemplate.note);
                        estimateTemplateId.val(itemTemplate.item_template_id);
                        estimateTemplateName.val(itemTemplate.item_template_name);
                        var demoInput = $('<div>').html(`
                            <input type="hidden" name="template_item_id[]" id="template_item_id" placeholder="Item Name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <div class="my-0 flex items-center gap-2 text-left">
                                <div class="relative text-left my-1">
                                    <button type="button"
                                        class="bg-[#930027] py-[6px] px-2 rounded-md text-white">
                                        <div id="cal-menubutton" class=" cursor-pointer" aria-expanded="true"
                                            aria-haspopup="true">
                                            {{-- <img id="calculater-modal"  class="" src="{{ asset('assets/icons/calculator-icon.svg') }}"
                                            alt="icon"> --}}
                                            <i id="calculater-modal" class="fa-solid fa-calculator"></i>
                                        </div>
                                    </button>
                                    {{-- ====================== --}}
                                    <div class="absolute hidden  text-left h-[100%]  z-[999] " <div id="cal-menu"
                                        style="background-color:#3a4655 !important;"
                                        class=" topbar-manuLeaving   z-10 mt-2 w-56 origin-top-right rounded-md bg-[#3a4655] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        tabindex="-1">
                                        <div class="py-1 left-5" role="none">
                                            <div class="relative  bg-[#3a4655]">
                                                <input
                                                    class="block mx-2 mt-2 border bg-[#3a4655] h-[30px] rounded text-white border-white "
                                                    type="text" readonly id="cal_display">
                                                <div class="grid text-white grid-cols-4 gap-y-3  p-2 mt-3">
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">%</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px]">/</button>
                                                    <button type="button"
                                                        class="cal_btn border rounded text-center mx-1  h-[30px] ">
                                                        << /button>
                                                            <button id="clear_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">C</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">7</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">8</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">9</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">*</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">4</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">5</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">6</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">-</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">1</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">2</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">3</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">+</button>

                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">0</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px]">00</button>
                                                            <button type="button"
                                                                class="cal_btn border rounded text-center mx-1  h-[30px] ">.</button>
                                                            <button id="equal_btn" type="button"
                                                                class=" border rounded text-center mx-1  h-[30px] ">=</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="number" name="template_item_qty[]" id="template_item_qty" placeholder="" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <p id="template_item_name" class=" font-medium overflow-hidden whitespace-nowrap items-center bg-[#EBEAEB] py-1 px-2 rounded-lg w-[75%]"></p>
                            </div>
                            `);
                        var itemNameInput = demoInput.find('#template_item_name');
                        var itemQtyInput = demoInput.find('#template_item_qty');
                        var itemIdInput = demoInput.find('#template_item_id');

                        itemNameInput.attr('id', 'template_item_name_' + i);
                        itemQtyInput.attr('id', 'template_item_qty_' + i);
                        itemIdInput.attr('id', 'template_item_id_' + i);
                        var templateItemDiv = $('#template-items');

                        // demoInput.addClass('flex justify-between');

                        templateItemDiv.append(demoInput);

                        $('#template_item_name_' + i).text(correspondingItemData.item_name +
                            correspondingItemData.item_description + correspondingItemData
                            .item_note);
                        $('#template_item_id_' + i).val(correspondingItemData.item_id);
                        $('#template_item_qty_' + i).val(currentItem.item_qty);
                        // console.log(itemTemplateItems.length)
                        // itemQtyInput.val(currentItem.quantity);

                        $('#addTemplate-modal').removeClass('hidden');
                    }
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });
</script>
<script>
    $('[id^="editEstimateTemplate-item"]').click(function() {
        var itemId = this.id.replace('editEstimateTemplate-item', ''); // Extract item ID from button ID

        // Make an AJAX request to get item details
        $.ajax({
            url: '/getEstimateTemplateItem' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    // Populate the modal with the retrieved data
                    var itemDetail = response.data.item_detail;
                    var templateItem = response.data.template_item;

                    // Update modal content with item details
                    $('#type').val(itemDetail.item_type);
                    $('#itemName').val(itemDetail.item_name);
                    $('#item_units').val(itemDetail.item_units);
                    $('#labour_expense').val(templateItem.labour_expense);
                    $('#material_expense').val(templateItem.material_expense);
                    $('#item_cost').val(templateItem.item_cost);
                    $('#item_price').val(templateItem.item_price);
                    $('#item_qty').val(templateItem.item_qty);
                    $('#item_total').val(templateItem.item_total);
                    $('#item_description').val(templateItem.item_description);
                    $('#item_note').val(templateItem.item_note);
                    // Add other fields as needed

                    // Set the item ID in the hidden input field
                    $('#item_id').val(templateItem.est_template_item_id);
                    var formUrl = $('#itemsForm').attr('action', '/updateEstimateTemplateItem');
                    // Open the modal
                    $('#addItems-modal').removeClass('hidden');
                } else {
                    // Handle error response
                    console.error('Error fetching item details.');
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });

    // Add a click event listener to the edit buttons
    $('[id^="editEstimate-item"]').click(function() {
        var itemId = this.id.replace('editEstimate-item', ''); // Extract item ID from button ID

        // Make an AJAX request to get item details
        $.ajax({
            url: '/getEstimateItem' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    // Populate the modal with the retrieved data
                    var itemDetail = response.item_detail;

                    // Update modal content with item details
                    $('#type').val(itemDetail.item_type);
                    $('#itemName').val(itemDetail.item_name);
                    $('#item_units').val(itemDetail.item_units);
                    $('#labour_expense').val(itemDetail.labour_expense);
                    $('#item_cost').val(itemDetail.item_cost);
                    $('#item_price').val(itemDetail.item_price);
                    $('#item_qty').val(itemDetail.item_qty);
                    $('#item_total').val(itemDetail.item_total);
                    $('#item_description').val(itemDetail.item_description);
                    $('#note').val(itemDetail.item_note);
                    // Add other fields as needed

                    // Set the item ID in the hidden input field
                    $('#item_id').val(itemDetail.estimate_item_id);
                    var formUrl = $('#itemsForm').attr('action', '/updateEstimateItem');
                    // Open the modal
                    $('#addItems-modal').removeClass('hidden');
                } else {
                    // Handle error response
                    console.error('Error fetching item details.');
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });
</script>
<script>
    $("#calculater-modal").click(function(e) {
        e.preventDefault();
        $("#cal-modal").removeClass('hidden');
    });


    $(".addItems").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addItems-modal").addClass('hidden');
        // $("#formData")[0].reset()
    });
    $("#addTemplate").click(function(e) {
        e.preventDefault();
        $("#addTemplate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addTemplate-modal").addClass('hidden');
        // $("#itemTemplatesForm")[0].reset()
        $('#template-items').empty();
    });
    $('#mulitple_input').on('change', 'select[name="assembly_name[]"]', function() {
        // Get the selected option
        var selectedOption = $(this).find(':selected');

        // Get the item_unit from the data-unit attribute
        var itemUnit = selectedOption.data('unit');

        // Update the elements based on the item_unit only within the current row
        var unitLabel = $(this).closest('.grid').find('.addedItemUnit');
        unitLabel.text(itemUnit);

        // You can add more logic here to update other elements based on the item_unit
    });

    let mulitple_input = $('#mulitple_input');
    let button = $('#addbtn');

    button.on('click', function() {
        let iid = Math.floor(Math.random() * 999 + 1);
        let newele = $('<div class="mt-5" id="rendid' + iid + '" ></div>');
        let rembtn = $('<span></span>');

        newele.html(`
            <select name="assembly_name[]" id="" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                <option value="">Select Item</option>
                @foreach ($itemsForAssemblies as $item)
                <option value="{{ $item->item_name }}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
            <div class=" grid grid-cols-2 gap-3 mt-2 inline-block">
                <div>
                    <input type="number" name="assembly_unit_by_item_unit[]" id="assembly_unit_by_item_unit" placeholder="00.0" autocomplete="given-name"
                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                </div>
                <div class="flex ">
                    <div class="w-[80%]  ">
                    <input type="number" name="item_unit_by_assembly_unit[]" id="item_unit_by_assembly_unit" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">LNFT</span>/<span class="unit">unit</span></span>
                  </div>
                   <div class="mt-1" >
                    <button onclick="remveinputs('#rendid${iid}')"  type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                                <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                            </button>
                    </div>
                </div>
            </div>
        `);

        mulitple_input.append(newele);
        newele.append(rembtn);


    });
    function remveinputs(e) {
        let ele = document.querySelector(e);
        if (ele) {
            ele.remove();
        }
    }

    $("#cal-menubutton").click(function(e) {
        e.stopPropagation(); // Prevents the click event from reaching the document body
        $('#cal-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
    });

    $(document).on('click', function(e) {
        if (!$("#cal-menubutton").is(e.target) && !$('#cal-menu').has(e.target).length) {
            // Click occurred outside the button and dropdown, hide the dropdown
            $('#cal-menu').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
        }
    });

    let cbuttons = document.querySelectorAll('.cal_btn');
    let display = document.querySelector('#cal_display');
    let equalButton = document.querySelector('#equal_btn');
    let clearbtn = document.querySelector('#clear_btn');

    cbuttons.forEach(button => {
        button.addEventListener('click', () => {
            display.value += button.innerHTML;
        });
    });

    equalButton.addEventListener('click', () => {
        try {
            display.value = eval(display.value);
            item_qty.value = display.value;
            var inputEvent = new Event('input');
            item_qty.dispatchEvent(inputEvent);

        } catch (error) {
            display.value = 'Error';
        }
    });
    clearbtn.addEventListener('click', () => {
        display.value = '';
    });
</script>
