@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
$remainingEstimateTotal = $estimate->discounted_total != null ? $estimate->discounted_total - $estimate->invoice_paid_total : ($estimate->estimate_total - $estimate->invoice_paid_total);


$estimateTotal = $estimate->estimate_total;
$percentageDiscount = $estimate->percentage_discount;
$priceDiscount = $estimate->price_discount;

if ($percentageDiscount) {
$discountedTotal = $estimateTotal - ($estimateTotal * ($percentageDiscount / 100));
} elseif($priceDiscount) {
$discountedTotal = $estimateTotal - $priceDiscount;
}else{
$discountedTotal = null;
}

$modalTotal = 0;

@endphp
<input type="hidden" id="hasPendingProposal" value="{{ $estimate->proposals->where('proposal_status', 'pending')->isNotEmpty() }}">

<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-transparent w-full">
        <div class=" mb-5 shadow-lg bg-white text-white  rounded-3xl">
            <div class="  flex gap-x-1 items-center p-1  bg-[#930027] rounded-t-3xl">
                <button type="button" class="flex" id="editEstimateButton{{$estimate->estimate_id}}">
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
                            <a href="/viewCustomerDetails/{{ $estimate->customer->customer_id }}" class="hover:text-[#F5222D]">
                                {{ ucfirst($estimate->customer->customer_first_name) }} {{ ucfirst($estimate->customer->customer_last_name) }}
                            </a>
                        </p>
                        <p class="text-[#323C47] text-lg font-semibold">
                            {{ $estimate->customer->customer_project_name }}
                        </p>
                        <p class="mt-2 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                            <a href="https://maps.google.com/?q={{$estimate->customer_address}}" target="_blank" class=" text-[#930027]">
                                <span class="pl-2">{{ $estimate->customer_address }}</span>
                            </a>
                            {{-- $estimate->customer->customer_primary_address --}}
                        </p>
                        @if (!$estimate->billing_address == null)
                             <p class="mt-2 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/billing_address.svg') }}" class="w-5"  alt="">
                            <a href="https://maps.google.com/?q={{$estimate->customer->billing_address}}, {{ $estimate->customer->billing_city }}, {{ $estimate->customer->billing_state }}, {{ $estimate->customer->billing_zip }}" target="_blank" class=" text-[#930027]">
                                <span class="pl-2">Billing Address: {{$estimate->customer->billing_address}}, {{ $estimate->customer->billing_city }}, {{ $estimate->customer->billing_state }}, {{ $estimate->customer->billing_zip }}</span>
                            </a>
                        </p>
                        @endif

                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/mail-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $estimate->customer->customer_email }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47]  font-medium">
                            <img src="{{ asset('assets/icons/tel-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $estimate->customer_phone }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Project Owner: {{ $estimate->project_owner }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Branch: {{ $estimate->customer->branch }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Project Type: {{ $estimate->project_type }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Building Type: {{ $estimate->building_type }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Internal Note: {{ $estimate->estimate_internal_note ?? $estimate->customer->company_internal_note }}
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
                        <span class="pl-2 flex">{{ $estimate->customer->owner }} Assigned To Schedule Estimate On <span class="pl-2 text-[#31A613] flex">
                                <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}" alt="">
                                {{ $estimate->customer->created_at }}</span>
                        </span>
                        </p> --}}
                    </div>
                    <div class=" col-span-2 p-3 text-left sm:text-right md:text-right lg:text-right">
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
                            {{ date('m/d/y', strtotime($estimate->created_at)) }}
                        </p>
                        <p class="mt-1 text-red-900">
                            Total: ${{ number_format($estimate->estimate_total, 2) }}
                        </p>
                        @if($estimate->estimate_total != null)
                        @if($estimate->percentage_discount != null || $estimate->price_discount != null)
                        <p class="mt-1 text-red-900">
                            Discount: {{ $estimate->percentage_discount ? $estimate->percentage_discount . '%' : '$' . number_format($estimate->price_discount, 2) }}
                        </p>
                        <p class="mt-1 text-red-900">
                            Discounted Total: {{ number_format($estimate->discounted_total, 2) }}
                        </p>
                        @endif
                        @endif
                        <p class="flex justify-start sm:lg:justify-end md:justify-end lg:justify-end xl:justify-end text-blue-900">
                            Invoiced: ${{ number_format($estimate->invoiced_payment, 2) }}
                        </p>
                        <p class="flex justify-start sm:lg:justify-end md:justify-end lg:justify-end xl:justify-end text-green-900">
                            Paid: ${{ number_format($estimate->invoice_paid_total, 2) }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
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
            <div class="relative overflow-x-auto py-2">
                <div class="itemDiv">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Notes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estimate->notes as $note)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    {{ $note->estimate_note }}
                                </td>
                                <td class="px-6 py-4">
                                    <button id="edit-note-modal{{ $note->estimate_note_id }}">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                    </button>
                                    <form action="/deleteEstimateNote{{ $note->estimate_note_id }}" class="" method="post">
                                        @csrf
                                        <button type="submit" class="">
                                            <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addNote-modal{{ $note->estimate_note_id }}">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                    </div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="/editEstimateNote" method="post" id="addNote-form{{ $note->estimate_note_id }}">
                                            @csrf
                                            <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                                            <input type="hidden" value="{{ $note->estimate_note_id }}" name="note_id" id="note_id">
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
                                                        <textarea name="estimate_note" id="estimate_note" placeholder="Add Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $note->estimate_note }}">{{ $note->estimate_note }}</textarea>
                                                        <button type="button" id="items-mic" class=" absolute mt-8 right-8" onclick="voice('note-mic', 'estimate_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                    </div>
                                                </div>
                                                <div class=" border-t">
                                                    <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                                                    <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                        <div class=" text-center hidden spinner" id="spinner">
                                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                            </svg>
                                                        </div>
                                                        <div class="text" id="text">
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("edit-note-modal{{ $note->estimate_note_id }}").addEventListener("click", function(e) {
                                    e.preventDefault();
                                    document.getElementById("addNote-modal{{ $note->estimate_note_id }}").classList.remove('hidden');
                                });

                                document.querySelectorAll(".modal-close").forEach(function(element) {
                                    element.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("addNote-modal{{ $note->estimate_note_id }}").classList.add('hidden');
                                        document.getElementById("addNote-form{{ $note->estimate_note_id }}").reset();
                                    });
                                });
                            </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
            <div class="relative overflow-x-auto py-2">
                <div class="itemDiv">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Notes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estimate->notes as $note)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    {{ $note->estimate_note }}
                                </td>
                                <td class="px-6 py-4">
                                    <button id="edit-note-modal{{ $note->estimate_note_id }}">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                    </button>
                                    <form action="/deleteEstimateNote{{ $note->estimate_note_id }}" class="" method="post">
                                        @csrf
                                        <button type="submit" class="">
                                            <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addNote-modal{{ $note->estimate_note_id }}">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                    </div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="/editEstimateNote" method="post" id="addNote-form{{ $note->estimate_note_id }}">
                                            @csrf
                                            <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                                            <input type="hidden" value="{{ $note->estimate_note_id }}" name="note_id" id="note_id">
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
                                                        <textarea name="estimate_note" id="estimate_note" placeholder="Add Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $note->estimate_note }}">{{ $note->estimate_note }}</textarea>
                                                        <button type="button" id="items-mic" class=" absolute mt-8 right-8" onclick="voice('note-mic', 'estimate_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                    </div>
                                                </div>
                                                <div class=" border-t">
                                                    <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                                                    <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                        <div class=" text-center hidden spinner" id="spinner">
                                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                            </svg>
                                                        </div>
                                                        <div class="text" id="text">
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("edit-note-modal{{ $note->estimate_note_id }}").addEventListener("click", function(e) {
                                    e.preventDefault();
                                    document.getElementById("addNote-modal{{ $note->estimate_note_id }}").classList.remove('hidden');
                                });

                                document.querySelectorAll(".modal-close").forEach(function(element) {
                                    element.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("addNote-modal{{ $note->estimate_note_id }}").classList.add('hidden');
                                        document.getElementById("addNote-form{{ $note->estimate_note_id }}").reset();
                                    });
                                });
                            </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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
                                    <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                        Title
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                        Name
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                        email
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estimate->estimateContacts as $contacts)
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
                                        <button id="edit-Con-modal{{ $contacts->contact_id }}">
                                            <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                        </button>
                                        <button>
                                            <form action="/delete/additionalContact/{{ $contacts->contact_id }}" method="post">
                                                @csrf
                                                <button>
                                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                                </button>
                                            </form>
                                        </button>
                                    </td>
                                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="edit_contact_modal{{ $contacts->contact_id }}">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Background overlay -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                            </div>

                                            <!-- Modal panel -->
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <form action="/updateAdditionalContact" method="post" id="editContact-form">
                                                    @csrf
                                                    <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                                                    <input type="hidden" name="contact_id" value="{{ $contacts->contact_id }}">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <!-- Modal content here -->
                                                        <div class=" flex justify-between border-b">
                                                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Contacts</h2>
                                                            <button class="modal-close{{ $contacts->contact_id }}" type="button">
                                                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                            </button>
                                                        </div>
                                                        <!-- task details -->
                                                        <div class=" grid grid-cols-2 gap-2">
                                                            <div class=" col-span-2" id="">
                                                                <label for="" class=" block">Title:</label>
                                                                <input value="{{ $contacts->contact_title }}" type="text" name="contact_title" id="contact_title" required placeholder="Contact title" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">First
                                                                    Name:</label>
                                                                <input value="{{ $contacts->contact_first_name }}" type="text" name="first_name" id="first_name" required placeholder="First Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Last
                                                                    Name:</label>
                                                                <input value="{{ $contacts->contact_last_name }}" type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Email:</label>
                                                                <input value="{{ $contacts->contact_email }}" type="text" name="email" id="email" required placeholder="Email" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Phone:</label>
                                                                <input value="{{ $contacts->contact_phone }}" type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX/XXXXXXXXXX" required autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                        </div>
                                                        <div class=" border-t">
                                                            <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                                                            <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                                <div class=" text-center hidden spinner" id="spinner">
                                                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                                    </svg>
                                                                </div>
                                                                <div class="text" id="text">
                                                                    Save
                                                                </div>
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
                                @foreach ($estimate->estimateContacts as $contacts)
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
                                        <button id="edit-Con-modal{{ $contacts->contact_id }}">
                                            <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                        </button>
                                        <button>
                                            <form action="/delete/additionalContact/{{ $contacts->contact_id }}" method="post">
                                                @csrf
                                                <button>
                                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                                </button>
                                            </form>
                                        </button>
                                    </td>
                                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="edit_contact_modal{{ $contacts->contact_id }}">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Background overlay -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                            </div>

                                            <!-- Modal panel -->
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <form action="/updateAdditionalContact" method="post" id="editContact-form">
                                                    @csrf
                                                    <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                                                    <input type="hidden" name="contact_id" value="{{ $contacts->contact_id }}">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <!-- Modal content here -->
                                                        <div class=" flex justify-between border-b">
                                                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Contacts</h2>
                                                            <button class="modal-close{{ $contacts->contact_id }}" type="button">
                                                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                            </button>
                                                        </div>
                                                        <!-- task details -->
                                                        <div class=" grid grid-cols-2 gap-2">
                                                            <div class=" col-span-2" id="">
                                                                <label for="" class=" block">Title:</label>
                                                                <input value="{{ $contacts->contact_title }}" type="text" name="contact_title" id="contact_title" required placeholder="Contact title" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">First
                                                                    Name:</label>
                                                                <input value="{{ $contacts->contact_first_name }}" type="text" name="first_name" id="first_name" required placeholder="First Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Last
                                                                    Name:</label>
                                                                <input value="{{ $contacts->contact_last_name }}" type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Email:</label>
                                                                <input value="{{ $contacts->contact_email }}" type="text" name="email" id="email" required placeholder="Email" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                            <div class="" id="">
                                                                <label for="" class=" block">Phone:</label>
                                                                <input value="{{ $contacts->contact_phone }}" type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX/XXXXXXXXXX" required autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div>
                                                        </div>
                                                        <div class=" border-t">
                                                            <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                                                            <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                                <div class=" text-center hidden spinner" id="spinner">
                                                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                                    </svg>
                                                                </div>
                                                                <div class="text" id="text">
                                                                    Save
                                                                </div>
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
        <div class=" border-2  shadow-lg mt-7     bg-white rounded-3xl">
            <div class="">
                <div class=" px-3  bg-[#930027] rounded-t-3xl">
                    <p class="text-lg py-3 pl-3  text-white  font-medium">
                        Actions
                    </p>
                </div>
                <div class=" px-3 ">
                    <div class="my-auto py-4 flex flex-wrap gap-1 p-2">
                        @if ($estimate->schedule_assigned == 1 && $estimate->work_assigned != 1)
                        <a href="/getEstimateToSetScheduleWork{{ $estimate->estimate_id }}">
                            <button type="button" id="schedule-estimate" class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                                <span class=" my-auto">Schedule Work</span>
                            </button>
                        </a>
                        @endif
                        @if ($estimate->work_assigned == 1 && $estimate->invoice_assigned != 1)
                        <button type="button" id="complete-work" class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                            <span class=" my-auto">Complete Work</span>
                        </button>
                        @endif
                        @if ($estimate->invoice_assigned == 1 && $estimate->payment_assigned != 1)
                        <button type="button" id="complete-invoice" class=" flex h-[40px] w-[190px] p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                            <span class=" my-auto">Complete Invoice</span>
                        </button>
                        @endif
                        @if ($estimate->payment_assigned == 1 && $estimate->invoice_paid != 1)
                        <button type="button" id="add-payment" class=" complete-payment flex h-[40px] w-[190px] ml-2 p-2 py-auto text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <div class=" flex mx-auto">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto">Add Payment</span>
                            </div>
                        </button>
                        @endif
                        @if ($estimate->invoice_paid == 1 && $estimate->estimate_status != 'complete')
                        <form action="/completeProject" method="post">
                            @csrf
                            <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                            <button id="" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <div class=" flex mx-auto">
                                    <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                    <span class=" my-auto">Complete Project</span>
                                </div>
                            </button>
                        </form>
                        @endif
                        @if ($estimate->estimate_assigned == 1 && $estimate->schedule_assigned != 1 && $estimate->estimate_total != null)
                        <button type="button" id="accept-estimate" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <div class=" flex mx-auto">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto">Accept Work</span>
                            </div>
                        </button>
                        <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-8 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]" id="reassign-estimate-button{{$estimate->estimate_id}}">
                            <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/userRole-icon.svg') }}" alt="">
                            <span class=" my-auto">Reassign</span>
                        </button>
                        @endif
                        @if ($estimate->estimate_schedule_assigned != 1)
                        <a href="/getEstimateToSetSchedule{{ $estimate->estimate_id }}">
                            <button type="button" id="schedule-estimate" class=" schedule-estimate flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/calendar-icon.svg') }}" alt="">
                                <span class=" my-auto whitespace-nowrap">Schedule Estimate</span>
                            </button>
                        </a>
                        @endif
                        @if ($estimate->estimate_assigned != 1)
                        <button type="button" id="complete-estimate" class=" complete-estimate flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                            <span class=" my-auto whitespace-nowrap">Complete Estimate</span>
                        </button>
                        @endif
                        @if($estimate->estimate_total != null)
                        @if($user_details['user_role'] == 'admin')
                        <form action="/sendInvoiceToQB" method="post">
                            @csrf
                            <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                            <input type="hidden" name="total_amount" value="{{ $estimate->estimate_total }}">
                            <input type="hidden" name="customer_first_name" value="{{$estimate->customer->customer_first_name}}">
                            <input type="hidden" name="customer_last_name" value="{{$estimate->customer->customer_last_name}}">
                            <input type="hidden" name="customer_email" value="{{$estimate->customer->customer_email}}">
                            <button id="" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <div class=" flex mx-auto">
                                    <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                    <span class=" my-auto whitespace-nowrap">Send invoice to QB</span>
                                </div>
                            </button>
                        </form>
                        @endif
                        @endif
                        {{-- <button type="button"
                            class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#F4AC50]"
                            id=" action-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img class="h-[14px] w-[14px] my-auto mx-1"
                                src="{{ asset('assets/icons/settings-icon.svg') }}" alt="">
                        <span class=" my-auto">More</span>
                        <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                        </button> --}}
                        <button id="copyButton" class="flex h-[40px] w-[190px] ml-2 p-2 py-auto text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <div class="flex mx-auto">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class="my-auto whitespace-nowrap">Copy proposal Link</span>
                            </div>
                        </button>
                        @if(!isset($advancePayment) && isset($estimate->invoice) == null)
                        <button id="add-payment" class=" add-payment flex h-[40px] w-[190px] ml-2 p-2 py-auto text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#930027]">
                            <div class="flex mx-auto">
                                <!-- <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt=""> -->
                                <span class="my-auto whitespace-nowrap">$ Advance Payment</span>
                            </div>
                        </button>
                        @endif
                        <button type="button" id="apply-discount" class="  flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                            <!-- <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt=""> -->
                            <span class=" my-auto whitespace-nowrap">$ Apply Discount</span>
                        </button>
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
                    <div class="my-auto flex flex-wrap gap-1 py-4 relative">
                        <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                            Preview
                            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <form action="/sendPayment" method="post">
                            @csrf
                            <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                            <button type="submit" class=" flex h-[40px] w-[190px] ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto whitespace-nowrap">Send Receipt</span>
                            </button>
                        </form>
                        <div class="absolute top-14 z-10">
                            <div id="action-menu" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <a href="/makeProposal/{{ $estimate->estimate_id }}/?preview=1" target="_blank">
                                        <li>
                                            <button id="" type="button" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Estimate
                                            </button>
                                        </li>
                                    </a>
                                    <hr>
                                    <a href="/viewEstimateMaterials/{{$estimate->estimate_id}}" target="_blank">
                                        <li>
                                            <button id="" type="button" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Work Order
                                            </button>
                                        </li>
                                    </a>
                                    <hr>
                                    <a href="/makeProposal/{{ $estimate->estimate_id }}/?preview=1" target="_blank">
                                        <li>
                                            <button id="" type="button" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Invoice
                                            </button>
                                        </li>
                                    </a>
                                    <hr>
                                </ul>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var menubutton = document.getElementById('action-menubutton');
                                var menu = document.getElementById('action-menu');

                                menubutton.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    menu.classList.toggle('topbar-menuEntring');
                                    menu.classList.toggle('topbar-manuLeaving');
                                });

                                document.addEventListener('click', function(e) {
                                    if (!menubutton.contains(e.target) && !menu.contains(e.target)) {
                                        menu.classList.add('topbar-manuLeaving');
                                        menu.classList.remove('topbar-menuEntring');
                                    }
                                });
                            });
                        </script>
                        <a href="https://maps.google.com/?q={{ $estimate->customer->customer_primary_address }}" target="_blank" class="pl-3">
                            <button type="button" class="flex h-[40px] w-[190px] ml-2  px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                                <span class=" my-auto">Location</span>
                                <i class="fa-solid fa-location-dot my-auto mx-auto"></i>
                            </button>
                        </a>
                            <button id="sendProposal-btn" type="button" class=" flex justify-start ml-2 p-2 py-auto  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#59A95E]">
                                <img class="h-[14px] w-[14px] my-auto mx-1" src="{{ asset('assets/icons/check-icon.svg') }}" alt="">
                                <span class=" my-auto whitespace-nowrap">Send Proposal Again</span>
                            </button>
                        <!-- <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-12 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#4088CD]">
                            <img class="h-[14px] w-[14px]  my-auto mx-1" src="{{ asset('assets/icons/emailTemplate-icon.svg') }}" alt="">
                            <span class=" my-auto">Email</span>
                        </button>
                        <button type="button" class=" flex h-[40px] w-[190px] ml-2 px-auto px-5 py-2  text-[17px]/[19.92px] rounded-md text-white font-medium bg-[#E36152]">
                            <svg class="h-[14px] w-[14px]  my-auto mx-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3.5" y="3.5" width="7" height="7" fill="white" />
                                <rect x="0.5" y="0.5" width="13" height="13" stroke="white" />
                            </svg>
                            <span class=" my-auto">Stop Campaign</span>
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
        @if ($user_details['user_role'] == 'admin')
        <div class="  border-2  shadow-lg my-5  bg-white rounded-3xl mt-7 ">
            <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                <div class="flex items-center gap-2">
                    <button type="button" id="profitability-btn" class="flex">
                        <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                    </button>
                    <p class="text-lg text-white pl-3 font-medium">
                        Profitability
                    </p>
                </div>
            </div>
            <div class="p-2">
                <div class=" relative overflow-x-auto">
                    <table class=" w-full  ">
                        <thead class=" text-center">
                            <tr class="border border-solid border-l-0 border-r-0 border-t-0">
                                <th></th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Hours</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Cost</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Expenses</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Profit</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Margin</th>
                            </tr>
                        </thead>
                        <tbody class=" text-center">
                            <tr>
                                <td class="font-semibold text-[14px] md:text-xl lg:text-xl xl:text-xl">Estimated</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{number_format($profitHours, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{ number_format($profitCost, 2) }}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{ number_format($expenseTotal, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{ number_format($mainProfit, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ number_format($profitMargin, 2)}}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="  border-2  shadow-lg my-5  bg-white rounded-3xl mt-7 ">
            <div class="flex justify-between items-center px-3  bg-[#930027] rounded-t-3xl">
                <div class="flex items-center gap-2">
                    <button type="button" id="profitability-btn" class="flex">
                        <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                    </button>
                    <p class="text-lg text-white pl-3 font-medium">
                        Budgets
                    </p>
                </div>
            </div>
            <div class="p-2">
                <div class=" relative overflow-x-auto">
                    <table class=" w-full  ">
                        <thead class=" text-center">
                            <tr class="border border-solid border-l-0 border-r-0 border-t-0">
                                <th></th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Labor</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Material</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Expenses</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Profit</th>
                                <th class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">Margin</th>
                            </tr>
                        </thead>
                        <tbody class=" text-center">
                            <tr>
                                <td class="font-semibold  text-[14px] md:text-xl lg:text-xl xl:text-xl">Estimated</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{number_format($budgetLabour, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{number_format($budgetMaterial, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{number_format($expenseTotal, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">${{number_format($budgetProfit, 2)}}</td>
                                <td class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{number_format($budgetMargin, 2)}}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @if (session('user_details')['user_role'] == 'admin')
        <div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
            <div class="flex  items-center justify-between px-3  bg-[#930027] rounded-t-3xl">
                <div class="flex justify-start">
                    <button type="button" id="addItem-menubutton1" class="flex bg-white p-1 m-2 rounded-lg">
                        <div class=" bg-[#930027] rounded-lg">
                            <i class="fa-solid fa-plus text-white p-2"></i>
                        </div>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="absolute top-14 z-10">
                        <div id="addItem-menu1" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li>
                                    <button id="" type="button" class=" addItems block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Add Item
                                    </button>
                                </li>
                                <hr>
                                {{-- <li>
                                        <button id="addTemplate" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Template Name</button>
                                    </li> --}}
                                @foreach ($item_templates as $template)
                                <li>
                                    <button id="addTemplate{{ $template->item_template_id }}" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $template->item_template_name }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <p class="text-lg my-auto px-3 text-white font-medium">
                        Items
                    </p>
                </div>
                <div class="my-auto">
                    <a href="/rearrangeItems/{{ $estimate->estimate_id }}">
                        <button id="" class="bg-white text-black  p-2 rounded-md font-medium">
                            Rearrange Items
                        </button>
                    </a>
                </div>
            </div>
            @php
            $totalPrice = 0; // Initialize total price variable
            $groupTotals = []; // New array to store group total objects

            $groupedItems = [];
            foreach ($estimate_items as $groupItems) {
            $groupName = $groupItems->group->group_name ?? ''; // Use 'Other' if no group is associated
            $groupedItems[$groupName][] = $groupItems;
            }
            @endphp
            <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
                @if ($estimate_items->count() > 0)
                @foreach ($groupedItems as $groupName => $itemss)
                <div class="mb-2 bg-white shadow-xl">
                    <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                        <div class="inline-block">
                            @if($groupName)
                            <div class="flex gap-3">
                                @php
                                $displayedGroups = []; // Array to keep track of displayed groups
                                @endphp

                                @foreach($itemss as $item)
                                @php
                                $group = $item->group
                                @endphp
                                @if(!empty($group) && !in_array($group->group_id, $displayedGroups))
                                <!-- Display edit button only if the group has not been displayed before -->
                                @php
                                $displayedGroups[] = $group->group_id; // Add group to displayed groups
                                @endphp

                                <div>
                                    <button type="button" id="editGroup{{$group->group_id}}" class="inline">
                                        <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editGroup-modal{{$group->group_id}}">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Background overlay -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                            </div>

                                            <!-- Modal panel -->
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <div class=" ">
                                                <form action="/editGroup" method="post" id="formData{{$group->group_id}}">
                                                    @csrf
                                                    <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <!-- Modal content here -->
                                                        <div class=" flex justify-between">
                                                            <h2 class=" text-xl font-semibold mb-2 text-black" id="modal-title">Edit Group</h2>
                                                            <button class="modal-close" type="button">
                                                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                            </button>
                                                        </div>
                                                        <!-- task details -->
                                                        <div class=" grid grid-cols-2 gap-2">
                                                            <div class=" my-2">
                                                                <label for="group_name">Group Name:</label>
                                                                <input type="text" name="group_name" value="{{$group->group_name}}" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" list="group_names">
                                                                <datalist id="group_names">
                                                                    @foreach($groups as $groupItem)
                                                                    <option value="{{ $groupItem->group_name }}">{{ $groupItem->group_name }}</option>
                                                                    @endforeach
                                                                </datalist>
                                                            </div>
                                                            <!-- <div class="my-2">
                                                                <label for="total_items">Total Items:</label>
                                                                <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div> -->
                                                            <div class=" my-2">
                                                                <label for="group_type">Group Type:</label>
                                                                <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                                    <option value="{{$group->group_type}}">{{ucfirst($group->group_type)}}</option>
                                                                    <option>type</option>
                                                                    <option value="labour">Labor</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="assemblies">Assemblies</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-span-2">
                                                                <div class="grid grid-cols-2 gap-3 my-2">
                                                                    <div>
                                                                        <input type="checkbox" name="show_unit_price" id="show_unit_price{{$group->group_id}}" value="1" {{ $group->show_unit_price == 1 ? 'checked' : '' }}>
                                                                        <label for="show_unit_price{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="checkbox" name="show_quantity" id="show_quantity{{$group->group_id}}" value="1" {{ $group->show_quantity == 1 ? 'checked' : '' }}>
                                                                        <label for="show_quantity{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Quantities</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="checkbox" name="show_total" id="show_total{{$group->group_id}}" value="1" {{ $group->show_total == 1 ? 'checked' : '' }}>
                                                                        <label for="show_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Totals</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="checkbox" name="show_group_total" id="show_group_total{{$group->group_id}}" value="1" {{ $group->show_group_total == 1 ? 'checked' : '' }}>
                                                                        <label for="show_group_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Group Total</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="checkbox" name="include_est_total" id="include_est_total{{$group->group_id}}" value="1" {{ $group->include_est_total == 1 ? 'checked' : '' }}>
                                                                        <label for="include_est_total{{$group->group_id}}" class="text-gray-500 text-xs">Include In Estimate Total</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="my-2 col-span-2 relative">
                                                                <label for="group_description">Description:</label>
                                                                <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$group->group_description}}</textarea>
                                                                <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                                <div class=" text-center hidden spinner" id="spinner">
                                                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                                    </svg>
                                                                </div>
                                                                <div class="text" id="text">
                                                                    Save
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class=" mb-2 mx-6">
                                                    <form action="/deleteEstimateGroupItems" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                                        <button type="submit" class=" border border-black text-black font-semibold py-1 px-7 rounded-lg">Delete</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById("editGroup{{$group->group_id}}").addEventListener("click", function(e) {
                                            e.preventDefault();
                                            document.getElementById("editGroup-modal{{$group->group_id}}").classList.remove('hidden');
                                        });

                                        document.querySelectorAll(".modal-close").forEach(function(closeBtn) {
                                            closeBtn.addEventListener("click", function(e) {
                                                e.preventDefault();
                                                document.getElementById("editGroup-modal{{$group->group_id}}").classList.add('hidden');
                                                document.getElementById("formData{{$group->group_id}}").reset();
                                            });
                                        });
                                    </script>
                                </div>
                                @endif
                                @endforeach
                                <div class=" relative">
                                    <h1 class=" font-medium my-auto p-2 inline-block">{{$groupName}}</h1>
                                    <div class=" z-10 inline-block absolute">
                                        <button type="button" id="exclude-include-menuBtn{{$item->group_id}}" class="inline p-2">
                                            <i class="fa-solid fa-square-caret-down text-[#fff] text-lg"></i>
                                        </button>
                                        <div id="exclude-include-menu{{$item->group_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="group_id" value="{{$item->group_id}}">
                                                        <input type="hidden" name="item_status" value="included">
                                                        <input type="hidden" name="estimate_item_id" value="">
                                                        <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Include
                                                        </button>
                                                    </form>
                                                </li>
                                                <hr>
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="group_id" value="{{$item->group_id}}">
                                                        <input type="hidden" name="item_status" value="excluded">
                                                        <input type="hidden" name="estimate_item_id" value="">
                                                        <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Exclude
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById("exclude-include-menuBtn{{$item->group_id}}").addEventListener("click", function(e) {
                                            e.stopPropagation(); // Prevents the click event from reaching the document body
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->group_id}}");
                                            dropdownMenu.classList.toggle("topbar-menuEntring");
                                            dropdownMenu.classList.toggle("topbar-manuLeaving");
                                        });

                                        document.addEventListener('click', function(e) {
                                            var btn = document.getElementById("exclude-include-menuBtn{{$item->group_id}}");
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->group_id}}");

                                            if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                                // Click occurred outside the button and dropdown, hide the dropdown
                                                dropdownMenu.classList.add("topbar-manuLeaving");
                                                dropdownMenu.classList.remove("topbar-menuEntring");
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="relative overflow-x-auto mb-8">
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
                                            Item Status (excluded/included)
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Item Cost
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Item Qty
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $groupTotal = 0;
                                    $incEstTotal = 0;
                                    $grandGroupTotal = 0;
                                    $currentGroupId = $itemss[0]->group->group_id ?? null; // Get the group ID for this group
                                    $currentGroupName = $groupName; // Get the group name
                                    @endphp
                                    @foreach ($itemss as $item)
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                            <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                                <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                            </button>
                                        </th>
                                        <td class="px-6 py-4 w-[60%]">
                                            {{ $item->item_name }}
                                            <p class="text-xs text-[#323C47]">
                                                @if ($item->item_description)
                                            <p class="font-medium">Description:</p>
                                            {!!formatText($item->item_description)!!}
                                            @endif
                                            @if ($item->item_note)
                                            <p class="font-medium">Note:</p>
                                            {!!formatText($item->item_note)!!}
                                            @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if($item->item_status == 'included')
                                            <span class="inline-flex my-auto items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $item->item_status }}</span>
                                            @elseif($item->item_status == 'excluded')
                                            <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">{{ $item->item_status }}</span>
                                            @endif
                                            <button type="button" id="exclude-include-menuBtn{{$item->estimate_item_id}}" class="inline p-2">
                                                <i class="fa-solid fa-square-caret-down text-[#930027] text-lg"></i>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div class=" z-10">
                                                <div id="exclude-include-menu{{$item->estimate_item_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <form action="/includeexcludeEstimateItem" method="post">
                                                                @csrf
                                                                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                                <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                                <input type="hidden" name="item_status" value="included">
                                                                <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    Include
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <hr>
                                                        <li>
                                                            <form action="/includeexcludeEstimateItem" method="post">
                                                                @csrf
                                                                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                                <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                                <input type="hidden" name="item_status" value="excluded">
                                                                <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    Exclude
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}").addEventListener("click", function(e) {
                                                    e.stopPropagation(); // Prevents the click event from reaching the document body
                                                    var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");
                                                    dropdownMenu.classList.toggle("topbar-menuEntring");
                                                    dropdownMenu.classList.toggle("topbar-manuLeaving");
                                                });

                                                document.addEventListener('click', function(e) {
                                                    var btn = document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}");
                                                    var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");

                                                    if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                                        // Click occurred outside the button and dropdown, hide the dropdown
                                                        dropdownMenu.classList.add("topbar-manuLeaving");
                                                        dropdownMenu.classList.remove("topbar-menuEntring");
                                                    }
                                                });
                                            </script>
                                        </td>
                                        @if($item->group)
                                        <td class="text-center mx-2">
                                            @if($item->group->show_unit_price == 1)
                                            ${{ number_format($item->item_price, 2) }}
                                            @endif
                                        </td>
                                        <td class="text-center mx-2">
                                            @if($item->group->show_quantity == 1)
                                            {{ number_format($item->item_qty, 2) }}
                                            @endif
                                        </td>
                                        <td class="text-center mx-2">
                                            @if($item->group->show_total == 1)
                                            ${{ number_format($item->item_total, 2) }}
                                            @endif
                                        </td>
                                        @else
                                        <td class="text-center mx-2">
                                            ${{ number_format($item->item_price, 2) }}
                                        </td>
                                        <td class="text-center mx-2">
                                            {{ number_format($item->item_qty, 2) }}
                                        </td>
                                        <td class="text-center mx-2">
                                            ${{ number_format($item->item_total, 2) }}
                                        </td>
                                        @endif
                                        @php
                                        if(isset($item->group->show_group_total) && $item->group->show_group_total == 1) {
                                        $groupTotal += $item->item_total; // Add item price to group total
                                        }
                                        @endphp
                                        @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                                    <tr>
                                        <td colspan="7">
                                            <div class="">
                                                <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                                    <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                        <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                            <span></span>
                                                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                            </svg>
                                                        </button>
                                                    </h2>
                                                    <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                                        <div class="p-2">
                                                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                                    <tr>
                                                                        <th scope="col" class="px-6 py-3"></th>
                                                                        <th scope="col" class="px-6 py-3">
                                                                            Item Name
                                                                        </th>
                                                                        <th scope="col" class="px-6 py-3">
                                                                            Item Description
                                                                        </th>
                                                                        <th scope="col" class="text-center px-6 py-3">
                                                                            Item Cost
                                                                        </th>
                                                                        <th scope="col" class="text-center px-6 py-3">
                                                                            Item Qty
                                                                        </th>
                                                                        <th scope="col" class="text-center px-6 py-3">
                                                                            Total
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($item->assemblies as $assembly)
                                                                    <tr class="bg-white border-b">
                                                                        <td class="px-6 py-4"></td>
                                                                        <td class="px-6 py-4">
                                                                            {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}
                                                                        </td>
                                                                        <td class="px-6 py-4 w-[30%]">
                                                                            {!!formatText($assembly->ass_item_description)!!}
                                                                        </td>
                                                                        @if($item->group)
                                                                        <td class="text-center">
                                                                            @if($item->group->show_unit_price == 1)
                                                                            ${{number_format($assembly->ass_item_price, 2)}}
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @if($item->group->show_quantity == 1)
                                                                            {{number_format($assembly->ass_item_qty, 2)}}
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @if($item->group->show_total == 1)
                                                                            ${{number_format($assembly->ass_item_total, 2)}}
                                                                            @endif
                                                                        </td>
                                                                        @else
                                                                        <td class="text-center">
                                                                            ${{number_format($assembly->ass_item_price, 2)}}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{number_format($assembly->ass_item_qty, 2)}}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            ${{number_format($assembly->ass_item_total, 2)}}
                                                                        </td>
                                                                        @endif
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <script>
                                            document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                                                var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                                                accordionBody.classList.toggle("hidden");
                                            });
                                        </script>
                                    </tr>
                                    @endif
                                    </tr>
                                    @php
                                    if(isset($item->group->include_est_total) && $item->group->include_est_total == 1) {
                                    $incEstTotal = 1; // Add item price to included estimate total
                                    $grandGroupTotal += $item->item_total;;
                                    }
                                    $acceptorreject = $item->upgrade_status
                                    @endphp
                                    @endforeach
                                    @php
                                        if($currentGroupId && $groupTotal > 0) {
                                            // Check if this group ID already exists in $groupTotals
                                            $groupExists = false;
                                            foreach($groupTotals as &$existingGroup) {
                                                if($existingGroup['group_id'] === $currentGroupId) {
                                                    $existingGroup['total'] += $groupTotal; // Add to existing total
                                                    $groupExists = true;
                                                    break;
                                                }
                                            }
                                            // If group doesn't exist, add a new object
                                            if(!$groupExists) {
                                                $groupTotals[] = [
                                                    'group_id' => $currentGroupId,
                                                    'group_name' => $currentGroupName,
                                                    'total' => $groupTotal
                                                ];
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <th class="" colspan="7">
                                            @if($incEstTotal == 0 || $acceptorreject == 'rejected')
                                            **Not include in Estimate Total**
                                            @elseif($acceptorreject == 'accepted')
                                            **Accepted by the customer**
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class=" text-right" colspan="7">
                                            Group Total: {{ number_format($groupTotal, 2) }}
                                            @php
                                            $totalPrice += $grandGroupTotal; // Add item price to total
                                            $modalTotal = $totalPrice;
                                            @endphp
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
                <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
                <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
            </div>
            <br>
        </div>
    </div>
</div>
<div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
    <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
        <p class="text-lg px-3 text-white font-medium">
            Additional Items
        </p>
    </div>
    @php
    $additionaltotalPrice = 0; // Initialize total price variable

    $groupedItems = [];
    foreach ($estimateAdditionalItems as $groupItems) {
    $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
    $groupedItems[$groupName][] = $groupItems;
    }
    @endphp
    <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
        @if ($estimateAdditionalItems->count() > 0)
        @foreach ($groupedItems as $groupName => $itemss)
        <div class="mb-2 bg-white shadow-xl">
            <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                <div class="inline-block">
                    @if($groupName)
                    <div class="flex gap-3">
                        @php
                        $displayedGroups = []; // Array to keep track of displayed groups
                        @endphp

                        @foreach($itemss as $item)
                        @php
                        $group = $item->group
                        @endphp
                        @if(!empty($group) && !in_array($group->group_id, $displayedGroups))
                        <!-- Display edit button only if the group has not been displayed before -->
                        @php
                        $displayedGroups[] = $group->group_id; // Add group to displayed groups
                        @endphp

                        <div>
                            <!-- <button type="button" id="editGroup{{$group->group_id}}" class="inline">
                                        <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button> -->
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editGroup-modal{{$group->group_id}}">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                    </div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="/editGroup" method="post" id="formData{{$group->group_id}}">
                                            @csrf
                                            <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <!-- Modal content here -->
                                                <div class=" flex justify-between">
                                                    <h2 class=" text-xl font-semibold mb-2 text-black" id="modal-title">Edit Group</h2>
                                                    <button class="modal-close" type="button">
                                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                    </button>
                                                </div>
                                                <!-- task details -->
                                                <div class=" grid grid-cols-2 gap-2">
                                                    <div class=" my-2">
                                                        <label for="group_name">Group Name:</label>
                                                        <input type="text" name="group_name" value="{{$group->group_name}}" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" list="group_namess">
                                                        <datalist id="group_namess">
                                                            @foreach($groups as $item)
                                                            <option value="{{ $item->group_name }}">{{ $item->group_name }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <!-- <div class="my-2">
                                                                <label for="total_items">Total Items:</label>
                                                                <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div> -->
                                                    <div class=" my-2">
                                                        <label for="group_type">Group Type:</label>
                                                        <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                            <option value="{{$group->group_type}}">{{ucfirst($group->group_type)}}</option>
                                                            <option>type</option>
                                                            <option value="labour">Labor</option>
                                                            <option value="material">Material</option>
                                                            <option value="assemblies">Assemblies</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <div class="flex justify-around my-2">
                                                            <div>
                                                                <input type="checkbox" name="show_unit_price" id="show_unit_price{{$group->group_id}}" value="1" {{ $group->show_unit_price == 1 ? 'checked' : '' }}>
                                                                <label for="show_unit_price{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_quantity" id="show_quantity{{$group->group_id}}" value="1" {{ $group->show_quantity == 1 ? 'checked' : '' }}>
                                                                <label for="show_quantity{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Quantities</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_total" id="show_total{{$group->group_id}}" value="1" {{ $group->show_total == 1 ? 'checked' : '' }}>
                                                                <label for="show_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Totals</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class=" text-left col-span-2">
                                                                <h3 class=" font-medium text-lg">Items:</h3>
                                                                {{-- <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                                    <option>Item name</option>
                                                                    <option>Interior</option>
                                                                    <option>Exterior</option>
                                                                    <option>Labour</option>
                                                                </select> --}}
                                                                {{-- ======multiple item inputs===== --}}
                                                                <div id="muliple_items">
                                                                </div>

                                                                <div class=" text-right mt-2">
                                                                    <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="selectItems" aria-expanded="true" aria-haspopup="true">
                                                                        <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                                                    </button>
                                                                </div>
                                                            </div> -->
                                                    <div class="my-2 col-span-2 relative">
                                                        <label for="group_description">Description:</label>
                                                        <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$group->group_description}}</textarea>
                                                        <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                        <div class=" text-center hidden spinner" id="spinner">
                                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                            </svg>
                                                        </div>
                                                        <div class="text" id="text">
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("editGroup{{$group->group_id}}").addEventListener("click", function(e) {
                                    e.preventDefault();
                                    document.getElementById("editGroup-modal{{$group->group_id}}").classList.remove('hidden');
                                });

                                document.querySelectorAll(".modal-close").forEach(function(closeBtn) {
                                    closeBtn.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("editGroup-modal{{$group->group_id}}").classList.add('hidden');
                                        document.getElementById("formData{{$group->group_id}}").reset();
                                    });
                                });
                            </script>
                        </div>
                        @endif
                        @endforeach
                        <div>
                            <h1 class=" font-medium my-auto p-2">{{$groupName}}</h1>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="relative overflow-x-auto mb-8">
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
                                    Item Status (excluded/included)
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Cost
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Qty
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemss as $item)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                    <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                        <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                </th>
                                <td class="px-6 py-4 w-[30%]">
                                    {{ $item->item_name }}
                                </td>
                                <td class="px-6 py-4 w-[30%]">
                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                        @if ($item->item_description)
                                    <p class="font-medium">Description:</p>
                                    {!!formatText($item->item_description)!!}
                                    @endif
                                    @if ($item->item_note)
                                    <p class="font-medium">Note:</p>
                                    {!!formatText($item->item_note)!!}
                                    @endif
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if($item->item_status == 'included')
                                    <span class="inline-flex my-auto items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $item->item_status }}</span>
                                    @elseif($item->item_status == 'excluded')
                                    <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">{{ $item->item_status }}</span>
                                    @endif
                                    <button type="button" id="exclude-include-menuBtn{{$item->estimate_item_id}}" class="inline p-2">
                                        <i class="fa-solid fa-square-caret-down text-[#930027] text-lg"></i>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div class=" z-10">
                                        <div id="exclude-include-menu{{$item->estimate_item_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="included">
                                                        <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Include
                                                        </button>
                                                    </form>
                                                </li>
                                                <hr>
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="excluded">
                                                        <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Exclude
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}").addEventListener("click", function(e) {
                                            e.stopPropagation(); // Prevents the click event from reaching the document body
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");
                                            dropdownMenu.classList.toggle("topbar-menuEntring");
                                            dropdownMenu.classList.toggle("topbar-manuLeaving");
                                        });

                                        document.addEventListener('click', function(e) {
                                            var btn = document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}");
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");

                                            if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                                // Click occurred outside the button and dropdown, hide the dropdown
                                                dropdownMenu.classList.add("topbar-manuLeaving");
                                                dropdownMenu.classList.remove("topbar-menuEntring");
                                            }
                                        });
                                    </script>
                                </td>
                                @if($item->group)
                                <td class="text-center mx-2">
                                    @if($item->group->show_unit_price == 1)
                                    ${{ number_format($item->item_price, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_quantity == 1)
                                    {{ number_format($item->item_qty, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_total == 1)
                                    ${{ number_format($item->item_total, 2) }}
                                    @endif
                                </td>
                                @else
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_price, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    {{ number_format($item->item_qty, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_total, 2) }}
                                </td>
                                @endif
                                @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                            <tr>
                                <td colspan="7">
                                    <div class="">
                                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                    <span></span>
                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                    </svg>
                                                </button>
                                            </h2>
                                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                                <div class="p-2">
                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3"></th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Name
                                                                </th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Description
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Cost
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Qty
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Total
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->assemblies as $assembly)
                                                            <tr class="bg-white border-b">
                                                                <td class="px-6 py-4"></td>
                                                                <td class="px-6 py-4">
                                                                    {{$assembly->est_ass_item_name}}
                                                                </td>
                                                                <td class="px-6 py-4 w-[30%]">

                                                                {!!formatText($assembly->ass_item_description)!!}
                                                                </td>
                                                                @if($item->group)
                                                                <td class="text-center">
                                                                    @if($item->group->show_unit_price == 1)
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_quantity == 1)
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_total == 1)
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                    @endif
                                                                </td>
                                                                @else
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <script>
                                    document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                                        var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                                        accordionBody.classList.toggle("hidden");
                                    });
                                </script>
                            </tr>
                            @endif
                            </tr>
                            @php
                            $additionaltotalPrice += $item->item_total; // Add item price to total
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
        <span>${{ number_format($additionaltotalPrice, 2) }}</span> {{-- Display the formatted total --}}
    </div>
    <br>
