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
                        <p class="mt-1 flex text-[#323C47]  font-medium">
                            Note:
                            <span class="pl-2">{{ $customer->company_internal_note }}
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
            <button type="button" class="flex bg-white p-1 m-2 rounded-lg" id="addEstimate">
                <div class=" bg-[#930027] rounded-lg">
                    <i class="fa-solid fa-plus text-white p-2"></i>
                </div>
            </button>
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
                                        {{ $project->created_at->format('d/m/Y') }} {{ $project->project_name }} {{ $project->project_number != null ? '(' . $project->project_number . ')' : '' }}
                                    </a>
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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEstimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg">
            <form action="/addEstimate" method="post" id="addEstimate-form">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Add Customer</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-4 gap-2">
                        <div class=" flex justify-between border-b-2 mb-2 col-span-4 mt-4">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Contact</h2>
                        </div>
                        <div class="col-span-4">
                            <select name="customer_id" id="customer_id" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">New Client</option>
                                <option selected value="{{ $customer->customer_id }}">{{ $customer->customer_first_name }}
                                    {{ $customer->customer_last_name }}
                                </option>
                            </select>
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">First Name</h5>
                            <input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{$customer->customer_first_name}}" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Last Name</h5>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{$customer->customer_last_name}}" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Email</h5>
                            <input type="text" name="email" id="email" placeholder="Email" value="{{$customer->customer_email}}" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Phone No.</h5>
                            <input type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" value="{{$customer->customer_phone}}" autocomplete="given-name" class="mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" pattern="([0-9]{3}-?[0-9]{3}-?[0-9]{4})(/[0-9]{3}-?[0-9]{3}-?[0-9]{4})*" title="Phone number must be in the format XXX-XXX-XXXX or XXXXXXXXXX, separated by slashes" required>
                            <span class=" text-[#930027]" style="font-size:12px;">Please use "/" to add more than one number.</span>
                        </div>
                        <div class=" col-span-4 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Company Name (Optional)</h5>
                            <input type="text" name="company_name" id="company_name" value="{{$customer->customer_company_name}}" placeholder="Company Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Name (Optional)</h5>
                            <input type="text" name="project_name" id="project_name" placeholder="Project Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Number (Optional)</h5>
                            <input type="text" step="any" name="project_number" id="project_number" placeholder="Project Number (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Project Type (Optional)</h5>
                            <input type="text" step="any" name="project_type" id="project_type" placeholder="Project Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Building Type (Optional)</h5>
                            <select name="building_type" id="building_type" placeholder="Building Type (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class=" flex justify-between border-b-2 mb-2 col-span-4  mt-1 mb-3">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Billing</h2>
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address 1</h5>
                            <input type="text" name="first_address" id="first_address" value="{{$customer->customer_primary_address}}" placeholder="Address 1" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address 2 (Optional)</h5>
                            <input type="text" name="second_address" id="second_address" value="{{$customer->customer_secondary_address}}" placeholder="Address 2 (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">City</h5>
                            <input type="text" name="city" id="city" placeholder="City" value="{{$customer->customer_city}}" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">State/Province</h5>
                            <input type="text" name="state" id="state" placeholder="State/Province" value="{{$customer->customer_state}}" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Zip/Postal Code</h5>
                            <input type="number" step="any" name="zip_code" id="zip_code" value="{{$customer->customer_zip_code}}" placeholder="Zip/Postal Code" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Branch</h5>
                            <select name="branch" id="branch" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <option value="">Select Branch</option>
                                <option value="wichita">Wichita</option>
                                <option value="kansas">Kansas City</option>
                            </select>
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Tax</h5>
                            <input type="number" step="any" name="tax_rate" id="tax_rate"  placeholder="Tax Rate (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Potential Value</h5>
                            <input type="text" name="potential_value" id="potential_value" placeholder="Potential Value" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-4">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Note</h5>
                            <input type="text" name="internal_note" id="internal_note" placeholder="Internal Notes (Optional, only visible to employees)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Source (Optional)</h5>
                            <input type="text" list="sources" name="source" id="source" placeholder="Source (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <datalist id="sources">
                                <option value="Google">Google</option>
                                <option value="Website">Website</option>
                                <option value="Referral">Referral</option>
                                <option value="Returning Customer">Returning Customer</option>
                                <option value="Google LSA">Google LSA</option>
                                <option value="WEA">WEA</option>
                                <option value="Rhoden Roofing">Rhoden Roofing</option>
                                <option value="Steamatic">Steamatic</option>
                                <option value="Billboard">Billboard</option>
                                <option value="Radio">Radio</option>
                                <option value="Television">Television</option>
                            </datalist>
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Owner</h5>
                            <select class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" name="owner" id="owner">
                                <option>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->name }} {{ $user->last_name }}">
                                    {{ $user->name }} {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" mt-2">
                        <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
                        <button id="" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addEstimate").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
    });
</script>