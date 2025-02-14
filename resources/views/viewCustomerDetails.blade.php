@include('layouts.header')

<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Customer Details</h1>
    <div class=" bg-transparent w-full">
        <div class=" mb-5 shadow-lg bg-white text-white  rounded-3xl">
            <div class="  flex gap-x-1 items-center p-4  bg-[#930027] rounded-t-3xl">
                <!-- <button type="button" class="flex" id="editEstimateButton">
                    <img class="" src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="icon">
                </button> -->
                <p class="text-lg  font-medium">
                    Customer
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
                            <a href="https://maps.google.com/?q={{$customer->customer_primary_address}}" target="_blank" class=" text-[#930027]">
                                <span class="pl-2">{{ $customer->customer_primary_address }}</span>
                            </a>
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
                        <hr class="bg-gray-300 my-2 w-full">
                    </div>
                    <div class=" col-span-2 p-3 text-right">
                        <p class="text-md my-2 font-semibold text-[#323C47]">
                            Total Projects Vlaue:
                            <span>${{ number_format($estimates->sum('estimate_total'), 2)}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
        <div class="flex  items-center gap-2 px-4  bg-[#930027] rounded-t-3xl">
            <!-- <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button> -->
            <p class="text-lg py-3  font-medium text-white">
                Contacts
            </p>
        </div>
        <div class="py-4     ">
            <p class="text-lg py-3 my-auto  pl-9 text-[#707683] font-medium">
                Contacts to keep track of your project's stakeholders
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimateContacts as $contact)
                            <tr class="bg-white border-b border-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact['contact_title'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact['contact_first_name'] }} {{ $contact['contact_last_name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact['contact_email'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact['contact_phone'] }}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
        <div class="flex  items-center gap-2 px-4  bg-[#930027] rounded-t-3xl">
            <!-- <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button> -->
            <p class="text-lg py-3  font-medium text-white">
                Projects
            </p>
        </div>
        <div class="py-4     ">
            <div class="relative overflow-x-auto">
                @foreach($estimates as $project)
                <div class="itemDiv border-2 rounded-md m-3">
                    <div class="col-span-10  pl-2 ">
                        <div class="grid sm:grid-cols-10">
                            <div class="col-span-8 p-3">
                                <p class="text-[#F5222D] text-xl font-bold">
                                    <a href="/viewEstimate/{{ $project->estimate_id }}" class="hover:text">
                                        {{ $project->created_at->format('d/m/Y') }} {{ $project->project_name }}
                                    </a>
                                </p>
                                <p class="text-[#323C47] text-lg font-semibold">
                                    {{ $customer->customer_project_name }}
                                </p>
                                <p class="mt-2 flex text-[#323C47] font-medium">
                                    <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                                    <a href="https://maps.google.com/?q={{$customer->customer_primary_address}}" target="_blank" class=" text-[#930027]">
                                        <span class="pl-2">{{ $customer->customer_primary_address }}</span>
                                    </a>
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
                                <hr class="bg-gray-300 my-2 w-full">
                            </div>
                            <div class=" col-span-2 p-3 text-right">
                                <p class="text-md my-2 font-semibold text-[#323C47]">
                                    status: {{ $project->estimate_status }}
                                    <span></span>
                                </p>
                                <p class="text-md my-2 font-semibold text-[#323C47]">
                                    Total: ${{ number_format($project->estimate_total,2) }}
                                    <span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
        <div class="flex  items-center gap-2 px-4  bg-[#930027] rounded-t-3xl">
            <!-- <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button> -->
            <p class="text-lg py-3  font-medium text-white">
                Files
            </p>
        </div>
        <div class="py-4     ">
            <div class="relative overflow-x-auto">
                <div class="itemDiv">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="text-center px-6 py-3">
                                    Files
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimateFiles as $file)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    <a href="{{ asset('storage/' . $file['estimate_file']) }}" class=" text-[#930027] hover:border-b border-[#930027]" target="_blank">
                                        {{ $file['estimate_file_name'] }}
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
    <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
        <div class="flex  items-center gap-2 px-4  bg-[#930027] rounded-t-3xl">
            <!-- <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button> -->
            <p class="text-lg py-3  font-medium text-white">
                Emails
            </p>
        </div>
        <div class="py-4     ">
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
                            @foreach($estimateEmails as $email)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($email['created_at'])->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $email['email_name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $email['email_to'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $email['email_subject'] }}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class=" border-2  shadow-lg mt-7   bg-white   rounded-3xl ">
        <div class="flex  items-center gap-2 px-4  bg-[#930027] rounded-t-3xl">
            <!-- <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addContact">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button> -->
            <p class="text-lg py-3  font-medium text-white">
                Notes
            </p>
        </div>
        <div class="py-4     ">
            <div class="relative overflow-x-auto">
                <div class="itemDiv">
                    <div class="relative overflow-x-auto py-2">
                        <div class="itemDiv">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Notes
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estimateNotes as $note)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $note['estimate_note'] }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')