</div>

@elseif(isset($userPrivileges->estimate) &&
isset($userPrivileges->estimate->items) &&
$userPrivileges->estimate->items === 'on')
<div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
    <div class="flex  items-center justify-between px-3  bg-[#930027] rounded-t-3xl">
        <div class="flex justify-start">
            <button type="button" id="addItem-menubutton1" class="flex bg-white p-1 m-2 rounded-lg">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
            <!-- Dropdown menu -->
            <div class="absolute top-14 z-10">
                <div id="addItem-menu1" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <button id="" type="button" class=" addItems block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Add Item
                            </button>
                        </li>
                        <hr>
                        {{-- <li>
                                <button id="addTemplate" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Template Name</button>
                            </li> --}}
                        @foreach ($item_templates as $template)
                        <li>
                            <button id="addTemplate{{ $template->item_template_id }}" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $template->item_template_name }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <p class="text-lg my-auto px-3 text-white font-medium">
                Items
            </p>
        </div>
        <div class="my-auto">
            <a href="/rearrangeItems/{{ $estimate->estimate_id }}">
                <button id="" class="bg-white text-black  p-2 rounded-md font-medium">
                    Rearrange Items
                </button>
            </a>
        </div>
    </div>
    @php
    $totalPrice = 0; // Initialize total price variable
    $groupTotals = []; // New array to store group total objects

    $groupedItems = [];
    foreach ($estimate_items as $groupItems) {
    $groupName = $groupItems->group->group_name ?? ''; // Use 'Other' if no group is associated
    $groupedItems[$groupName][] = $groupItems;
    }
    @endphp
    <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
        @if ($estimate_items->count() > 0)
        @foreach ($groupedItems as $groupName => $itemss)
        <div class="mb-2 bg-white shadow-xl">
            <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                <div class="inline-block">
                    @if($groupName)
                    <div class="flex gap-3">
                        @php
                        $displayedGroups = []; // Array to keep track of displayed groups
                        @endphp

                        @foreach($itemss as $item)
                        @php
                        $group = $item->group
                        @endphp
                        @if(!empty($group) && !in_array($group->group_id, $displayedGroups))
                        <!-- Display edit button only if the group has not been displayed before -->
                        @php
                        $displayedGroups[] = $group->group_id; // Add group to displayed groups
                        @endphp

                        <div>
                            <button type="button" id="editGroup{{$group->group_id}}" class="inline">
                                <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                            </button>
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editGroup-modal{{$group->group_id}}">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                    </div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class=" ">
                                        <form action="/editGroup" method="post" id="formData{{$group->group_id}}">
                                            @csrf
                                            <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <!-- Modal content here -->
                                                <div class=" flex justify-between">
                                                    <h2 class=" text-xl font-semibold mb-2 text-black" id="modal-title">Edit Group</h2>
                                                    <button class="modal-close" type="button">
                                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                    </button>
                                                </div>
                                                <!-- task details -->
                                                <div class=" grid grid-cols-2 gap-2">
                                                    <div class=" my-2">
                                                        <label for="group_name">Group Name:</label>
                                                        <input type="text" name="group_name" value="{{$group->group_name}}" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" list="group_names">
                                                        <datalist id="group_names">
                                                            @foreach($groups as $groupItem)
                                                            <option value="{{ $groupItem->group_name }}">{{ $groupItem->group_name }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <!-- <div class="my-2">
                                                        <label for="total_items">Total Items:</label>
                                                        <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                    </div> -->
                                                    <div class=" my-2">
                                                        <label for="group_type">Group Type:</label>
                                                        <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                            <option value="{{$group->group_type}}">{{ucfirst($group->group_type)}}</option>
                                                            <option>type</option>
                                                            <option value="labour">Labor</option>
                                                            <option value="material">Material</option>
                                                            <option value="assemblies">Assemblies</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <div class="grid grid-cols-2 gap-3 my-2">
                                                            <div>
                                                                <input type="checkbox" name="show_unit_price" id="show_unit_price{{$group->group_id}}" value="1" {{ $group->show_unit_price == 1 ? 'checked' : '' }}>
                                                                <label for="show_unit_price{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_quantity" id="show_quantity{{$group->group_id}}" value="1" {{ $group->show_quantity == 1 ? 'checked' : '' }}>
                                                                <label for="show_quantity{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Quantities</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_total" id="show_total{{$group->group_id}}" value="1" {{ $group->show_total == 1 ? 'checked' : '' }}>
                                                                <label for="show_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Totals</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_group_total" id="show_group_total{{$group->group_id}}" value="1" {{ $group->show_group_total == 1 ? 'checked' : '' }}>
                                                                <label for="show_group_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Group Total</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="include_est_total" id="include_est_total{{$group->group_id}}" value="1" {{ $group->include_est_total == 1 ? 'checked' : '' }}>
                                                                <label for="include_est_total{{$group->group_id}}" class="text-gray-500 text-xs">Include In Estimate Total</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="my-2 col-span-2 relative">
                                                        <label for="group_description">Description:</label>
                                                        <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$group->group_description}}</textarea>
                                                        <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                        <div class=" text-center hidden spinner" id="spinner">
                                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                            </svg>
                                                        </div>
                                                        <div class="text" id="text">
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class=" mb-2 mx-6">
                                            <form action="/deleteEstimateGroupItems" method="post">
                                                @csrf
                                                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                                <button type="submit" class=" border border-black text-black font-semibold py-1 px-7 rounded-lg">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("editGroup{{$group->group_id}}").addEventListener("click", function(e) {
                                    e.preventDefault();
                                    document.getElementById("editGroup-modal{{$group->group_id}}").classList.remove('hidden');
                                });

                                document.querySelectorAll(".modal-close").forEach(function(closeBtn) {
                                    closeBtn.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("editGroup-modal{{$group->group_id}}").classList.add('hidden');
                                        document.getElementById("formData{{$group->group_id}}").reset();
                                    });
                                });
                            </script>
                        </div>
                        @endif
                        @endforeach
                        <div class=" relative">
                            <h1 class=" font-medium my-auto p-2 inline-block">{{$groupName}}</h1>
                            <div class=" z-10 inline-block absolute">
                                <button type="button" id="exclude-include-menuBtn{{$item->group_id}}" class="inline p-2">
                                    <i class="fa-solid fa-square-caret-down text-[#fff] text-lg"></i>
                                </button>
                                <div id="exclude-include-menu{{$item->group_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                        <li>
                                            <form action="/includeexcludeEstimateItem" method="post">
                                                @csrf
                                                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                <input type="hidden" name="group_id" value="{{$item->group_id}}">
                                                <input type="hidden" name="item_status" value="included">
                                                <input type="hidden" name="estimate_item_id" value="">
                                                <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Include
                                                </button>
                                            </form>
                                        </li>
                                        <hr>
                                        <li>
                                            <form action="/includeexcludeEstimateItem" method="post">
                                                @csrf
                                                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                <input type="hidden" name="group_id" value="{{$item->group_id}}">
                                                <input type="hidden" name="item_status" value="excluded">
                                                <input type="hidden" name="estimate_item_id" value="">
                                                <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Exclude
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <script>
                                document.getElementById("exclude-include-menuBtn{{$item->group_id}}").addEventListener("click", function(e) {
                                    e.stopPropagation(); // Prevents the click event from reaching the document body
                                    var dropdownMenu = document.getElementById("exclude-include-menu{{$item->group_id}}");
                                    dropdownMenu.classList.toggle("topbar-menuEntring");
                                    dropdownMenu.classList.toggle("topbar-manuLeaving");
                                });

                                document.addEventListener('click', function(e) {
                                    var btn = document.getElementById("exclude-include-menuBtn{{$item->group_id}}");
                                    var dropdownMenu = document.getElementById("exclude-include-menu{{$item->group_id}}");

                                    if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                        // Click occurred outside the button and dropdown, hide the dropdown
                                        dropdownMenu.classList.add("topbar-manuLeaving");
                                        dropdownMenu.classList.remove("topbar-menuEntring");
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="relative overflow-x-auto mb-8">
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
                                    Item Status (excluded/included)
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Cost
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Qty
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $groupTotal = 0;
                            $incEstTotal = 0;
                            $grandGroupTotal = 0;
                            $currentGroupId = $itemss[0]->group->group_id ?? null; // Get the group ID for this group
                            $currentGroupName = $groupName; // Get the group name
                            @endphp
                            @foreach ($itemss as $item)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                    <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                        <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                </th>
                                <td class="px-6 py-4 w-[60%]">
                                    {{ $item->item_name }}
                                    <p class="text-xs text-[#323C47]">
                                        @if ($item->item_description)
                                    <p class="font-medium">Description:</p>
                                    {!!formatText($item->item_description)!!}
                                    @endif
                                    @if ($item->item_note)
                                    <p class="font-medium">Note:</p>
                                    {!!formatText($item->item_note)!!}
                                    @endif
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if($item->item_status == 'included')
                                    <span class="inline-flex my-auto items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $item->item_status }}</span>
                                    @elseif($item->item_status == 'excluded')
                                    <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">{{ $item->item_status }}</span>
                                    @endif
                                    <button type="button" id="exclude-include-menuBtn{{$item->estimate_item_id}}" class="inline p-2">
                                        <i class="fa-solid fa-square-caret-down text-[#930027] text-lg"></i>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div class=" z-10">
                                        <div id="exclude-include-menu{{$item->estimate_item_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="included">
                                                        <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Include
                                                        </button>
                                                    </form>
                                                </li>
                                                <hr>
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="excluded">
                                                        <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Exclude
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}").addEventListener("click", function(e) {
                                            e.stopPropagation(); // Prevents the click event from reaching the document body
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");
                                            dropdownMenu.classList.toggle("topbar-menuEntring");
                                            dropdownMenu.classList.toggle("topbar-manuLeaving");
                                        });

                                        document.addEventListener('click', function(e) {
                                            var btn = document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}");
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");

                                            if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                                // Click occurred outside the button and dropdown, hide the dropdown
                                                dropdownMenu.classList.add("topbar-manuLeaving");
                                                dropdownMenu.classList.remove("topbar-menuEntring");
                                            }
                                        });
                                    </script>
                                </td>
                                @if($item->group)
                                <td class="text-center mx-2">
                                    @if($item->group->show_unit_price == 1)
                                    ${{ number_format($item->item_price, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_quantity == 1)
                                    {{ number_format($item->item_qty, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_total == 1)
                                    ${{ number_format($item->item_total, 2) }}
                                    @endif
                                </td>
                                @else
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_price, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    {{ number_format($item->item_qty, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_total, 2) }}
                                </td>
                                @endif
                                @php
                                if(isset($item->group->show_group_total) && $item->group->show_group_total == 1) {
                                $groupTotal += $item->item_total; // Add item price to group total
                                }
                                @endphp
                                @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                            <tr>
                                <td colspan="7">
                                    <div class="">
                                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                    <span></span>
                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                    </svg>
                                                </button>
                                            </h2>
                                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                                <div class="p-2">
                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3"></th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Name
                                                                </th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Description
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Cost
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Qty
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Total
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->assemblies as $assembly)
                                                            <tr class="bg-white border-b">
                                                                <td class="px-6 py-4"></td>
                                                                <td class="px-6 py-4">
                                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->est_ass_item_name) !!}
                                                                </td>
                                                                <td class="px-6 py-4 w-[30%]">
                                                                    {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $assembly->ass_item_description) !!}
                                                                </td>
                                                                @if($item->group)
                                                                <td class="text-center">
                                                                    @if($item->group->show_unit_price == 1)
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_quantity == 1)
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_total == 1)
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                    @endif
                                                                </td>
                                                                @else
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <script>
                                    document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                                        var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                                        accordionBody.classList.toggle("hidden");
                                    });
                                </script>
                            </tr>
                            @endif
                            </tr>
                            @php
                            if(isset($item->group->include_est_total) && $item->group->include_est_total == 1) {
                            $incEstTotal = 1; // Add item price to included estimate total
                            $grandGroupTotal += $item->item_total;;
                            }
                            $acceptorreject = $item->upgrade_status
                            @endphp
                            @endforeach
                            @php
                                if($currentGroupId && $groupTotal > 0) {
                                    // Check if this group ID already exists in $groupTotals
                                    $groupExists = false;
                                    foreach($groupTotals as &$existingGroup) {
                                        if($existingGroup['group_id'] === $currentGroupId) {
                                            $existingGroup['total'] += $groupTotal; // Add to existing total
                                            $groupExists = true;
                                            break;
                                        }
                                    }
                                    // If group doesn't exist, add a new object
                                    if(!$groupExists) {
                                        $groupTotals[] = [
                                            'group_id' => $currentGroupId,
                                            'group_name' => $currentGroupName,
                                            'total' => $groupTotal
                                        ];
                                    }
                                }
                            @endphp
                            <tr>
                                <th class="" colspan="7">
                                    @if($incEstTotal == 0 || $acceptorreject == 'rejected')
                                    **Not include in Estimate Total**
                                    @elseif($acceptorreject == 'accepted')
                                    **Accepted by the customer**
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th class=" text-right" colspan="7">
                                    Group Total: {{ number_format($groupTotal, 2) }}
                                    @php
                                    $totalPrice += $grandGroupTotal; // Add item price to total
                                    $modalTotal = $totalPrice;
                                    @endphp
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
        <span>${{ number_format($totalPrice, 2) }}</span> {{-- Display the formatted total --}}
    </div>
    <br>
