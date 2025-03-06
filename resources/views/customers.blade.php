@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Customer List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Customer'" :class="'addEstimate'" :id="'addCustomer'"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <table id="universalTable" class="display" style="width:100%">
                <thead class="bg-[#930027] text-white text-sm">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Phone Number/Address</th>
                        <th>Source</th>
                        <th>Added By</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class=" text-sm">
                    @foreach($customers as $customer)
                    <tr>
                        <td>
                            <a href="/viewCustomerDetails/{{ $customer->customer_id }}" class=" text-[#930027] hover:border-b hover:border-[#930027]">
                                {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                            </a>
                        </td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ date('m/d/y', strtotime($customer->created_at)) }}</td>
                        <td>{{ $customer->customer_phone }} <br> <a href="https://maps.google.com/?q={{ $customer->customer_primary_address }}{{ $customer->customer_city}}{{ $customer->customer_state }}{{ $customer->customer_zip_code }}" target="_blank" class=" text-[#930027]">{{ $customer->customer_primary_address }}, {{ $customer->customer_city}}, {{ $customer->customer_state }}, {{ $customer->customer_zip_code }}</a></td>
                        <td>{{ $customer->source }}</td>
                        <td>{{ $customer->addedBy ? $customer->addedBy->name : '' }}</td>
                        <td>{{ $customer->branch }}</td>
                        <td>
                            @if(session('user_details')['user_role'] == 'admin')
                            <button id="editCustomer{{$customer->customer_id}}">
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                            </button>
                            @elseif(isset($userPrivileges->customers) && isset($userPrivileges->customers->edit) && $userPrivileges->customers->edit === "on")
                            <button id="editCustomer{{$customer->customer_id}}">
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                            </button>
                            @endif
                            @if (session('user_details')['user_role'] == 'admin')
                            <button disabled>
                                <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                            </button>
                            @elseif(isset($userPrivileges->customers) && isset($userPrivileges->customers->edit) && $userPrivileges->customers->delete === "on")
                            <button disabled>
                                <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- add estimate -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEstimate-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg">
            <form action="/updateCustomer" method="post" id="addEstimate-form">
                @csrf
                <input type="hidden" id="customer_id" name="customer_id">
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
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">First Name</h5>
                            <input type="text" name="first_name" id="first_name" placeholder="First Name"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Last Name</h5>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Email</h5>
                            <input type="text" name="email" id="email" placeholder="Email"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Phone No.</h5>
                            <input type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX" required>
                        </div>
                        <div class=" col-span-4 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Company Name (Optional)</h5>
                            <input type="text" name="company_name" id="company_name"
                                placeholder="Company Name (Optional)" autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" flex justify-between border-b-2 mb-2 col-span-4  mt-1 mb-3">
                            <h2 class=" text-xl font-semibold mb-2 text-[#930027]">Billing</h2>
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address 1</h5>
                            <input type="text" name="first_address" id="first_address" placeholder="Address 1"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2 ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Address 2 (Optional)</h5>
                            <input type="text" name="second_address" id="second_address"
                                placeholder="Address 2 (Optional)" autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">City</h5>
                            <input type="text" name="city" id="city" placeholder="City" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">State/Province</h5>
                            <input type="text" name="state" id="state" placeholder="State/Province"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" ">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Zip/Postal Code</h5>
                            <input type="number" step="any" name="zip_code" id="zip_code" placeholder="Zip/Postal Code"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
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
                            <input type="number" step="any" name="tax_rate" id="tax_rate" placeholder="Tax Rate (Optional)"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Potential Value</h5>
                            <input type="text" name="potential_value" id="potential_value"
                                placeholder="Potential Value" autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-4">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Note</h5>
                            <input type="text" name="internal_note" id="internal_note"
                                placeholder="Internal Notes (Optional, only visible to employees)"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Source</h5>
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
                        <!-- <div class=" col-span-2">
                            <h5 class="text-gray-600 mb-1  font-medium text-left">Owner</h5>
                            <select
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"
                                name="owner" id="owner">
                                <option>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->name }} {{ $user->last_name }}">
                                    {{ $user->name }} {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div> -->
                    </div>
                    <div class="">
                        <button id=""
                            class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(".addEstimate").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addEstimate-modal").addClass('hidden');
        $("#addEstimate-form")[0].reset()
        $('#customer_id').val('');
    });
</script>
<script>
    $('[id^="editCustomer"]').click(function() {
        var itemId = this.id.replace('editCustomer', ''); // Extract item ID from button ID

        // Make an AJAX request to get item details
        $.ajax({
            url: '/getCustomerToEdit' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    // Populate the modal with the retrieved data
                    var customerDetail = response.customer;

                    // Update modal content with item details
                    $('#first_name').val(customerDetail.customer_first_name);
                    $('#last_name').val(customerDetail.customer_last_name);
                    $('#email').val(customerDetail.customer_email);
                    $('#phone').val(customerDetail.customer_phone);
                    $('#company_name').val(customerDetail.customer_company_name);
                    $('#first_address').val(customerDetail.customer_primary_address);
                    $('#second_address').val(customerDetail.customer_secondary_address);

                    $('#city').val(customerDetail.customer_city);

                    $('#state').val(customerDetail.customer_state);
                    $('#zip_code').val(customerDetail.customer_zip_code);
                    $('#tax_rate').val(customerDetail.tax_rate);
                    $('#potential_value').val(customerDetail.potential_value);
                    $('#internal_note').val(customerDetail.company_internal_note);
                    $('#source').val(customerDetail.source);
                    $('#owner').val(customerDetail.owner);
                    $('#branch').val(customerDetail.branch).trigger('change');
                    // Set the item ID in the hidden input field
                    $('#customer_id').val(customerDetail.customer_id);
                    var formUrl = $('#addEstimate-form').attr('action', '/updateCustomer');
                    // Open the modal
                    $('#addEstimate-modal').removeClass('hidden');
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