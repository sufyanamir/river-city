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
                <!-- <x-add-button :title="'+Add Customer'" :class="''" :id="'addCustomer'"></x-add-button> -->
            </div>
        </div>
        <div class="py-4">
            <table id="universalTable" class="display" style="width:100%">
                <thead class="bg-[#930027] text-white text-sm">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Source</th>
                        <th>Added By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class=" text-sm">
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->customer_phone }}</td>
                        <td>{{ $customer->customer_soource }}</td>
                        <td>{{ $customer->added_user_id }}</td>
                        <td>
                            @if(session('user_details')['user_role'] == 'admin')
                            <button>
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                            </button>    
                            @elseif(isset($userPrivileges->customers) && isset($userPrivileges->customers->edit) && $userPrivileges->customers->edit === "on")
                            <button>
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                            </button>
                            @endif
                            @if (session('user_details')['user_role'] == 'admin')
                            <button>
                                <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                            </button>
                            @elseif(isset($userPrivileges->customers) && isset($userPrivileges->customers->edit) && $userPrivileges->customers->delete === "on")
                            <button>
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

@include('layouts.footer')