</div>
<div class=" relative  border-2  shadow-lg mt-7  bg-white rounded-3xl">
    <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
        <p class="text-lg px-3 text-white font-medium">
            Additional Items
        </p>
    </div>
    @php
    $additionaltotalPrice = 0; // Initialize total price variable

    $groupedItems = [];
    foreach ($estimateAdditionalItems as $groupItems) {
    $groupName = $groupItems->group->group_name ?? 'Other'; // Use 'Other' if no group is associated
    $groupedItems[$groupName][] = $groupItems;
    }
    @endphp
    <div class=" itemDiv col-span-10 ml-2 overflow-auto  rounded-lg border-[#0000004D] m-3">
        @if ($estimateAdditionalItems->count() > 0)
        @foreach ($groupedItems as $groupName => $itemss)
        <div class="mb-2 bg-white shadow-xl">
            <div class=" p-1 bg-[#930027] text-white w-full rounded-t-lg">
                <div class="inline-block">
                    @if($groupName)
                    <div class="flex gap-3">
                        @php
                        $displayedGroups = []; // Array to keep track of displayed groups
                        @endphp

                        @foreach($itemss as $item)
                        @php
                        $group = $item->group
                        @endphp
                        @if(!empty($group) && !in_array($group->group_id, $displayedGroups))
                        <!-- Display edit button only if the group has not been displayed before -->
                        @php
                        $displayedGroups[] = $group->group_id; // Add group to displayed groups
                        @endphp

                        <div>
                            <!-- <button type="button" id="editGroup{{$group->group_id}}" class="inline">
                                        <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button> -->
                            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editGroup-modal{{$group->group_id}}">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                    </div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="/editGroup" method="post" id="formData{{$group->group_id}}">
                                            @csrf
                                            <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <!-- Modal content here -->
                                                <div class=" flex justify-between">
                                                    <h2 class=" text-xl font-semibold mb-2 text-black" id="modal-title">Edit Group</h2>
                                                    <button class="modal-close" type="button">
                                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                    </button>
                                                </div>
                                                <!-- task details -->
                                                <div class=" grid grid-cols-2 gap-2">
                                                    <div class=" my-2">
                                                        <label for="group_name">Group Name:</label>
                                                        <input type="text" name="group_name" value="{{$group->group_name}}" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" list="group_namess">
                                                        <datalist id="group_namess">
                                                            @foreach($groups as $item)
                                                            <option value="{{ $item->group_name }}">{{ $item->group_name }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <!-- <div class="my-2">
                                                                <label for="total_items">Total Items:</label>
                                                                <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            </div> -->
                                                    <div class=" my-2">
                                                        <label for="group_type">Group Type:</label>
                                                        <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                            <option value="{{$group->group_type}}">{{ucfirst($group->group_type)}}</option>
                                                            <option>type</option>
                                                            <option value="labour">Labor</option>
                                                            <option value="material">Material</option>
                                                            <option value="assemblies">Assemblies</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <div class="flex justify-around my-2">
                                                            <div>
                                                                <input type="checkbox" name="show_unit_price" id="show_unit_price{{$group->group_id}}" value="1" {{ $group->show_unit_price == 1 ? 'checked' : '' }}>
                                                                <label for="show_unit_price{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_quantity" id="show_quantity{{$group->group_id}}" value="1" {{ $group->show_quantity == 1 ? 'checked' : '' }}>
                                                                <label for="show_quantity{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Quantities</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="show_total" id="show_total{{$group->group_id}}" value="1" {{ $group->show_total == 1 ? 'checked' : '' }}>
                                                                <label for="show_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Totals</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class=" text-left col-span-2">
                                                                <h3 class=" font-medium text-lg">Items:</h3>
                                                                {{-- <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                                    <option>Item name</option>
                                                                    <option>Interior</option>
                                                                    <option>Exterior</option>
                                                                    <option>Labour</option>
                                                                </select> --}}
                                                                {{-- ======multiple item inputs===== --}}
                                                                <div id="muliple_items">
                                                                </div>

                                                                <div class=" text-right mt-2">
                                                                    <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="selectItems" aria-expanded="true" aria-haspopup="true">
                                                                        <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                                                    </button>
                                                                </div>
                                                            </div> -->
                                                    <div class="my-2 col-span-2 relative">
                                                        <label for="group_description">Description:</label>
                                                        <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$group->group_description}}</textarea>
                                                        <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                        <div class=" text-center hidden spinner" id="spinner">
                                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                            </svg>
                                                        </div>
                                                        <div class="text" id="text">
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("editGroup{{$group->group_id}}").addEventListener("click", function(e) {
                                    e.preventDefault();
                                    document.getElementById("editGroup-modal{{$group->group_id}}").classList.remove('hidden');
                                });

                                document.querySelectorAll(".modal-close").forEach(function(closeBtn) {
                                    closeBtn.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("editGroup-modal{{$group->group_id}}").classList.add('hidden');
                                        document.getElementById("formData{{$group->group_id}}").reset();
                                    });
                                });
                            </script>
                        </div>
                        @endif
                        @endforeach
                        <div>
                            <h1 class=" font-medium my-auto p-2">{{$groupName}}</h1>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="relative overflow-x-auto mb-8">
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
                                    Item Status (excluded/included)
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Cost
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Item Qty
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemss as $item)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                    <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                        <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                    </button>
                                </th>
                                <td class="px-6 py-4 w-[30%]">
                                    {{ $item->item_name }}
                                </td>
                                <td class="px-6 py-4 w-[30%]">
                                    <p class="text-[16px]/[18px] text-[#323C47] font">
                                        @if ($item->item_description)
                                    <p class="font-medium">Description:</p>
                                    {!!formatText($item->item_description)!!}
                                    @endif
                                    @if ($item->item_note)
                                    <p class="font-medium">Note:</p>
                                    {!!formatText($item->item_note)!!}
                                    @endif
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if($item->item_status == 'included')
                                    <span class="inline-flex my-auto items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $item->item_status }}</span>
                                    @elseif($item->item_status == 'excluded')
                                    <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">{{ $item->item_status }}</span>
                                    @endif
                                    <button type="button" id="exclude-include-menuBtn{{$item->estimate_item_id}}" class="inline p-2">
                                        <i class="fa-solid fa-square-caret-down text-[#930027] text-lg"></i>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div class=" z-10">
                                        <div id="exclude-include-menu{{$item->estimate_item_id}}" class=" topbar-manuLeaving bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="included">
                                                        <button id="" class=" block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Include
                                                        </button>
                                                    </form>
                                                </li>
                                                <hr>
                                                <li>
                                                    <form action="/includeexcludeEstimateItem" method="post">
                                                        @csrf
                                                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                                                        <input type="hidden" name="estimate_item_id" value="{{$item->estimate_item_id}}">
                                                        <input type="hidden" name="item_status" value="excluded">
                                                        <button id="" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Exclude
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}").addEventListener("click", function(e) {
                                            e.stopPropagation(); // Prevents the click event from reaching the document body
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");
                                            dropdownMenu.classList.toggle("topbar-menuEntring");
                                            dropdownMenu.classList.toggle("topbar-manuLeaving");
                                        });

                                        document.addEventListener('click', function(e) {
                                            var btn = document.getElementById("exclude-include-menuBtn{{$item->estimate_item_id}}");
                                            var dropdownMenu = document.getElementById("exclude-include-menu{{$item->estimate_item_id}}");

                                            if (!btn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                                // Click occurred outside the button and dropdown, hide the dropdown
                                                dropdownMenu.classList.add("topbar-manuLeaving");
                                                dropdownMenu.classList.remove("topbar-menuEntring");
                                            }
                                        });
                                    </script>
                                </td>
                                @if($item->group)
                                <td class="text-center mx-2">
                                    @if($item->group->show_unit_price == 1)
                                    ${{ number_format($item->item_price, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_quantity == 1)
                                    {{ number_format($item->item_qty, 2) }}
                                    @endif
                                </td>
                                <td class="text-center mx-2">
                                    @if($item->group->show_total == 1)
                                    ${{ number_format($item->item_total, 2) }}
                                    @endif
                                </td>
                                @else
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_price, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    {{ number_format($item->item_qty, 2) }}
                                </td>
                                <td class="text-center mx-2">
                                    ${{ number_format($item->item_total, 2) }}
                                </td>
                                @endif
                                @if ($item->item_type === 'assemblies' && $item->assemblies->count() > 0)
                            <tr>
                                <td colspan="7">
                                    <div class="">
                                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                                    <span></span>
                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                    </svg>
                                                </button>
                                            </h2>
                                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                                <div class="p-2">
                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3"></th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Name
                                                                </th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Item Description
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Cost
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Item Qty
                                                                </th>
                                                                <th scope="col" class="text-center px-6 py-3">
                                                                    Total
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->assemblies as $assembly)
                                                            <tr class="bg-white border-b">
                                                                <td class="px-6 py-4"></td>
                                                                <td class="px-6 py-4">
                                                                    {{$assembly->est_ass_item_name}}
                                                                </td>
                                                                <td class="px-6 py-4 w-[30%]">
                                                                    {!!formatText($assembly->ass_item_description)!!}
                                                                </td>
                                                                @if($item->group)
                                                                <td class="text-center">
                                                                    @if($item->group->show_unit_price == 1)
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_quantity == 1)
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($item->group->show_total == 1)
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                    @endif
                                                                </td>
                                                                @else
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                                </td>
                                                                <td class="text-center">
                                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <script>
                                    document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                                        var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                                        accordionBody.classList.toggle("hidden");
                                    });
                                </script>
                            </tr>
                            @endif
                            </tr>
                            @php
                            $additionaltotalPrice += $item->item_total; // Add item price to total
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="bottom-2 mt-4 border-[#0000001A] w-full pt-4 px-4 pl-2 flex justify-end">
        <span class="font-semibold text-[18px]/[21.2px] text-[#323C47] pr-7">Grand Total</span>
        <span>${{ number_format($additionaltotalPrice, 2) }}</span> {{-- Display the formatted total --}}
    </div>
    <br>
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
                            <!-- <th scope="col" class="px-6 py-3">

                            </th> -->
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Name
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Cost
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Qty
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'labour')
                        <tr class="bg-white border-b">
                            <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                <button type="button" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                    <img class="h-[50px] w-[50px]" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </th> -->
                            <td class="px-6 py-4 w-[60%]">
                                {{ $item->item_name }}
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($item->item_description)
                                <p class="font-medium">Description:</p>
                                {!!formatText($item->item_description)!!}
                                @endif
                                @if ($item->item_note)
                                <p class="font-medium">Note:</p>
                                {!!formatText($item->item_note)!!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ number_format($item->item_price, 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($item->item_qty, 2) }}
                            </td>
                            <td class="text-center">
                                ${{ number_format($item->item_total, 2) }}
                            </td>
                        </tr>
                        @php
                        $totalLaborPrice += $item->item_total; // Add labor item price to total
                        @endphp
                        @endif
                        @endforeach

                        @php
                        $uniqueItems = []; // Array to store unique item details
                        @endphp

                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'assemblies')
                        @foreach ($item->assemblies as $assemblyItem)
                        @if ($assemblyItem->ass_item_type === 'labour')
                        @php
                        $itemId = $assemblyItem->est_ass_item_id;
                        $itemQty = $assemblyItem->ass_item_qty;
                        $itemTotal = $assemblyItem->ass_item_total;
                        $itemPrice = $assemblyItem->ass_item_price;
                        $itemKey = $itemId . '_' . $assemblyItem->est_ass_item_name . '_' . $assemblyItem->ass_item_description;

                        // Check if item details are already encountered
                        if (isset($uniqueItems[$itemKey])) {
                        // Increment quantity and total if the item details already exist
                        $uniqueItems[$itemKey]['qty'] += $itemQty;
                        $uniqueItems[$itemKey]['total'] += $itemTotal;
                        } else {
                        // Add new entry for the unique item
                        $uniqueItems[$itemKey] = [
                        'name' => $assemblyItem->est_ass_item_name,
                        'description' => $assemblyItem->ass_item_description,
                        'price' => $itemPrice,
                        'qty' => $itemQty,
                        'total' => $itemTotal
                        ];
                        }
                        @endphp
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        @foreach ($uniqueItems as $itemData)
                        <tr class="bg-white border-b">
                            <td class="px-2 py-4 w-[30%] text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $itemData['name'] }}
                            </td>
                            <td class="px-2 py-4 w-[30%] text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($itemData['description'])
                                <p class="font-medium">Description:</p>
                                {{ $itemData['description'] }}
                                @endif
                                </p>
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                ${{ number_format($itemData['price'], 2) }}
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ number_format($itemData['qty'], 2) }}
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                ${{ number_format($itemData['total'], 2) }}
                            </td>
                        </tr>
                        @php
                        $totalLaborPrice += $itemData['total']; // Add labor item price to total
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        <div class="relative overflow-x-auto">
            <div class="itemDiv">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <!-- <th scope="col" class="px-6 py-3">

                            </th> -->
                            <th scope="col" class="px-6 py-3">
                                Item Name
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Item Cost
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Item Qty
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'labour')
                        <tr class="bg-white border-b">
                            <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                <button type="button" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                    <img class="h-[50px] w-[50px]" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </th> -->
                            <td class="px-6 py-4 w-[60%]">
                                {{ $item->item_name }}
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($item->item_description)
                                <p class="font-medium">Description:</p>
                                {!!formatText($item->item_description)!!}
                                @endif
                                @if ($item->item_note)
                                <p class="font-medium">Note:</p>
                                {!!formatText($item->item_note)!!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ number_format($item->item_price, 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($item->item_qty, 2) }}
                            </td>
                            <td class="text-center">
                                ${{ number_format($item->item_total, 2) }}
                            </td>
                        </tr>
                        @php
                        $totalLaborPrice += $item->item_total; // Add labor item price to total
                        @endphp
                        @endif
                        @endforeach

                        @php
                        $uniqueItems = []; // Array to store unique item details
                        @endphp

                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'assemblies')
                        @foreach ($item->assemblies as $assemblyItem)
                        @if ($assemblyItem->ass_item_type === 'labour')
                        @php
                        $itemId = $assemblyItem->est_ass_item_id;
                        $itemQty = $assemblyItem->ass_item_qty;
                        $itemTotal = $assemblyItem->ass_item_total;
                        $itemPrice = $assemblyItem->ass_item_price;
                        $itemKey = $itemId . '_' . $assemblyItem->est_ass_item_name . '_' . $assemblyItem->ass_item_description;

                        // Check if item details are already encountered
                        if (isset($uniqueItems[$itemKey])) {
                        // Increment quantity and total if the item details already exist
                        $uniqueItems[$itemKey]['qty'] += $itemQty;
                        $uniqueItems[$itemKey]['total'] += $itemTotal;
                        } else {
                        // Add new entry for the unique item
                        $uniqueItems[$itemKey] = [
                        'name' => $assemblyItem->est_ass_item_name,
                        'description' => $assemblyItem->ass_item_description,
                        'price' => $itemPrice,
                        'qty' => $itemQty,
                        'total' => $itemTotal
                        ];
                        }
                        @endphp
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        @foreach ($uniqueItems as $itemData)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 w-[30%]">
                                {{ $itemData['name'] }}
                            </td>
                            <td class="px-6 py-4 w-[30%]">
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($itemData['description'])
                                <p class="font-medium">Description:</p>
                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $itemData['description']) !!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['price'], 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($itemData['qty'], 2) }}
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['total'], 2) }}
                            </td>
                        </tr>
                        @php
                        $totalLaborPrice += $itemData['total']; // Add labor item price to total
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        <div class="relative overflow-x-auto">
            <div class="itemDiv">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <!-- <th scope="col" class="px-6 py-3">

                            </th> -->
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Name
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Cost
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Item Qty
                            </th>
                            <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'material')
                        <tr class="bg-white border-b">
                            <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                <button type="button" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                    <img class="h-[50px] w-[50px]" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </th> -->
                            <td class="px-2 py-4 w-[60%] text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $item->item_name }}
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px] text-[#323C47] font">
                                    @if ($item->item_description)
                                <p class="font-medium">Description:</p>
                                {!!formatText($item->item_description)!!}
                                @endif
                                @if ($item->item_note)
                                <p class="font-medium">Note:</p>
                                {!!formatText($item->item_note)!!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                ${{ $item->item_cost }}
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $item->item_qty }}
                            </td>
                            <td class="text-center text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                ${{ $item->item_total }}
                            </td>
                        </tr>
                        @php
                        $totalMaterialPrice += $item->item_total; // Add material item price to total
                        @endphp
                        @endif
                        @endforeach

                        @php
                        $uniqueMaterialItems = []; // Array to store unique material item IDs
                        @endphp

                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'assemblies')
                        @foreach ($item->assemblies as $assemblyItem)
                        @if ($assemblyItem->ass_item_type === 'material')
                        @php
                        $itemId = $assemblyItem->est_ass_item_id;
                        $itemQty = $assemblyItem->ass_item_qty;
                        $itemTotal = $assemblyItem->ass_item_total;
                        $itemPrice = $assemblyItem->ass_item_price;
                        $itemKey = $itemId . '_' . $assemblyItem->est_ass_item_name . '_' . $assemblyItem->ass_item_description;

                        // Check if item ID is already encountered
                        if (isset($uniqueMaterialItems[$itemKey])) {
                        // Increment quantity and total if the item ID already exists
                        $uniqueMaterialItems[$itemKey]['qty'] += $itemQty;
                        $uniqueMaterialItems[$itemKey]['total'] += $itemTotal;
                        } else {
                        // Add new entry for the unique item
                        $uniqueMaterialItems[$itemKey] = [
                        'name' => $assemblyItem->est_ass_item_name,
                        'description' => $assemblyItem->ass_item_description,
                        'price' => $itemPrice,
                        'qty' => $itemQty,
                        'total' => $itemTotal
                        ];
                        }
                        @endphp
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        @foreach ($uniqueMaterialItems as $itemId => $itemData)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 w-[60%]">
                                {{ $itemData['name'] }}
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($itemData['description'])
                                <p class="font-medium">Description:</p>
                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $itemData['description']) !!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['price'], 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($itemData['qty'], 2) }}
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['total'], 2) }}
                            </td>
                        </tr>
                        @php
                        $totalMaterialPrice += $itemData['total']; // Add material item price to total
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        <div class="relative overflow-x-auto">
            <div class="itemDiv">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <!-- <th scope="col" class="px-6 py-3">

                            </th> -->
                            <th scope="col" class="px-6 py-3">
                                Item Name
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Item Cost
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Item Qty
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'material')
                        <tr class="bg-white border-b">
                            <!-- <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap">
                                <button type="button" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                                    <img class="h-[50px] w-[50px]" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </th> -->
                            <td class="px-6 py-4 w-[60%]">
                                {{ $item->item_name }}
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($item->item_description)
                                <p class="font-medium">Description:</p>
                                {!!formatText($item->item_description)!!}
                                @endif
                                @if ($item->item_note)
                                <p class="font-medium">Note:</p>
                                {!!formatText($item->item_note)!!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ $item->item_cost }}
                            </td>
                            <td class="text-center">
                                {{ $item->item_qty }}
                            </td>
                            <td class="text-center">
                                ${{ $item->item_total }}
                            </td>
                        </tr>
                        @php
                        $totalMaterialPrice += $item->item_total; // Add material item price to total
                        @endphp
                        @endif
                        @endforeach

                        @php
                        $uniqueMaterialItems = []; // Array to store unique material item IDs
                        @endphp

                        @foreach ($estimate_items as $item)
                        @if ($item->item_type === 'assemblies')
                        @foreach ($item->assemblies as $assemblyItem)
                        @if ($assemblyItem->ass_item_type === 'material')
                        @php
                        $itemId = $assemblyItem->est_ass_item_id;
                        $itemQty = $assemblyItem->ass_item_qty;
                        $itemTotal = $assemblyItem->ass_item_total;
                        $itemPrice = $assemblyItem->ass_item_price;
                        $itemKey = $itemId . '_' . $assemblyItem->est_ass_item_name . '_' . $assemblyItem->ass_item_description;

                        // Check if item ID is already encountered
                        if (isset($uniqueMaterialItems[$itemKey])) {
                        // Increment quantity and total if the item ID already exists
                        $uniqueMaterialItems[$itemKey]['qty'] += $itemQty;
                        $uniqueMaterialItems[$itemKey]['total'] += $itemTotal;
                        } else {
                        // Add new entry for the unique item
                        $uniqueMaterialItems[$itemKey] = [
                        'name' => $assemblyItem->est_ass_item_name,
                        'description' => $assemblyItem->ass_item_description,
                        'price' => $itemPrice,
                        'qty' => $itemQty,
                        'total' => $itemTotal
                        ];
                        }
                        @endphp
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        @foreach ($uniqueMaterialItems as $itemId => $itemData)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 w-[60%]">
                                {{ $itemData['name'] }}
                                <p class="text-[16px]/[18px] text-[#323C47] font">
                                    @if ($itemData['description'])
                                <p class="font-medium">Description:</p>
                                {!! preg_replace('/\*(.*?)\*/', '<b>$1</b>', $itemData['description']) !!}
                                @endif
                                </p>
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['price'], 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($itemData['qty'], 2) }}
                            </td>
                            <td class="text-center">
                                ${{ number_format($itemData['total'], 2) }}
                            </td>
                        </tr>
                        @php
                        $totalMaterialPrice += $itemData['total']; // Add material item price to total
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pt-4 px-4 pl-2 flex justify-end  py-7">
            <span>${{ number_format($totalMaterialPrice, 2) }}</span> {{-- Display the formatted total material price --}}
        </div>
    </div>
</div>
@endif
@if (session('user_details')['user_role'] == 'admin')
<div class="mb-5 shadow-lg bg-white  rounded-3xl mt-7 ">
    <div class="flex justify-between items-center px-3 py-3  bg-[#930027] rounded-t-3xl">
        <p class="text-lg px-3  text-white font-medium">
            Upgrade
        </p>
    </div>
    <div class="">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">

                </th>
                <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                    Item Name
                </th>
                <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                    Item Description
                </th>
                <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                    Item Cost
                </th>
                <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                    Item Qty
                </th>
                <th scope="col" class="text-center px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalUpgradePrice = 0; // Initialize total labor price variable
            @endphp
            @foreach ($estimate_items as $item)
            @if ($item->item_type === 'upgrades')

            <tr>
                <td>
                    <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                        <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                    </button>
                </td>
                <td>{{$item->item_name}} ({{$item->upgrade_status}})</td>
                <td class="w-[30%]">{{$item->item_description}}</td>
                <td class="text-center">${{number_format($item->item_price, 2)}}</td>
                <td class="text-center">{{number_format($item->item_qty, 2)}}</td>
                <td class="text-center">${{number_format($item->item_total, 2)}}</td>
            <tr>
                <td colspan="7">
                    <div class="">
                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                    <span></span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                <div class="p-2">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3"></th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Item Cost
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($item->assemblies as $assembly)
                                            <tr class="bg-white border-b">
                                                <td class="px-6 py-4"></td>
                                                <td class="px-6 py-4">
                                                    {{$assembly->est_ass_item_name}}
                                                </td>
                                                <td class="px-6 py-4 w-[30%]">
                                                    {{$assembly->ass_item_description}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <script>
                    document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                        var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                        accordionBody.classList.toggle("hidden");
                    });
                </script>
            </tr>
            </tr>

            @php
            $totalUpgradePrice += $item->item_total; // Add labor item price to total
            @endphp
            @endif
            @endforeach
        </tbody>
    </table>
</div>
    <div class="text-right mr-4 py-6">
        <span>${{ number_format($totalUpgradePrice, 2) }}</span> {{-- Display the formatted total labor price --}}
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
                <th scope="col" class="text-center px-6 py-3">
                    Item Cost
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Item Qty
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalUpgradePrice = 0; // Initialize total labor price variable
            @endphp
            @foreach ($estimate_items as $item)
            @if ($item->item_type === 'upgrades')

            <tr>
                <td>
                    <button type="button" style="height: 70px; width:70px;" id="editEstimate-item{{ $item->estimate_item_id }}" class="inline">
                        <img class="" style="height: 70px; width:70px;" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                    </button>
                </td>
                <td>{{$item->item_name}} ({{$item->upgrade_status}})</td>
                <td class="w-[30%]">{{$item->item_description}}</td>
                <td class="text-center">${{number_format($item->item_price, 2)}}</td>
                <td class="text-center">{{number_format($item->item_qty, 2)}}</td>
                <td class="text-center">${{number_format($item->item_total, 2)}}</td>
            <tr>
                <td colspan="7">
                    <div class="">
                        <div id="accordion-collapse{{$item->estimate_item_id}}" class="accordion-collapse mb-2" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1" class="border-b-2">
                                <button type="button" class="flex items-center bg-[#F5F5F5] justify-between w-full p-2  text-left rounded-t-lg  focus:ring-gray-200" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                    <span></span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body{{$item->estimate_item_id}}" class="accordion-collapse-body bg-[#F5F5F5] hidden" aria-labelledby="accordion-collapse-heading-1">
                                <div class="p-2">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3"></th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Item Description
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Item Cost
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Item Qty
                                                </th>
                                                <th scope="col" class="text-center px-6 py-3">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($item->assemblies as $assembly)
                                            <tr class="bg-white border-b">
                                                <td class="px-6 py-4"></td>
                                                <td class="px-6 py-4">
                                                    {{$assembly->est_ass_item_name}}
                                                </td>
                                                <td class="px-6 py-4 w-[30%]">
                                                    {{$assembly->ass_item_description}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    ${{number_format($assembly->ass_item_price, 2)}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    {{number_format($assembly->ass_item_qty, 2)}}
                                                </td>
                                                <td class="text-center mx-2">
                                                    ${{number_format($assembly->ass_item_total, 2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <script>
                    document.getElementById("accordion-collapse{{$item->estimate_item_id}}").addEventListener("click", function() {
                        var accordionBody = document.getElementById("accordion-collapse-body{{$item->estimate_item_id}}");
                        accordionBody.classList.toggle("hidden");
                    });
                </script>
            </tr>
            </tr>

            @php
            $totalUpgradePrice += $item->item_total; // Add labor item price to total
            @endphp
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="text-right mr-4 py-6">
        <span>${{ number_format($totalUpgradePrice, 2) }}</span> {{-- Display the formatted total labor price --}}
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
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Files
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estimate->estimateFiles as $file)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">
                            <a href="{{ asset('storage/' . $file->estimate_file) }}" class=" text-[#930027] hover:border-b border-[#930027]" target="_blank">
                                {{ $file->estimate_file_name }} ,
                            </a>
                        </td>
                        <td>
                            <form action="/deleteFile{{ $file->estimate_file_id }}" class="" method="post">
                                @csrf
                                <button type="submit" class="">
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif(isset($userPrivileges->estimate) &&
isset($userPrivileges->estimate->files) &&
$userPrivileges->estimate->files === 'on')
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
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Files
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estimate->estimateFiles as $file)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">
                            <a href="{{ asset('storage/' . $file->estimate_file) }}" class=" text-[#930027] hover:border-b border-[#930027]" target="_blank">
                                {{ $file->estimate_file_name }} ,
                            </a>
                        </td>
                        <td>
                            <form action="/deleteFile{{ $file->estimate_file_id }}" class="" method="post">
                                @csrf
                                <button type="submit" class="">
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@if (session('user_details')['user_role'] == 'admin')
<div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
    <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
        <a href="/viewGallery{{$estimate->estimate_id}}">
            <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
        </a>
        <p class="text-lg px-3 text-white  font-medium ">
            Photos
        </p>
    </div>
    <div class=" mx-auto  px-5 py-7">
        <div class="itemDiv">
            @foreach ($estimate->images as $image)
            <div class=" relative inline-block">
                <div class="absolute z-[8] right-1 top-1">
                    <form method="post" action="/addAsAttachment">
                        @csrf
                        <input type="checkbox" name="attachment_checkbox" id="attachment_checkbox{{$image->estimate_image_id}}" {{ $image->attachment == 1 ? 'checked' : '' }}>
                        <label for="attachment_checkbox{{$image->estimate_image_id}}" class=" text-gray-500"></label>
                        <input type="hidden" name="add_not_add" id="add_not_add" value="{{ $image->attachment == 0 ? 1 : 0 }}">
                        <input type="hidden" name="estimate_img_id" id="estimate_img_id" value="{{$image->estimate_image_id}}">
                    </form>
                </div>
                <div class=" inline-block">
                    <a href="/viewGallery{{ $image->estimate_id }}">
                        <div class=" inline-block p-2 mx-auto">
                            <img class=" w-20 h-20 rounded-md hover:scale-105 duration-300" src="{{ $image->estimate_image }}" alt="Estimate Image">
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@elseif(isset($userPrivileges->estimate) &&
isset($userPrivileges->estimate->photos) &&
$userPrivileges->estimate->photos === 'on')
<div class="mb-5 shadow-lg bg-white  mt-7 rounded-3xl">
    <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
        <a href="/viewGallery{{$estimate->estimate_id}}">
            <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
        </a>
        <p class="text-lg px-3 text-white  font-medium ">
            Photos
        </p>
    </div>
    <div class=" mx-auto  px-5 py-7">
        <div class="itemDiv">
            @foreach ($estimate->images as $image)
            <a href="/viewGallery{{ $image->estimate_id }}">
                <div class=" inline-block p-2 mx-auto">
                    <img class=" w-16 h-16 rounded-md hover:scale-105 duration-300" src="{{ asset('storage/' . $image->estimate_image) }}" alt="Estimate Image">
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
@if (session('user_details')['user_role'] == 'admin')
<div class="mb-5 shadow-lg bg-white mt-7  rounded-3xl">
    <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
        <!-- <a href="/makeProposal/{{ $estimate->estimate_id }}"> -->
            <button type="button" id="addProposal" class="flex bg-white p-1 m-2 rounded-lg">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
        <!-- </a> -->
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
                                Type
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
                            <th scope="col" class="px-6 py-3">
                                View Count
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Last Viewed
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer Signature
                            </th>
                            <th scope="col" class="px-6 py-3">
                                View
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalProposals = count($estimate->proposals);
                        $currentIndex = 0;
                        @endphp
                        @foreach ($estimate->proposals as $proposal)
                        @php
                        $currentIndex++;
                        @endphp
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($proposal->created_at)) }}
                            </th>
                            <td class="px-6 py-4">
                            @if($proposal->proposal_type === 'estimate')
                                    Estimate
                                    @else
                                    Change Order
                                    @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($proposal->proposal_total, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($proposal->proposal_accepted, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proposal->proposal_status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proposal->view_count }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proposal->last_viewed_at ? date('m/d/y, h:i A', strtotime($proposal->last_viewed_at)) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($proposal->customer_signature)
                                <img src="{{ $proposal->customer_signature }}" class=" w-16 h-12" alt="Customer Signature">
                                @else
                                No Signature
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    @if(!empty($proposal->proposal_data))
                                    <a href="{{ $proposal->proposal_status === 'pending'
                                        ? '/viewProposal?estimateId=' . $proposal->estimate_proposal_id
                                        : '/viewProposal?proposalId=' . $proposal->estimate_proposal_id }}{{ $proposal->group_id ? '&group_id=' . $proposal->group_id : '' }}">
                                        <button class="px-2 py-2">
                                            <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                        </button>
                                    </a>
                                    @endif
                                    @if($proposal->proposal_status == 'pending')
                                    <form action="/acceptProposal/{{ $estimate->estimate_id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="proposal_id" value="{{ $proposal->estimate_proposal_id }}">
                                        <input type="hidden" name="proposal_group_id" value="{{ $proposal->group_id }}">
                                        <input type="hidden" name="estimate_total" value="{{ $proposal->proposal_total + ($proposal->proposal_total * $estimate->tax_rate) / 100 }}">
                                        <button class="px-2 py-2" title="Accept without signature">
                                            <i class="fa-solid fa-clipboard-check" style="color: #930027; font-size: 25px;"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
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
    <div class="flex  items-center px-3  bg-[#930027] rounded-t-3xl">
        <!-- <a href="/makeProposal/{{ $estimate->estimate_id }}"> -->
            <button type="button" id="addProposal" class="flex bg-white p-1 m-2 rounded-lg">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
        <!-- </a> -->
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
                                Type
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
                            <th scope="col" class="px-6 py-3">
                                Customer Signature
                            </th>
                            <th scope="col" class="px-6 py-3">
                                View
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalProposals = count($estimate->proposals);
                        $currentIndex = 0;
                        @endphp
                        @foreach ($estimate->proposals as $proposal)
                        @php
                        $currentIndex++;
                        @endphp
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($proposal->created_at)) }}
                            </th>
                            <td class="px-6 py-4">
                            @if($proposal->proposal_type === 'estimate')
                                    Estimate
                                    @else
                                    Change Order
                                    @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($proposal->proposal_total, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($proposal->proposal_accepted, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proposal->proposal_status }}
                            </td>
                            <td class="px-6 py-4">
                                @if($proposal->customer_signature)
                                <img src="{{ $proposal->customer_signature }}" class="w-16 h-12" alt="Customer Signature">
                                @else
                                No Signature
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    @if(!empty($proposal->proposal_data))
                                    <a href="{{ $proposal->proposal_status === 'pending'
                                        ? '/viewProposal?estimateId=' . $proposal->estimate_proposal_id
                                        : '/viewProposal?proposalId=' . $proposal->estimate_proposal_id }}{{ $proposal->group_id ? '&group_id=' . $proposal->group_id : '' }}">
                                        <button class="px-2 py-2">
                                            <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                        </button>
                                    </a>
                                    @endif
                                    @if($proposal->proposal_status == 'pending')
                                    <form action="/acceptProposal/{{ $estimate->estimate_id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="proposal_id" value="{{ $proposal->estimate_proposal_id }}">
                                        <input type="hidden" name="proposal_group_id" value="{{ $proposal->group_id }}">
                                        <input type="hidden" name="estimate_total" value="{{ $proposal->proposal_total + ($proposal->proposal_total * $estimate->tax_rate) / 100 }}">
                                        <button class="px-2 py-2" title="Accept without signature">
                                            <i class="fa-solid fa-clipboard-check" style="color: #930027; font-size: 25px;"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
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
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Date
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Title
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Sent To
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Email Subject
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate->estimateEmails as $email)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($email->created_at)) }}
                            </th>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $email->email_name }}
                            </td>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $email->email_to }}
                            </td>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
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
</div>
@elseif(isset($userPrivileges->estimate) &&
isset($userPrivileges->estimate->emails) &&
$userPrivileges->estimate->emails === 'on')
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
                        @foreach ($estimate->estimateEmails as $email)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($email->created_at)) }}
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
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $toDo->to_do_title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $toDo->assigned_by ? $toDo->assigned_by->name : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $toDo->assigned_to ? $toDo->assigned_to->name : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('m/d/y', strtotime($toDo->start_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('m/d/y', strtotime($toDo->end_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $toDo->to_do_status }}
                            </td>
                            <td class="px-6 py-4">
                                @if($toDo->to_do_status != 'complete')
                                <form action="/completeToDo{{$toDo->to_do_id}}" method="post">
                                    @csrf
                                    <button type="submit" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                        Complete
                                    </button>
                                </form>
                                @endif
                                <form action="/deleteToDo{{$toDo->to_do_id}}" class="" method="post">
                                    @csrf
                                    <button type="submit" class="">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
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
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $toDo->to_do_title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $toDo->assigned_by->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $toDo->assigned_to->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('m/d/y', strtotime($toDo->start_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('m/d/y', strtotime($toDo->end_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $toDo->to_do_status }}
                            </td>
                            <td class="px-6 py-4">
                                @if($toDo->to_do_status != 'complete')
                                <form action="/completeToDo{{$toDo->to_do_id}}" method="post">
                                    @csrf
                                    <button type="submit" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                        Complete
                                    </button>
                                </form>
                                @endif
                                <form action="/deleteToDo{{$toDo->to_do_id}}" class="" method="post">
                                    @csrf
                                    <button type="submit" class="">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
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
        <button type="button" class=" add-payment flex bg-white p-1 m-2 rounded-lg" id="addInvoice-btn">
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
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate->invoices as $invoices)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($invoices->complete_invoice_date)) }}
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
                            <td>
                                <button id="edit-invoice{{ $invoices->estimate_complete_invoice_id }}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                </button>
                                <button>
                                    <form action="/deleteInvoice/{{ $invoices->estimate_complete_invoice_id }}" id="deleteForm" class="deleteForm" method="post">
                                        @csrf
                                        <button type="submit" id="deleteButton" class="deleteButton">
                                            <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                        </button>
                                    </form>
                                </button>
                                <a href="/viewInvoice/{{ $invoices->estimate_complete_invoice_id }}">
                                    <button>
                                        <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                    </button>
                                </a>
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
        <button type="button" class=" complete-payment flex bg-white p-1 m-2 rounded-lg" id="complete-payment">
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
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Date
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Description
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Total
                            </th>
                            <th scope="col" class="px-2 py-3 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payments)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($payments->complete_invoice_date)) }}
                            </th>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $payments->note }}
                            </td>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                {{ $payments->invoice_total }}
                            </td>
                            <td class="px-2 py-4 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                <button id="edit-payment{{ $payments->estimate_complete_invoice_id }}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="icon">
                                </button>
                                <button>
                                    <form action="/deletePayment/{{ $payments->estimate_payment_id }}" class="" class="inline-block" method="post">
                                        @csrf
                                        <button type="submit" class="">
                                            <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                        </button>
                                    </form>
                                </button>
                                <a href="/viewPayment/{{ $payments->estimate_payment_id }}">
                                    <button>
                                        <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="icon">
                                    </button>
                                </a>
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
                            <th></th>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr class="bg-white border-b">
                            <td>
                                <button type="button" id="editExpense-btn{{ $expense->estimate_expense_id }}" class="flex">
                                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($expense->expense_date)) }}
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
                                ${{ $expense->expense_paid }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ $expense->expense_total }}
                            </td>
                            <td>
                                <form action="/deleteEstimateExpense/{{$expense->estimate_expense_id}}" class="" method="post">
                                    @csrf
                                    <button type="submit" class="">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th colspan="8" scope="col" class="px-6 py-3 text-center">Vendors</th>
                        </tr>
                        @foreach($vendorTotals as $vendorId => $total)
                        <tr class="text-right">
                            <th colspan="6" scope="col" class="px-6 py-3">{{$vendorId}}</th>
                            <th colspan="2" scope="col" class="px-6 py-3">${{$total}}</th>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@elseif(isset($userPrivileges->estimate) &&
isset($userPrivileges->estimate->expenses) &&
$userPrivileges->estimate->expenses === 'on')
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
                            <th></th>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr class="bg-white border-b">
                            <td>
                                <button type="button" id="editExpense-btn{{ $expense->estimate_expense_id }}" class="flex">
                                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                                </button>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('m/d/y', strtotime($expense->expense_date)) }}
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
                                ${{ $expense->expense_paid }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ $expense->expense_total }}
                            </td>
                            <td>
                                <form action="/deleteEstimateExpense/{{$expense->estimate_expense_id}}" class="" method="post">
                                    @csrf
                                    <button type="submit" class="">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th colspan="8" scope="col" class="px-6 py-3 text-center">Vendors</th>
                        </tr>
                        @foreach($vendorTotals as $vendorId => $total)
                        <tr class="text-right">
                            <th colspan="6" scope="col" class="px-6 py-3">{{$vendorId}}</th>
                            <th colspan="2" scope="col" class="px-6 py-3">${{$total}}</th>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
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
                            <input type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX" required autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addProposal-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Proposal</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <h2 class=" text-lg font-medium">Type:</h2>
                    </div>
                    <div class=" grid grid-cols-2 gap-2  py-2">
                        <div>
                            <input type="radio" name="makeProposal" id="makeProposal"> <label for="makeProposal">Estimate</label>
                        </div>
                        <div>
                            ${{ number_format($modalTotal, 2) }}
                        </div>
                        <div>
                            <input type="radio" name="makeProposal" id="makeChangeOrder"> <label for="makeChangeOrder">Change Order</label>
                        </div>
                        <div>
                            <select name="changeOrder" id="changeOrder-select" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" disabled>
                                <option value="">Select Group</option>
                                @foreach ($groupTotals as $item)
                                <option value="{{ $item['group_id'] }}">{{ $item['group_name'] }} ({{ $item['total'] }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <a href="/makeProposal/{{ $estimate->estimate_id }}" id="makeProposal-url">
                            <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                <div class=" text-center hidden spinner" id="spinner">
                                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                </div>
                                <div class="text" id="text">
                                    Create
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                            <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                            <input type="file" name="upload_image[]" id="upload_image" multiple>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                            <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                            <input type="file" name="upload_file" id="upload_file">
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                            <input type="text" name="task_name" id="task_name" required placeholder="Title" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2" id="">
                            <label for="" class=" block">Who:</label>
                            <select name="assign_work[]" id="assign_work" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}
                                    {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            When Should it be completed?
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" placeholder="Last Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">End Date:</label>
                            <input type="date" name="end_date" id="end_date" required placeholder="" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="estimate_note">Add Note:</label>
                            <textarea name="note" id="note" placeholder="Add Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateExpense" method="post" id="expenses-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <input type="hidden" value="" name="estimate_expense_id" id="estimate_expense_id">
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
                            <input type="date" name="date" id="date" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Item Type:</label>
                            <select name="item_type" id="item_type" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="material">material</option>
                                <option value="labour">labor</option>
                            </select>
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Vendor:</label>
                            <input type="text" name="vendor" id="vendor" placeholder="Vendor" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Hours:</label>
                            <input type="number" step="any" name="hours" id="hours" placeholder="Hours" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Subtotal:</label>
                            <input type="number" step="any" name="subtotal" id="subtotal" placeholder="Subtotal" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Tax:</label>
                            <input type="number" step="any" name="tax" id="tax" placeholder="Tax" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="" id="">
                            <label for="" class=" block">Total:</label>
                            <input type="number" step="any" name="total" id="total" placeholder="Total" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-5" id="">
                            <input type="checkbox" name="paid" id="paid" value="paid">
                            <label for="paid">Paid</label>
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-8" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
                    <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Emails</h2>
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
                            @foreach ($email_templates as $emails)
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
                        <input type="hidden" name="customer_id" value="{{$estimate->customer->customer_id}}">
                        <div>
                            <label for="email_title">Email title:</label>
                            <input type="text" name="email_name" id="email_name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <label for="email_to">Email to:</label>
                            <input type="text" name="email_to" id="email_to" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $estimate->customer->customer_email }}">
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
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
                        <button type="button" class=" my-2 modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Other Labor Hours
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                        Labor
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Tracked Labor
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Other Labor
                                    </th>
                                    <td class="px-6 py-4">
                                        ___
                                    </td>
                                    <td class="px-6 py-4">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Expense Labor
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
                                    <th scope="row" class="px-6 py-3 text-base">Total Labor</th>
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/setSchedule" id="schedule-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $estimate->customer->customer_first_name }} {{ $estimate->customer->customer_last_name }}
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_primary_address }},
                            {{ $estimate->customer->customer_city }}, {{ $estimate->customer->customer_state }},
                            {{ $estimate->customer->customer_zip_code }}
                        </p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete work?</p>
                            <select name="assign_work" id="assign_work" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select User</option>
                                @foreach ($employees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}
                                    {{ $user->last_name }}
                                </option>
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" en_date  w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <textarea placeholder="Note " class=" w-[100%] outline-none rounded-md p-2 border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="note" id="note"></textarea>
                    <!-- You can customize this part according to your needs -->
                    <div>
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Set
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeEstimate" id="complete-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $estimate->customer->customer_first_name }} {{ $estimate->customer->customer_last_name }}
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_primary_address }},
                            {{ $estimate->customer->customer_city }}, {{ $estimate->customer->customer_state }},
                            {{ $estimate->customer->customer_zip_code }}
                        </p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who will complete estimate?</p>
                            <input type="text" id="estimator_name" disabled value="{{ $user_details['name'] }}" name="estimator_name" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" id="estimator_id" value="{{ $user_details['id'] }}" name="estimator_id" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will follow up on work acceptence:</label>
                        <select name="assign_estimate" id="assign_estimate" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" en_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="complete_estimate_note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            Complete Estimate
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeWorkAndAssignInvoice" method="post" id="complete-work-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $estimate->customer->customer_first_name }} {{ $estimate->customer->customer_last_name }}
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_primary_address }},
                            {{ $estimate->customer->customer_city }}, {{ $estimate->customer->customer_state }},
                            {{ $estimate->customer->customer_zip_code }}
                        </p>
                    </div>
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Who completed the work Order?</p>
                            <input type="text" id="estimator_name" disabled value="{{ $user_details['name'] }}" name="estimator_name" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" id="work_completed_by" value="{{ $user_details['id'] }}" name="work_completed_by" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">What is the complete work date?</p>
                            <input type="date" id="complete_work_date" name="complete_work_date" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <hr>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will Complete and Send Invoice?</label>
                        <select name="assign_invoice" id="assign_invoice" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" en_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
                            Work
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/completeInvoiceAndAssignPayment" method="post" id="complete-invoice-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $estimate->customer->customer_first_name }} {{ $estimate->customer->customer_last_name }}
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_primary_address }},
                            {{ $estimate->customer->customer_city }}, {{ $estimate->customer->customer_state }},
                            {{ $estimate->customer->customer_zip_code }}
                        </p>
                    </div>
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">What is the complete invoice date?</p>
                            <input type="date" id="complete_invoice_date" name="complete_invoice_date" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                            </button> -->
                        </div>
                    </div>
                    <hr>
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Who will follow up on payment?</label>
                        <select name="assign_payment" id="assign_payment" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" en_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Complete
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            @if($estimate->estimate_total != null)
            <form action="/completeInvoiceAndAssignPayment" method="post" id="add-payment-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="po_number" id="po_number_id" value="{{ $estimate->po_number }}">
                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Invoice</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>

                    <!-- task details -->
                    <div id="dropdown-div" class="">
                        <label for="assiegne-estimate">Details:</label>
                        <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                    </div>
                    <div class=" grid grid-cols-2 gap-3 mb-2">
                        <div>
                            <label for="">Date:</label>
                            <input type="date" id="invoice_date" name="complete_invoice_date" value="" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            <label for="">Name:</label>
                            <input type="text" id="invoice_name" name="invoice_name" value="" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" list="invoice_names">
                            <datalist id="invoice_names">
                                <option value="Deposit Invoice">Deposit Invoice</option>
                                <option value="Progress Invoice">Progress Invoice</option>
                                <option value="Final Invoice">Final Invoice</option>
                                <option value="Credit Invoice">Credit Invoice</option>
                            </datalist>
                        </div>
                    </div>
                    <hr>
                    <div id="invoiceAmountDiv">
                        <div id="dropdown-div" class="">
                            <label for="assiegne-estimate">Amount:</label>
                            <!-- <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button> -->
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div class=" col-span-2 mx-auto mt-3">
                                <div class="flex items-center mb-4">
                                    <input id="remaining_amount" type="radio" name="payment_option" value="remaining" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="remaining_amount" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remaining (${{$remainingEstimateTotal}})</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="percent_of_total" type="radio" name="payment_option" value="percent" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="percent_of_total" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">% of Total (${{ $estimate->discounted_total != null ? $estimate->discounted_total : $estimate->estimate_total }})</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="fixed_total" type="radio" name="payment_option" value="fixed" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="fixed_total" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fixed Total (${{ $estimate->discounted_total != null ? $estimate->discounted_total : $estimate->estimate_total }})</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="custom_amount" type="radio" name="payment_option" value="custom" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="custom_amount" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Custom Amount</label>
                                </div>
                                <!-- <label for="">%:</label>
                            <select name="amount_percentage" id="amount_percentage" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">Select</option>
                                <option value="10%">10%</option>
                                <option value="20%">20%</option>
                                <option value="30%">30%</option>
                                <option value="40%">40%</option>
                                <option value="50%">50%</option>
                            </select> -->
                            </div>
                            <div class="">
                                <div>
                                    <label for="">Percent (%):</label>
                                    <input type="number" id="percent_input" step="any" name="percent_input" value="" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly>
                                </div>
                                <div>
                                    <label for="">Fixed ($):</label>
                                    <input type="number" id="fixed_input" step="any" name="fixed_input" value="" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="col-span-3">
                            <div class="flex justify-around gap-3">
                                <div>
                                    <label for="">Subtotal ($):</label>
                                    <input type="number" id="subtotal_input" step="any" name="subtotal_input" value="{{$remainingEstimateTotal}}" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly>
                                </div>
                                <div>
                                    <label for="">Tax ($):</label>
                                    <input type="number" id="tax_input" step="any" name="tax_input" value="" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly>
                                </div>
                                <div>
                                    <label for="">Total ($):</label>
                                    <input type="number" id="total_input" step="any" name="total_input" value="{{$remainingEstimateTotal}}" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="complete-payment-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addPayment" method="post" id="complete-payment-form">
                @csrf
                @if (isset($estimate->invoice->invoice_status) && $estimate->invoice->invoice_status == 'unpaid')
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="po_number" id="po_number" value="{{ $estimate->po_number }}">
                <input type="hidden" name="payment_id" id="payment_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Payment</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>

                    <!-- task details -->
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Invoice:</p>
                            <input type="text" id="invoice" name="invoice" value="{{ $estimate->invoice->invoice_name }} (Due {{ $estimate->invoice->invoice_due }})" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" name="invoice_id" value="{{ $estimate->invoice->estimate_complete_invoice_id }}">
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
                            <input type="date" id="invoice_date" name="invoice_date" value="{{ date('Y-m-d', strtotime($estimate->invoice->complete_invoice_date)) }}" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            <label for="">Amount:</label>
                            <input type="text" id="invoice_amount" name="invoice_amount" value="{{ $estimate->invoice->invoice_due }}" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="invoice_note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
                @else
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <input type="hidden" name="po_number" id="po_number" value="{{ $estimate->po_number }}">
                <input type="hidden" name="payment_id" id="payment_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">Payment</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>

                    <!-- task details -->
                    <div class=" mb-2">
                        <div id="dropdown-div" class="">
                            <p class=" font-medium items-center">Invoice:</p>
                            <input type="text" id="invoice" name="invoice" value="" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <input type="hidden" name="invoice_id" value="">
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
                            <input type="date" id="invoice_date" name="invoice_date" value="" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            <label for="">Amount:</label>
                            <input type="text" id="invoice_amount" name="invoice_amount" value="" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="invoice_note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
                @endif
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/scheduleEstimate" id="accept-estimate-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 text-[#F5222D] " id="modal-title">
                            {{ $estimate->customer->customer_first_name }} {{ $estimate->customer->customer_last_name }}
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/home-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_primary_address }},
                            {{ $estimate->customer->customer_city }}, {{ $estimate->customer->customer_state }},
                            {{ $estimate->customer->customer_zip_code }}
                        </p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_email }}</p>
                    </div>
                    <div>
                        <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                        <p class=" font-medium inline-block items-center">{{ $estimate->customer->customer_phone }}</p>
                    </div>
                    <div>
                        <div id="estimators" class="">
                            <img class=" inline-block" src="{{ asset('assets/icons/mail-icon.svg') }}" alt="icon">
                            <p class=" font-medium inline-block items-center">Estimator: {{ $user_details['name'] }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label for="assiegne-estimate">Who will schedule Work?</label>
                        <select name="schedule_work" id="schedule_work" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                        <input type="date" name="start_date" id="start_date" autocomplete="given-name" class=" se_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class=" flex justify-start gap-3 mb-2">
                        <label>End date:</label>
                        <input type="date" name="end_date" id="end_date" autocomplete="given-name" class=" en_date w-[80%] outline-none rounded-md border-0 text-gray-400 p-1 ml-1 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <div class="my-2 col-span-2 relative">
                        <label for="" class="block text-left mb-1"> Note: </label>
                        <textarea name="note" id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class=" float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            Assign Schedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="apply-discount-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/applyDiscount" id="apply-discount-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{ $estimate->estimate_id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold mb-2 text-[#F5222D]" id="modal-title">
                            Apply Discount
                        </h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="select_discount_type" class="block text-left text-sm mb-1">Select Type</label>
                            <select id="select_discount_type" name="select_discount_type" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">Select Type</option>
                                <option value="percent">By Percentage (%)</option>
                                <option value="price">By Price ($)</option>
                            </select>
                        </div>
                        <div>
                            <label for="percentage_input" class="block text-left text-sm mb-1">%</label>
                            <input type="text" name="percentage" id="percentage_input" class="p-2 w-[100%] outline-none rounded-md text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly value="{{$estimate->percentage_discount}}">
                        </div>
                        <div>
                            <label for="price_input" class="block text-left text-sm mb-1">$</label>
                            <input type="text" name="price" id="price_input" class="p-2 w-[100%] outline-none rounded-md text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly value="{{$estimate->price_discount}}">
                        </div>
                        <div class="col-span-2">
                            <label for="total" class="block text-left text-sm mb-1">Total</label>
                            <input type="number" name="discounted_total" id="discounted_total" class="p-2 w-[100%] outline-none rounded-md text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6 bg-gray-200" readonly value="{{ is_null($estimate->discounted_total) ? number_format($totalPrice, 2) : number_format($estimate->discounted_total, 2) }}">
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="button" class="modalClose-btn border border-black font-semibold py-1 px-7 rounded-lg modal-close">Back</button>
                        <button id="" class="float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900">Save</button>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                        <div class="  col-span-4 my-0">
                            <label for="" class="block text-left text-sm mb-1">Select Item</label>
                            <select id="selected_item" name="selected_item" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md  -0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">select item</option>
                                <option value="upgrades">Upgrades</option>
                                @foreach ($items as $item)
                                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="  col-span-4 my-0">
                            <label for="" class="block text-left text-sm mb-1"> Items Type</label>
                            <select id="type" name="item_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option value="upgrades">Upgrades</option>
                                <option value="labour">labor</option>
                                <option value="material">Material</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class="  col-span-4 my-0">
                            <label for="" class="block text-left text-sm mb-1"> Additional Item</label>
                            <select id="additional_item" name="additional_item" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                            <label for="" class="block text-left text-xs text-[#930027]"> Change Order</label>
                        </div>
                        <div class=" my-0 col-span-6">
                            <label for="" class="block  text-left text-sm mb-1"> Item Name</label>
                            <input type="text" name="item_name" id="itemName" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 col-span-6">
                            <label for="" class="block text-left text-sm mb-1"> Item Unit</label>
                            <input type="text" id="item_units" name="item_units" autocomplete="customer-name" placeholder="Units(Optional)" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="my-0 col-span-4 text-left">
                            <label for="" class=" block text-left text-sm mb-1">Price:</label>
                            <input type="number" step="any" name="item_price" id="item_price" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Margin: <span id="price_margin">0.00</span>%</span>
                        </div>
                        <div class="my-0 text-left col-span-4">
                            <div class="flex justify-around items-center">
                                <div class="relative inline-block text-left mt-2">
                                    <button type="button" class="bg-[#930027] py-[6px] px-2 mt-4 rounded-l-md text-white">
                                        <div id="cal-menubutton" class=" cursor-pointer" aria-expanded="true" aria-haspopup="true">
                                            {{-- <img id="calculater-modal"  class=" inline-block" src="{{ asset('assets/icons/calculator-icon.svg') }}"
                                            alt="icon"> --}}
                                            <i id="calculater-modal" class="fa-solid fa-calculator"></i>
                                        </div>
                                    </button>
                                    {{-- ====================== --}}
                                    <div class="absolute  text-left h-[100%]  z-[999] " <div id="cal-menu" style="background-color:#3a4655 !important;" class=" topbar-manuLeaving   z-10 mt-2 w-56 origin-top-right rounded-md bg-[#3a4655] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                        <div class="py-1 left-5" role="none">
                                            <div class="relative  bg-[#3a4655]">
                                                <input class="block mx-2 mt-2 border bg-[#3a4655] h-[30px] rounded text-white border-white " type="text" readonly id="cal_display">
                                                <div class="grid text-white grid-cols-4 gap-y-3  p-2 mt-3">
                                                    <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">%</button>
                                                    <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">/</button>
                                                    <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">
                                                        << /button>
                                                            <button id="clear_btn" type="button" class=" border rounded text-center mx-1  h-[30px] ">C</button>

                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">7</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">8</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">9</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">*</button>

                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">4</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">5</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">6</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">-</button>

                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">1</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">2</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">3</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">+</button>

                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">0</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px]">00</button>
                                                            <button type="button" class="cal_btn border rounded text-center mx-1  h-[30px] ">.</button>
                                                            <button id="equal_btn" type="button" class=" border rounded text-center mx-1  h-[30px] ">=</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- ====================== --}}
                                <div>
                                    <label for="" class=" block text-left text-sm mb-1">Quantity:</label>
                                    <input type="number" step="any" name="item_qty" id="item_qty" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-r-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="my-0 text-left col-span-4">
                            <label for="" class=" block text-left text-sm mb-1">Total:</label>
                            <input type="number" step="any" name="item_total" id="item_total" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 text-left col-span-4">
                            <label for="" class=" block text-left text-sm mb-1">Cost ($/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="item_cost" id="item_cost" placeholder="0.00" readonly autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 bg-gray-200 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-0 col-span-4" id="labourExpense">
                            <label for="" class="block text-left text-sm mb-1"> Labor Cost (min/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="labour_expense" id="labour_expense" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Labor Cost: $25.00/hr</span>
                        </div>
                        <div class="my-0 col-span-4" id="materialExpense">
                            <label for="" class="block text-left text-sm mb-1"> material Cost ($/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="material_expense" id="material_expense" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-0 col-span-12 hidden" id="multiAdd-items">
                            <div id="mulitple_input">
                                <label for="" class="block text-left text-sm mb-1"> Assembly Name </label>
                                <!-- <div id="item_main">
                                    <select name="assembly_name[]" id="assembly_name" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <option value="">Select Item</option>
                                        @foreach ($itemsForAssemblies as $item)
                                        <option value="{{ $item->item_name }}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class=" grid grid-cols-2 gap-3 mt-2">
                                        <div>
                                            <input type="text" step="any" name="assembly_unit_by_item_unit[]" id="assembly_unit_by_item_unit" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                                        </div>
                                        <div>
                                            <input type="text" step="any" name="item_unit_by_assembly_unit[]" id="item_unit_by_assembly_unit" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">LNFT</span>/<span class="unit">unit</span></span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="addbtn" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left text-sm mb-1"> Item Description </label>
                            <textarea name="item_description" id="item_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4" onclick="voice('description-mic', 'item_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left text-sm mb-1"> Note </label>
                            <textarea name="item_note" id="item_note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'item_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class="my-0 col-span-4" id="">
                            <label for="" class="block text-left text-sm mb-1">Group</label>
                            <input type="text" step="any" name="group_name" id="group_name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-ins.et focus:ring-[#0095E5] sm:text-sm" list="goup_names">
                            <datalist id="goup_names">
                                @foreach($groups as $item)
                                <option value="{{ $item->group_name }}">{{ $item->group_name }}</option>
                                @endforeach
                            </datalist>
                            <!-- <input type="hidden" name="group_id" id="group_id"> -->
                        </div>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
            <form action="/deleteEstimateItem/" method="post" id="deleteEstimateItem" class="inline-block ml-4">
                @csrf
                <button id="deleteItem-btn" class=" mb-2 mx-2 float-right bg-[#fff] border-2 py-1 px-7 hidden rounded-md">Delete</button>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addItemTemplate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateItemTemplate" method="post" enctype="multipart/form-data" id="itemTemplatesForm">
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
                        <div class="my-0 col-span-12" id="">
                            <label for="" class="block text-left text-sm mb-1">Group Name</label>
                            <input type="text" step="any" name="group_name" id="group_name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-ins.et focus:ring-[#0095E5] sm:text-sm" list="goup_names">
                            <datalist id="goup_names">
                                @foreach($groups as $item)
                                <option value="{{ $item->group_name }}">{{ $item->group_name }}</option>
                                @endforeach
                            </datalist>
                            <!-- <input type="hidden" name="group_id" id="group_id"> -->
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Item Description </label>
                            <textarea name="estimate_template_description" id="estimate_template_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4" onclick="voice('description-mic', 'estimate_template_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class="my-0 col-span-12 relative">
                            <label for="" class="block text-left mb-1"> Note </label>
                            <textarea name="estimate_template_note" id="estimate_template_note" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'estimate_template_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="updateEvent" class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
            <form action="/deleteEstimateTemplate/" method="post" id="deleteEstimateTemplate" class="inline-block ml-4">
                @csrf
                <button id="deleteTemplate-btn" class=" mb-2 mx-2 float-right bg-[#fff] border-2 py-1 px-7 hidden rounded-md">Delete</button>
            </form>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="sendProposal-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                </div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="/sendProposal" method="post">
                    @csrf
                    <input type="hidden" name="estimate_id" value="{{ $estimate->estimate_id }}">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <!-- Modal content here -->
                            <div class=" flex justify-between border-b-2">
                                <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Send Proposal Mail!</h2>
                                <button class="modal-close" type="button">
                                    <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                            <!-- task details -->
                            <input type="hidden" name="secondProposal" value="1">
                            <div class=" grid grid-cols-2 gap-4 my-2">
                                <input type="hidden" name="email_id" id="email_id">
                                <div>
                                    <label for="email_title">Email title:</label>
                                    <input type="text" name="email_title" id="email_title" value="Proposal Email" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                                <div>
                                    <label for="email_to">Email to:</label>
                                    <input type="text" name="email_to" id="email_to" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $estimate->customer->customer_email }}">
                                    <p class="text-[#930027] text-xs">Please use "," to send mail to multiple persons.</p>
                                </div>
                                <div class=" col-span-2">
                                    <label for="email_subject">Email Subject:</label>
                                    <textarea name="email_subject" id="email_subject" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">Proposal Mail</textarea>
                                </div>
                                <div class=" col-span-2">
                                    <label for="email_body">Email body:</label>
                                    <textarea name="email_body" id="email_body" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" rows="10">Hi {{ ucfirst($estimate->customer->customer_first_name)}}!
Thank you for the opportunity to provide you with an estimate.</textarea>
                                </div>
                            </div>
                            <div class="">
                                <button id="saveButton" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md">
                                    <div class=" text-center hidden spinner" id="spinner">
                                        <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                        </svg>
                                    </div>
                                    <div class="text" id="text">
                                        Send
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="Estimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg">
            <form action="/updateEstimateDetail" method="post" id="addEstimate-form">
                @csrf
                <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Edit Customer</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class=" flex justify-between border-b-2 mb-2 col-span-full mt-4">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Contact</h2>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">First Name</h5>
                            <input type="text" name="first_name" id="customer_first_name" placeholder="First Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Last Name</h5>
                            <input type="text" name="last_name" id="customer_last_name" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Phone No.</h5>
                            <input type="tel" name="phone" id="customer_phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" autocomplete="given-name" class="mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" pattern="([0-9]{3}-?[0-9]{3}-?[0-9]{4})(/[0-9]{3}-?[0-9]{3}-?[0-9]{4})*" title="Phone number must be in the format XXX-XXX-XXXX or XXXXXXXXXX, separated by slashes" required>
                            <span class=" text-[#930027]" style="font-size:12px;">Please use "/" to add more than one number.</span>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Name (Optional)</h5>
                            <input type="text" name="project_name" id="customer_project_name" placeholder="Project Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="  ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Number (Optional)</h5>
                            <input type="text" step="any" name="project_number" id="customer_project_number" placeholder="Project Number (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Type (Optional)</h5>
                            <input type="text" step="any" name="project_type" id="customer_project_type" placeholder="Project Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Building Type (Optional)</h5>
                            <select name="building_type" id="customer_building_type" placeholder="Building Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class=" flex justify-between border-b-2 mb-2 col-span-full  mt-1 mb-3">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Billing</h2>
                        </div>
                        <div class=" col-span-full ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address</h5>
                            <input type="text" name="first_address" id="customer_first_address" placeholder="Address 1" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Tax</h5>
                            <input type="number" step="any" name="tax_rate" id="customer_tax_rate" placeholder="Tax Rate (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Owner</h5>
                            <select class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" name="owner" id="customer_owner" required>
                                <option>Select User</option>
                                @foreach($employees as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Internal Note</h5>
                            <input type="text" class="mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" name="internal_note" id="internal_note" value="{{ $estimate->estimate_internal_note }}" placeholder="Internal Note">
                        </div>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=" absolute bottom-10 right-10 z-30">
    <div class="flex justify-center items-center">
        <div class="text-white bg-[#930027] flex justify-center items-center h-10 p-2 rounded-[10px] me-[-5px]">
            Grand Total: <span> ${{ number_format($totalPrice, 2) }}</span>
        </div>

        <button type="button" id="addItem-menubutton" class=" rounded-full flex bg-white p-1 m-2">
        <div class=" bg-[#930027] rounded-full w-12 h-12">
            <i class="fa-solid fa-plus text-white p-4"></i>
        </div>
        </button>

    </div>
    <div class="absolute right-16 bottom-0 z-10">
        <div id="addItem-menu" class=" topbar-manuLeaving bg-white divide-y h-[350px] overflow-scroll divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <button id="" type="button" class=" addItems block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Add Item
                    </button>
                </li>
                <hr>
                {{-- <li>
                                    <button id="addTemplate" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Template Name</button>
                                </li> --}}
                @foreach ($item_templates as $template)
                <li>
                    <button id="addTemplate{{ $template->item_template_id }}" class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $template->item_template_name }}
                    </button>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>



@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2"></script>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"][name="attachment_checkbox"]').change(function() {
            $(this).closest('form').submit();
        });
    });
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
        $("#Estimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
    });
    $("#addProposal").click(function(e) {
        e.preventDefault();
        $("#addProposal-btn-modal").removeClass('hidden');
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addProposal-btn-modal").addClass('hidden');
        // $("#addEstimate-form")[0].reset()
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addContact-modal").addClass('hidden');
        $("#addContact-form")[0].reset()
    });
    $("#sendProposal-btn").click(function(e) {
        e.preventDefault();
        $("#sendProposal-modal").removeClass('hidden');
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#sendProposal-modal").addClass('hidden');
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
    $("#apply-discount").click(function(e) {
        e.preventDefault();
        $("#apply-discount-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#apply-discount-modal").addClass('hidden');
        $("#apply-discount-form")[0].reset()
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
    $(".add-payment").click(function(e) {
        e.preventDefault();
        $("#add-payment-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#add-payment-modal").addClass('hidden');
        $('#invoiceAmountDiv').removeClass('hidden');
        $('#subtotal_input').addClass('bg-gray-200').attr('readonly', true);
        $('#tax_input').addClass('bg-gray-200').attr('readonly', true);
        $('#add-payment-form').attr('action', '/completeInvoiceAndAssignPayment');
        $('#subtotal_input').val('');
        $('#tax_input').val('');
        $('#total_input').val('');
        // $("#add-payment-form")[0].reset()
    });
</script>
<script>
    $(".complete-payment").click(function(e) {
        e.preventDefault();
        $("#complete-payment-modal").removeClass('hidden');
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#complete-payment-modal").addClass('hidden');
        $("#complete-payment-form")[0].reset()
        $('#complete-payment-form').attr('action', '/addPayment');
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

        // $('.deleteButton').click(function(event) {
        //     if (confirm('Are you sure you want to delete?')) {
        //         event.preventDefault();
        //         $(this).closest('form').submit();
        //     }
        // });

        var estimateTotal = parseFloat("{{ $estimate->estimate_total }}");
        var totalPrice = parseFloat("{{ $totalPrice }}");
        estimateTotal = isNaN(estimateTotal) ? totalPrice : estimateTotal;

        $('#select_discount_type').change(function() {
            var percentageInput = $('#percentage_input');
            var priceInput = $('#price_input');

            // Reset inputs
            percentageInput.val('').prop('readonly', true).addClass('bg-gray-200');
            priceInput.val('').prop('readonly', true).addClass('bg-gray-200');
            $('#discounted_total').val(estimateTotal.toFixed(2));

            if ($(this).val() === 'percent') {
                percentageInput.prop('readonly', false).removeClass('bg-gray-200');
            } else if ($(this).val() === 'price') {
                priceInput.prop('readonly', false).removeClass('bg-gray-200');
            }
        });

        $('#percentage_input').on('input', function() {
            var percentage = parseFloat($(this).val()) || 0;
            var discountedTotal = estimateTotal - (estimateTotal * (percentage / 100));
            $('#discounted_total').val(discountedTotal.toFixed(2));
        });

        $('#price_input').on('input', function() {
            var price = parseFloat($(this).val()) || 0;
            var discountedTotal = estimateTotal - price;
            $('#discounted_total').val(discountedTotal.toFixed(2));
        });
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
        var groupNameInput = $('#group_name');
        var groupIdInput = $('#group_id');

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
                        var assemblies = data.item.assemblies;

                        // Update the other input fields based on the item data
                        typeDropdown.val(itemData.item_type);
                        itemNameInput.val(itemData.item_name);
                        itemUnitsInput.val(itemData.item_units);
                        labourExpense.val(itemData.labour_expense);
                        materialExpense.val(itemData.material_expense);
                        itemCost.val(itemData.item_cost);
                        itemPrice.val(itemData.item_price);
                        itemId.val(itemData.item_id);
                        if (itemData.group && itemData.group.group_name != null) {
                            groupNameInput.val(itemData.group.group_name);
                            groupIdInput.val(itemData.group.group_id);
                        } else {
                            groupNameInput.val('');
                            groupIdInput.val('');
                        }
                        console.log(itemData);
                        // groupNameInput.val(itemData.group.group_name);
                        // console.log(itemData);
                        // console.log(itemData.item_units);

                        // assemblyName.val(assemblyItemData.assembly_name);
                        // assByItem.val(assemblyItemData.item_unit_by_ass_unit);
                        // itemByAss.val(assemblyItemData.ass_unit_by_item_unit);
                        type.trigger('change');

                        let mulitple_input = $('#mulitple_input');
                        mulitple_input.html('');
                        $.each(assemblies, function(index, assembly) {
                            let id = Math.floor(Math.random() * 999 + 1);
                            let newele = $('<div class="mt-5" id="ele' + id + '"></div>');
                            let delbtn = $('<span></span>');
                            // ============
                            newele.html(`
                            <input type="hidden" name="ass_item_id[]" id="ass_item_id_${index}" value="${assembly.ass_item_id}">
                                <select name="assembly_name[]" id="assembly_id_${index}" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <option value="">Select Item</option>
                                    <option selected value="${assembly.assembly_name}"
                                        data-item-cost="${assembly.assemblyItemData.item_cost}"
                                        data-item-price="${assembly.assemblyItemData.item_price}"
                                        data-item-id="${assembly.assemblyItemData.item_id}"
                                        data-item-type="${assembly.assemblyItemData.item_type}"
                                        data-labour-expense="${assembly.assemblyItemData.labour_expense}"
                                        data-material-expense="${assembly.assemblyItemData.material_expense}"
                                        data-unit="${assembly.assemblyItemData.item_units}">
                                        ${assembly.assembly_name}
                                    </option>

                                    @foreach ($itemsForAssemblies as $item)
                                    <option id="option_id{{$item->item_id}}" value="{{ $item->item_name }}" data-item-price="{{$item->item_price}}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                                <div class=" grid grid-cols-3 gap-3 mt-2 inline-block">
                                    <div>
                                        <input value="${assembly.item_unit_by_ass_unit ?? 0}" type="text" name="item_unit_by_assembly_unit[]" id="item_unit_by_ass_unit_${index}" placeholder="00.0" autocomplete="given-name"
                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                                    </div>
                                    <div>
                                        <input  value="${assembly.ass_unit_by_item_unit ?? 0}"  type="text" name="assembly_unit_by_item_unit[]" id="ass_unit_by_item_unit_${index}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class="flex ">
                                        <div class="w-[80%]  ">
                                        <input type="text" step="any" name="item_total_qty[]" id="total_qty_${index}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="">Total</span>
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
                            // Initialize Select2 for the newly added select element
                            $(`#assembly_id_${index}`).select2({
                                width: '100%',
                                minimumResultsForSearch: Infinity
                            });

                        });

                        function reminputs(e) {
                            let ele = document.querySelector(e);
                            if (ele) {
                                ele.remove();
                                // Recalculate values by triggering input event on remaining elements
                                $('[id^="item_unit_by_ass_unit_"]').trigger('input');
                            }
                        }
                        // applyInputEventListenerForAssUnit();

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

        $('[id^="reassign-estimate-button"]').click(function() {
            var estimateId = this.id.replace('reassign-estimate-button', '');

            $.ajax({
                url: '/getCompletedEstimate' + estimateId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var estimateDetails = response.estimateDetails;
                        $('#assign_estimate').val(estimateDetails.estimate_assigned_to_accept).trigger('change');
                        $('#complete_estimate_note').val(estimateDetails.note);

                        $('#complete-estimate-modal').removeClass('hidden');
                        $('#complete-estimate-form').attr('action', '/reassignCompleteEstimate');
                    } else {
                        // Handle error response
                        console.error('Error fetching details.');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            })
        })

        $('[id^="editEstimateButton"]').click(function() {
            var estimateId = this.id.replace('editEstimateButton', '');

            $.ajax({
                url: '/getEstimateDetail' + estimateId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var estimateDetails = response.estimate;
                        // console.log(estimateDetails);
                        $('#customer_first_name').val(estimateDetails.customer_name);
                        $('#customer_last_name').val(estimateDetails.customer_last_name);
                        // $('#customer_email').val(estimateDetails.customer_email);
                        $('#customer_phone').val(estimateDetails.customer_phone);
                        $('#customer_project_name').val(estimateDetails.project_name);
                        $('#customer_project_number').val(estimateDetails.project_number);
                        $('#customer_project_type').val(estimateDetails.project_type);
                        $('#customer_building_type').val(estimateDetails.building_type).trigger('change');
                        $('#customer_first_address').val(estimateDetails.customer_address);
                        $('#customer_tax_rate').val(estimateDetails.tax_rate);
                        $('#customer_owner').val(estimateDetails.project_owner).trigger('change');

                        $('#Estimate-modal').removeClass('hidden');
                    } else {
                        // Handle error response
                        console.error('Error fetching details.');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            })
        })

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
                        var assemblyItemData = response.assembly_items;
                        console.log(itemDetail)
                        $('#deleteItem-btn').removeClass('hidden');
                        $('#deleteEstimateItem').attr('action', '/deleteEstimateItem/' + itemDetail.estimate_item_id);
                        // Update modal content with item details
                        $('#type').val(itemDetail.item_type);
                        $('#itemName').val(itemDetail.item_name);
                        $('#item_units').val(itemDetail.item_unit);
                        $('#labour_expense').val(itemDetail.labour_expense);
                        $('#material_expense').val(itemDetail.material_expense);
                        $('#item_cost').val(itemDetail.item_cost);
                        $('#item_price').val(response.item_detail.item_price);
                        $('#item_qty').val(itemDetail.item_qty);
                        $('#item_total').val(itemDetail.item_total);
                        $('#item_description').val(itemDetail.item_description);
                        $('#note').val(itemDetail.item_note);
                        $('#additional_item').val(itemDetail.additional_item).trigger('change');
                        if (itemDetail.group && itemDetail.group.group_name != null) {
                            $('#group_name').val(itemDetail.group.group_name);
                            $('#group_id').val(itemDetail.group.group_id);
                        } else {
                            $('#group_name').val('');
                            $('#group_id').val('');
                        }
                        // Add other fields as needed
                        if (itemDetail.item_type == 'upgrades' || itemDetail.item_type == 'assemblies') {
                            $('#type').trigger('change');

                            let mulitple_input = $('#mulitple_input');
                            mulitple_input.html('');
                            $.each(assemblyItemData, function(index, itemData) {
                                let id = Math.floor(Math.random() * 999 + 1);
                                // console.log(assemblyItemData.est_ass_item_name);
                                let newele = $('<div class="mt-5" id="ele' + id + '"></div>');
                                let delbtn = $('<span></span>');
                                // ============
                                newele.html(`
                                <input type="hidden" name="ass_item_id[]" id="ass_item_id_${index}" value="${itemData.item_id}">
                                <select name="assembly_name[]" id="assembly_id_${index}" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <option value="">Select Item</option>
                                    <option selected value="${itemData.est_ass_item_name}"
                                        data-item-price="${itemData.ass_item_price}"
                                        data-item-cost="${itemData.ass_item_cost}"
                                        data-item-id="${itemData.item_id}"
                                        data-item-type="${itemData.ass_item_type}"
                                        data-labour-expense="${itemData.ass_labour_expense}"
                                        data-material-expense="${itemData.ass_material_expense}"
                                        data-unit="${itemData.ass_item_unit}">
                                        ${itemData.est_ass_item_name}
                                    </option>
                                    @foreach ($itemsForAssemblies as $item)
                                    <option id="option_id{{$item->item_id}}" value="{{ $item->item_name }}" data-item-price="{{$item->item_price}}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                                <div class=" grid grid-cols-3 gap-3 mt-2 inline-block">
                                    <div>
                                        <input value="${itemData.item_unit_by_ass_unit}" type="text" name="item_unit_by_assembly_unit[]" id="item_unit_by_ass_unit_${index}" placeholder="00.0" autocomplete="given-name"
                                            class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                                    </div>
                                    <div>
                                        <input  value="${itemData.ass_unit_by_item_unit}"  type="text" name="assembly_unit_by_item_unit[]" id="ass_unit_by_item_unit_${index}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class="flex ">
                                        <div class="w-[80%]  ">
                                        <input type="text" step="any" name="item_total_qty[]" id="total_qty_${index}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="${itemData.ass_item_qty}">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="">Total</span>
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
                                // Initialize Select2 for the newly added select element
                                $(`#assembly_id_${index}`).select2({
                                    width: '100%',
                                    minimumResultsForSearch: Infinity
                                });

                            });

                            function reminputs(e) {
                                let ele = document.querySelector(e);
                                if (ele) {
                                    ele.remove();
                                    // Recalculate values by triggering input event on remaining elements
                                    $('[id^="item_unit_by_ass_unit_"]').trigger('input');
                                }
                            }
                        }
                        // applyInputEventListenerForAssUnit();
                        // Set the item ID in the hidden input field
                        $('#item_id').val(itemDetail.estimate_item_id);
                        var formUrl = $('#itemsForm').attr('action', '/updateEstimateItem');
                        // Open the modal
                        $('#addItems-modal').removeClass('hidden');
                    } else {
                        // Handle error response
                        console.error('Error fetching item details.');
                        $('#deleteItem-btn').addClass('hidden');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });


        // function applyInputEventListenerForAssUnit() {
        //     $(document).on('input', '[id^="item_unit_by_ass_unit_"]', function() {
        //         // Initialize variables to store total expenses for labour and material items
        //         var totalLabourExpense = 0;
        //         var totalMaterialExpense = 0;

        //         // Iterate over each row
        //         $('[id^="item_unit_by_ass_unit_"]').each(function() {
        //             // Get the ID of the item_unit_by_ass_unit input for the current row
        //             var itemId = $(this).attr('id').replace('item_unit_by_ass_unit_', '');

        //             // Retrieve the selected option from the corresponding select element for the current row
        //             var selectedOption = $('#assembly_id_' + itemId + ' option:selected');

        //             // Retrieve data from the selected option for the current row
        //             var itemType = selectedOption.data('item-type');
        //             var labourExpense = selectedOption.data('labour-expense');
        //             var materialExpense = selectedOption.data('material-expense');
        //             var itemCost = selectedOption.data('item-cost');
        //             var itemPrice = selectedOption.data('item-price');
        //             var assitemIds = selectedOption.data('item-id');

        //             var EstItemQty = $('#item_qty').val();

        //             $('#ass_item_id_' + itemId).val(assitemIds);
        //             // Get the value entered in the item_unit_by_ass_unit input for the current row
        //             var itemUnitValue = parseFloat($(this).val());

        //             // Perform calculations based on item type for the current row
        //             if (itemType === 'labour') {
        //                 if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
        //                     var calculatedValue = 1 / itemUnitValue;

        //                     $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue.toFixed(2));
        //                     // Update total labour expense for the current row
        //                     totalLabourExpense += labourExpense / itemUnitValue;

        //                     var assTotalQty = EstItemQty * calculatedValue;
        //                     $('#total_qty_' + itemId).val(assTotalQty.toFixed(2));
        //                 } else {
        //                     $('#labour_expense').val('');
        //                     $('#ass_unit_by_item_unit_' + itemId).val('');
        //                     $('#total_qty_' + itemId).val('');
        //                 }
        //             } else if (itemType === 'material') {
        //                 if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
        //                     var calculatedValue = 1 / itemUnitValue;
        //                     $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue.toFixed(2));
        //                     // Update total material expense for the current row
        //                     totalMaterialExpense += calculatedValue * 1 * itemCost;

        //                     var assTotalQty = EstItemQty * calculatedValue;
        //                     $('#total_qty_' + itemId).val(assTotalQty.toFixed(2));
        //                 } else {
        //                     $('#material_expense').val('');
        //                     $('#ass_unit_by_item_unit_' + itemId).val('');
        //                     $('#total_qty_' + itemId).val('');
        //                 }
        //             }
        //         });

        //         // Set the total labour and material expenses in their respective inputs
        //         $('#labour_expense').val(totalLabourExpense.toFixed(2));
        //         $('#material_expense').val(totalMaterialExpense.toFixed(2));

        //         // Calculate the sum of labour expense and material expense
        //         var totalExpense = totalLabourExpense + totalMaterialExpense;

        //         // Calculate the item cost as half of the total expense
        //         var itemCost = totalExpense / 2;

        //         // Set the total expense and item cost in their respective inputs
        //         $('#item_price').val(totalExpense.toFixed(2));
        //         $('#item_cost').val(itemCost.toFixed(2));
        //     });
        // }

        // typeDropdown.on('change', function() {
        //     var selectedValue = typeDropdown.val();

        //     // Reset all fields
        //     $('#labour_expense, #material_expense, #item_price').val('');

        //     if (selectedValue === 'assemblies') {
        //         multiAddItemsDiv.removeClass('hidden');
        //         $('#labour_expense, #material_expense, #item_price').attr('readonly', true).addClass('bg-gray-200');
        //     } else if (selectedValue === 'material') {
        //         multiAddItemsDiv.addClass('hidden');
        //         $('#labour_expense').attr('readonly', true).addClass('bg-gray-200');
        //         $('#material_expense').removeClass('bg-gray-200').attr('readonly', false);
        //         // $('#item_price').attr('readonly', true).addClass('bg-gray-200');
        //     } else if (selectedValue === 'labour') {
        //         multiAddItemsDiv.addClass('hidden');
        //         unitItemInput.val('hour');
        //         unitLabel.text('hour');
        //         $('#material_expense').attr('readonly', true).addClass('bg-gray-200');
        //         $('#labour_expense, #item_price').attr('readonly', false).removeClass('bg-gray-200');
        //     } else {
        //         // If none of the above, reset all fields
        //         multiAddItemsDiv.addClass('hidden');
        //         $('#labour_expense, #material_expense').attr('readonly', false).removeClass('bg-gray-200');
        //         unitItemInput.val(null);
        //         unitLabel.text('unit');
        //         $('#item_price').attr('readonly', false).removeClass('bg-gray-200');
        //     }
        // });
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
            var selectedValue = typeDropdown.val();

            // Reset all fields
            // $('#labour_expense, #material_expense, #item_price').val('');

            if (selectedValue === 'assemblies') {
                multiAddItemsDiv.removeClass('hidden');
                $('#labour_expense, #material_expense').attr('readonly', true).addClass('bg-gray-200');
            } else if (selectedValue === 'material') {
                multiAddItemsDiv.addClass('hidden');
                $('#labour_expense').attr('readonly', true).addClass('bg-gray-200');
                $('#material_expense').removeClass('bg-gray-200').attr('readonly', false);
                // $('#item_price').attr('readonly', true).addClass('bg-gray-200');
            } else if (selectedValue === 'labour') {
                multiAddItemsDiv.addClass('hidden');
                unitItemInput.val('hour');
                unitLabel.text('hour');
                $('#material_expense').attr('readonly', true).addClass('bg-gray-200');
                $('#labour_expense').attr('readonly', false).removeClass('bg-gray-200');
            } else {
                // If none of the above, reset all fields
                multiAddItemsDiv.addClass('hidden');
                $('#labour_expense, #material_expense').attr('readonly', false).removeClass('bg-gray-200');
                unitItemInput.val(null);
                unitLabel.text('unit');
                // $('#item_price').attr('readonly', false).removeClass('bg-gray-200');
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
            let finalTotal = itemPrice.val() * itemqty.val();
            itemTotal.val(finalTotal);
        });

        itemqty.on('input', function() {
            let finalTotal = itemPrice.val() * itemqty.val();
            itemTotal.val(finalTotal);
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
    $(document).ready(function() {
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
                                <input type="number" step="any" name="template_item_qty[]" id="template_item_qty" placeholder="" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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

                            $('#template_item_name_' + i).text(correspondingItemData.item_name + ' ' +
                                correspondingItemData.item_description);
                            $('#est_template_item_id_' + i).val(currentItem.est_template_item_id);
                            itemQtyInput.val(currentItem.item_qty);
                            $('#itemTemplatesForm').attr('action', '/updateEstimateItemTemplate');
                            // console.log(itemTemplateItems.length)

                            $('#addItemTemplate-modal').removeClass('hidden');


                            $('#deleteTemplate-btn').removeClass('hidden');
                            $('#deleteEstimateTemplate').attr('action', '/deleteEstimateTemplate/' + itemTemplate.est_template_id);
                        }
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('[id^="addTemplate"]').click(function() {
            // Your existing code inside the click event handler
            var itemId = this.id.replace('addTemplate', '');
            $.ajax({
            url: '/getItemTemplateItems/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                var itemTemplate = response.data.item_template;
                var itemTemplateItems = response.data.item_template_items;
                var itemsData = response.data.items_data;
                console.log(itemsData);

                if (itemsData.length === 0) {
                    var itemTemplateTitle = $('#itemTemplate-title');
                    itemTemplateTitle.text(itemTemplate.item_template_name);
                    var templateItemDiv = $('#template-items');
                    templateItemDiv.html('<p class="text-center text-gray-500">No items in template</p>');
                    $('#addItemTemplate-modal').removeClass('hidden');
                    return;
                }

                for (var i = 0; i < itemTemplateItems.length; i++) {
                    var currentItem = itemTemplateItems[i];
                    console.log("Current item:", currentItem);
                    console.log("Items data:", itemsData);

                    // Find the corresponding item data based on item_id
                    var correspondingItemData = itemsData.find(item => item.item_id == currentItem.item_id);
                    // console.log(correspondingItemData);
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
                        <div id="cal-menu" class="absolute hidden  text-left h-[100%]  z-[999] " <div
                        style="background-color:#3a4655 !important;"
                        class="    z-10 mt-2 w-56 origin-top-right rounded-md bg-[#3a4655] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
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
                    <input type="number" step="any" name="template_item_qty[]" id="template_item_qty" placeholder="" class=" w-[15%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                    // Dynamic IDs for calculator elements
                    var calButtonId = 'cal-button-' + i;
                    var calMenuId = 'cal-menu-' + i;

                    // Find and update IDs in the HTML template
                    demoInput.find('#cal-menubutton').attr('id', calButtonId);
                    demoInput.find('#cal-menu').attr('id', calMenuId);

                    templateItemDiv.append(demoInput);

                    $('#template_item_name_' + i).text(correspondingItemData.item_name + (correspondingItemData.item_description ? ' ' + correspondingItemData.item_description : ''));
                    $('#template_item_id_' + i).val(correspondingItemData.item_id);
                    $('#template_item_qty_' + i).val(currentItem.item_qty);
                    // console.log(itemTemplateItems.length)
                    // itemQtyInput.val(currentItem.quantity);

                    $('#addItemTemplate-modal').removeClass('hidden');
                    initializeCalculator(calButtonId, calMenuId, itemQtyInput);
                }
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
            });
        });

        function initializeCalculator(calButtonId, calMenuId, itemQtyInput) {
            $("#" + calButtonId).click(function(e) {
                e.stopPropagation(); // Prevents the click event from reaching the document body
                $("#" + calMenuId).toggleClass("hidden");
            });

            $(document).on('click', function(e) {
                if (!$("#" + calButtonId).is(e.target) && !$('#' + calMenuId).has(e.target).length) {
                    // Click occurred outside the button and dropdown, hide the dropdown
                    $('#' + calMenuId).addClass("hidden");
                }
            });

            // Get calculator buttons, display, and clear button
            let cbuttons = $("#" + calMenuId).find('.cal_btn');
            let display = $("#" + calMenuId).find('#cal_display');
            let equalButton = $("#" + calMenuId).find('#equal_btn');
            let clearbtn = $("#" + calMenuId).find('#clear_btn');

            // Add click event listeners to calculator buttons
            cbuttons.each(function() {
                $(this).click(function() {
                    display.val(display.val() + $(this).text());
                });
            });

            // Add click event listener to equal button
            equalButton.click(function() {
                try {
                    // Evaluate the expression
                    var result = eval(display.val());
                    if (!isNaN(result)) {
                        // Display the result
                        display.val(result);
                        // Update the corresponding item quantity field
                        $(itemQtyInput).val(result);
                        // Trigger input event
                        $(itemQtyInput).trigger('input');
                    } else {
                        // If result is not a number, display an error message
                        display.val('Error: Invalid expression');
                    }
                } catch (error) {
                    // If an error occurs during evaluation, display an error message
                    display.val('Error: ' + error.message);
                }
            });

            // Add click event listener to clear button
            clearbtn.click(function() {
                display.val('');
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('[id^="editExpense-btn"]').click(function() {
            var itemId = this.id.replace('editExpense-btn', ''); // Extract item ID from button ID

            // Make an AJAX request to get item details
            $.ajax({
                url: '/getExpenseDataToEdit' + itemId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Populate the modal with the retrieved data
                        var expenseDetail = response.expense_detail;
                        console.log(expenseDetail);
                        // Update modal content with item details
                        $('#date').val(formatDate(expenseDetail.expense_date));
                        $('#item_type').val(expenseDetail.expense_item_type);
                        $('#vendor').val(expenseDetail.expense_vendor);
                        $('#hours').val(expenseDetail.labour_hours);
                        $('#subtotal').val(expenseDetail.expense_subtotal);
                        $('#tax').val(expenseDetail.expense_tax);
                        $('#total').val(expenseDetail.expense_total);
                        if (response.expense_paid === 'paid') {
                            $('#paid').prop('checked', true);
                        } else {
                            $('#paid').prop('checked', false);
                        }
                        $('#description').val(expenseDetail.expense_description);
                        // Add other fields as needed

                        // Set the item ID in the hidden input field
                        $('#estimate_expense_id').val(expenseDetail.estimate_expense_id);
                        var formUrl = $('#expenses-btn-form').attr('action', '/updateEstimateExpense');
                        // Open the modal
                        $('#expenses-btn-modal').removeClass('hidden');
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

        function formatDate(dateString) {
            // Assuming dateString is in the format "DD/MM/YYYY"
            var parts = dateString.split('/');
            if (parts.length === 3) {
                return parts[2] + '-' + parts[1] + '-' + parts[0];
            }
            return dateString; // return as is if already in "YYYY-MM-DD" format
        }

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
        $("#itemsForm")[0].reset()
        $('#itemsForm').attr('action', '/addEstimateItems');
        $('#deleteItem-btn').addClass('hidden')
        $('#mulitple_input').empty();
        $('#multiAdd-items').addClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addItemTemplate-modal").addClass('hidden');
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
        let id = Math.floor(Math.random() * 999 + 1);
        let newele = $('<div class="mt-5" id="rendid' + id + '" ></div>');
        let selectId = 'assembly_id_' + id;
        let itemUnitById = 'item_unit_by_ass_unit_' + id; // Dynamic ID for item_unit_by_ass_unit input
        let assUnitById = 'ass_unit_by_item_unit_' + id; // Dynamic ID for ass_unit_by_item_unit input
        let assItemId = 'ass_item_id_' + id;
        let itemTotalQty = 'total_qty_' + id;
        let rembtn = $('<span></span>');

        newele.html(`
        <input type="hidden" name="ass_item_id[]" id="${assItemId}">
            <select name="assembly_name[]" id="${selectId}" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                <option value="">Select Item</option>
                @foreach ($itemsForAssemblies as $item)
                <option value="{{ $item->item_name }}" data-item-cost="{{$item->item_cost}}" data-item-price="{{$item->item_price}}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
            <div class=" grid grid-cols-3 gap-3 mt-2 inline-block">
                <div>
                    <input type="number" step="any" name="item_unit_by_assembly_unit[]" id="${itemUnitById}" placeholder="00.0" autocomplete="given-name"
                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">LNFT</span></span>
                </div>
                <div>
                        <input type="text" step="any" name="assembly_unit_by_item_unit[]" id="${assUnitById}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">LNFT</span>/<span class="unit">unit</span></span>
                </div>
                <div class="flex ">
                    <div class="w-[80%]  ">
                    <input type="number" step="any" name="item_total_qty[]" id="${itemTotalQty}" placeholder="00.0" autocomplete="given-name"  class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="">Total</span>
                </div>
                <div class="mt-1" >
                    <button onclick="remveinputs('#rendid${id}')"  type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                        <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                    </button>
                </div>
                </div>
            </div>
        `);

        mulitple_input.append(newele);
        newele.append(rembtn);

        // Reinitialize Select2 for the newly added select element
        $('#' + selectId).select2({
            width: '100%'
        });

    });

    function remveinputs(e) {
        let ele = document.querySelector(e);
        if (ele) {
            ele.remove();
            // Recalculate values by triggering input event on remaining elements
            $('[id^="item_unit_by_ass_unit_"]').trigger('input');
        }
    }
    $(document).on('input', '[id^="item_unit_by_ass_unit_"]', function() {
        // Initialize variables to store total expenses for labour and material items
        var totalLabourExpense = 0;
        var totalMaterialExpense = 0;
        var labourPrice = 0;
        var materialPrice = 0;
        var findingCostLabour = 0;
        var EstItemQty = $('#item_qty').val();
        // Iterate over each row
        $('[id^="item_unit_by_ass_unit_"]').each(function() {
            // Get the ID of the item_unit_by_ass_unit input for the current row
            var itemId = $(this).attr('id').replace('item_unit_by_ass_unit_', '');

            // Retrieve the selected option from the corresponding select element for the current row
            var selectedOption = $('#assembly_id_' + itemId + ' option:selected');

            // Retrieve data from the selected option for the current row
            var itemType = selectedOption.data('item-type');
            var labourExpense = selectedOption.data('labour-expense');
            var materialExpense = selectedOption.data('material-expense');
            var itemPrice = selectedOption.data('item-price');
            var itemCost = selectedOption.data('item-cost');
            var itemUnit = selectedOption.data('unit');
            var assitemIds = selectedOption.data('item-id');

            $('#ass_item_id_' + itemId).val(assitemIds);

            $('.addedItemUnit' + itemId).text(itemUnit);



            // Get the value entered in the item_unit_by_ass_unit input for the current row
            var itemUnitValue = parseFloat($(this).val());

            // Perform calculations based on item type for the current row
            if (itemType == 'labour') {
                if (!isNaN(itemUnitValue) && itemUnitValue != 0) {
                    var calculatedValue = 1 / itemUnitValue;

                    $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue);
                    // Update total labour expense for the current row
                    totalLabourExpense += labourExpense / itemUnitValue;
                    labourPrice += itemPrice / itemUnitValue;

                    findingCostLabour = totalLabourExpense * itemCost / labourExpense;
                    var assTotalQty = EstItemQty * calculatedValue;
                    $('#total_qty_' + itemId).val(assTotalQty.toFixed(2));
                } else {
                    $('#labour_expense').val('');
                    $('#ass_unit_by_item_unit_' + itemId).val('');
                    $('#total_qty_' + itemId).val('');
                }
            } else if (itemType == 'material') {
                if (!isNaN(itemUnitValue) && itemUnitValue != 0) {
                    var calculatedValue = 1 / itemUnitValue;
                    $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue);
                    // Update total material expense for the current row
                    totalMaterialExpense += calculatedValue * 1 * itemCost;
                    materialPrice += itemPrice / itemUnitValue;

                    var assTotalQty = EstItemQty * calculatedValue;
                    $('#total_qty_' + itemId).val(assTotalQty.toFixed(2));
                } else {
                    $('#material_expense').val('');
                    $('#ass_unit_by_item_unit_' + itemId).val('');
                    $('#total_qty_' + itemId).val('');
                }
            }
        });

        // Set the total labour and material expenses in their respective inputs
        $('#labour_expense').val(totalLabourExpense);
        $('#material_expense').val(totalMaterialExpense);

        // Calculate the sum of labour expense and material expense
        var totalExpense = labourPrice + materialPrice;

        // Calculate the item cost as half of the total expense
        var itemCost = findingCostLabour + totalMaterialExpense;

        // Set the total expense and item cost in their respective inputs
        $('#item_price').val(totalExpense.toFixed(2));
        $('#item_cost').val(itemCost.toFixed(2));

        var priceMinusCost = $('#item_price').val() - $('#item_cost').val();
        var priceMinusCostbyitemPrice = priceMinusCost / $('#item_price').val();
        var finalMargin = priceMinusCostbyitemPrice * 100;
        $('#price_margin').text(finalMargin.toFixed(2));

        var grandTotal = totalExpense * EstItemQty;

        $('#item_total').val(grandTotal);

    });

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
    $(document).ready(function() {
        var currentDate = new Date().toISOString().slice(0, 10);
        $('.se_date').val(currentDate);
        $('#complete_invoice_date').val(currentDate);

        var currentDate = new Date();
        // Calculate the next date by adding one day
        currentDate.setDate(currentDate.getDate() + 1);
        // Format the next date to YYYY-MM-DD
        var nextDate = currentDate.toISOString().slice(0, 10);
        // Set the value of the input field to the next date
        $('.en_date').val(nextDate);
    });
</script>
<script>
    document.getElementById("copyButton").addEventListener("click", function() {
        // Get the URL
        var url = "soft.rivercitypainting.tech{{'/viewProposal?estimateId=' . $estimate->estimate_id}}";

        // Create a temporary input element
        var input = document.createElement('input');
        input.setAttribute('value', url);
        document.body.appendChild(input);

        // Select the text in the input
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Remove the temporary input
        document.body.removeChild(input);

        // Optionally, provide some feedback to the user
        // alert("URL copied to clipboard: " + url);
        Swal.fire(
            'Success!',
            'URL copied to clipboard',
            'success'
        );
    });
</script>
<script>
    $(document).ready(function() {
        $('#amount_percentage').change(function() {
            var percentage = parseFloat($(this).val()) / 100;
            var estimateTotal = parseFloat(<?php echo $estimate->estimate_total; ?>);
            var advancePayment = percentage * estimateTotal;
            $('#advance_payment').val(advancePayment.toFixed(2)); // Set the value of advance_payment input
        });

        $(document).on('click', '[id^=edit-invoice]', function() {
            // Extract the ID from the button's ID attribute
            var id = $(this).attr('id').replace('edit-invoice', '');

            // Perform the AJAX request
            $.ajax({
                url: '/getInvoiceToEdit/' + id,
                type: 'GET',
                success: function(response) {
                    // Process the response
                    console.log(response);
                    var data = response.invoice;
                    // You can update the UI with the response data here
                    $('#subtotal_input').removeClass('bg-gray-200').attr('readonly', false);
                    $('#tax_input').removeClass('bg-gray-200').attr('readonly', false);

                    $('#invoice_date').val(data.complete_invoice_date);
                    $('#invoice_name').val(data.invoice_name);
                    $('#subtotal_input').val(data.invoice_subtotal);
                    $('#tax_input').val(data.tax_rate);
                    $('#total_input').val(data.invoice_total);
                    $('#invoice_id').val(data.estimate_complete_invoice_id);

                    $('#invoiceAmountDiv').addClass('hidden');
                    $('#add-payment-modal').removeClass('hidden');
                    $('#add-payment-form').attr('action', '/updateInvoice');
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error(error);
                }
            });
        });

        $(document).on('click', '[id^=edit-payment]', function() {
            // Extract the ID from the button's ID attribute
            var id = $(this).attr('id').replace('edit-payment', '');

            // Perform the AJAX request
            $.ajax({
                url: '/getPayment/' + id,
                type: 'GET',
                success: function(response) {
                    // Process the response
                    console.log(response);
                    var payment = response.payment;
                    var invoice = response.invoice;
                    // You can update the UI with the response data here
                    $('#invoice').val(invoice.invoice_name);
                    $('#invoice_date').val(payment.complete_invoice_date);
                    $('#invoice_amount').val(payment.invoice_total);
                    $('#invoice_note').val(payment.note);
                    $('#payment_id').val(payment.estimate_payment_id);

                    $('#complete-payment-modal').removeClass('hidden');
                    $('#complete-payment-form').attr('action', '/updatePayment');
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error(error);
                }
            });
        });

    });
    $(document).ready(function() {
        const estimateTotal = parseFloat("{{ $estimate->discounted_total != null ? $estimate->discounted_total : $estimate->estimate_total }}");
        const remainingTotal = parseFloat("{{ $remainingEstimateTotal }}");

        function resetInputs() {
            $('#percent_input').addClass('bg-gray-200').attr('readonly', true).val('');
            $('#fixed_input').addClass('bg-gray-200').attr('readonly', true).val('');
            $('#subtotal_input').addClass('bg-gray-200').attr('readonly', true).val('');
            $('#tax_input').addClass('bg-gray-200').attr('readonly', true).val('');
            $('#total_input').val(estimateTotal.toFixed(2)); // Set to estimate_total by default
            $('#subtotal_input').val(estimateTotal.toFixed(2)); // Set to estimate_total by default
        }

        function handleRadioChange() {
            resetInputs();
            if ($('#percent_of_total').is(':checked')) {
                $('#percent_input').removeClass('bg-gray-200').attr('readonly', false);
            } else if ($('#fixed_total').is(':checked')) {
                $('#fixed_input').removeClass('bg-gray-200').attr('readonly', false);
            } else if ($('#custom_amount').is(':checked')) {
                $('#subtotal_input').removeClass('bg-gray-200').attr('readonly', false);
                $('#tax_input').removeClass('bg-gray-200').attr('readonly', false);
            } else if ($('#remaining_amount').is(':checked')) {
                $('#subtotal_input').val(remainingTotal.toFixed(2));
                $('#total_input').val(remainingTotal.toFixed(2));
            }
        }

        function updateSubtotalAndTotalFromPercent() {
            const percent = parseFloat($('#percent_input').val());
            if (!isNaN(percent)) {
                const subtotal = (estimateTotal * percent / 100).toFixed(2);
                $('#subtotal_input').val(subtotal);
                $('#total_input').val(subtotal);
            } else {
                $('#subtotal_input').val('');
                $('#total_input').val('');
            }
        }

        function updateSubtotalAndTotalFromFixed() {
            const fixed = parseFloat($('#fixed_input').val());
            if (!isNaN(fixed)) {
                $('#subtotal_input').val(fixed.toFixed(2));
                $('#total_input').val(fixed.toFixed(2));
            } else {
                $('#subtotal_input').val('');
                $('#total_input').val('');
            }
        }

        function updateTotalFromSubtotalAndTax() {
            const subtotal = parseFloat($('#subtotal_input').val());
            const tax = parseFloat($('#tax_input').val());
            if (!isNaN(subtotal)) {
                if (isNaN(tax)) {
                    $('#total_input').val(subtotal.toFixed(2));
                } else {
                    const total = (subtotal + tax).toFixed(2);
                    $('#total_input').val(total);
                }
            } else {
                $('#total_input').val('');
            }
        }
        $('input[name="payment_option"]').on('change', handleRadioChange);
        $('#percent_input').on('input', updateSubtotalAndTotalFromPercent);
        $('#fixed_input').on('input', updateSubtotalAndTotalFromFixed);
        $('#subtotal_input, #tax_input').on('input', updateTotalFromSubtotalAndTax);
        handleRadioChange(); // Initialize the form with default settings

        $('#itemsForm').on('submit', function(event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            var hasPendingProposal = $('#hasPendingProposal').val() == '1';
            var additionalItemsSelected = $('#additional_item').val() == 'yes';

            if (hasPendingProposal && !additionalItemsSelected) {
                var confirmSubmit = confirm('A pending proposal exists. If you submit, the proposal will be canceled. Do you want to continue?');

                if (confirmSubmit) {
                    // If the user confirms, submit the form
                    return true;
                } else {
                    // If the user cancels, do nothing (the form will not be submitted)
                    return false;
                }
            } else {
                // If no pending proposal or additional items are selected, submit the form
                return true;
            }
        });
        $('#itemTemplatesForm').on('submit', function(event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            var hasPendingProposal = $('#hasPendingProposal').val() == '1';
            var additionalItemsSelected = $('#additional_item').val() == 'yes';

            if (hasPendingProposal && !additionalItemsSelected) {
                var confirmSubmit = confirm('A pending proposal exists. If you submit, the proposal will be canceled. Do you want to continue?');

                if (confirmSubmit) {
                    // If the user confirms, submit the form
                    return true;
                } else {
                    // If the user cancels, do nothing (the form will not be submitted)
                    return false;
                }
            } else {
                // If no pending proposal or additional items are selected, submit the form
                return true;
            }
        });

    });
    $(document).ready(function() {
        // Cache selectors
        var $makeProposalRadio = $('#makeProposal');
        var $makeChangeOrderRadio = $('#makeChangeOrder');
        var $changeOrderSelect = $('#changeOrder-select');
        var $makeProposalUrl = $('#makeProposal-url');
        var baseUrl = '/makeProposal/{{ $estimate->estimate_id }}';

        // Function to toggle select state and update URL
        function updateFormState() {
            if ($makeChangeOrderRadio.is(':checked')) {
                $changeOrderSelect.prop('disabled', false);
                // Update URL with selected group ID if a group is selected
                var selectedGroupId = $changeOrderSelect.val();
                if (selectedGroupId) {
                    $makeProposalUrl.attr('href', baseUrl + '/?group_id=' + selectedGroupId);
                } else {
                    $makeProposalUrl.attr('href', baseUrl); // Reset to base URL if no group selected
                }
            } else {
                $changeOrderSelect.prop('disabled', true);
                $makeProposalUrl.attr('href', baseUrl); // Reset to base URL for Estimate
            }
        }

        // Event handlers
        $('input[name="makeProposal"]').on('change', updateFormState);
        $changeOrderSelect.on('change', updateFormState); // Update URL when select changes

        // Initial state
        updateFormState();
    });
</script>
