@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Users</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Users List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add User'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
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
                        <tr>
                            <td><img class=" w-18 h-18 rounded-full" src="{{ asset('assets/images/demo-user.svg') }}"
                                    alt="image"></td>
                            <td>Client Name</td>
                            <td>client@gmail.com</td>
                            <td>Sep 23, 2023</td>
                            <td>Town, City, Country</td>
                            <td>123 456 789</td>
                            <td>Facebook Ads</td>
                            <td>John</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                                <a href="{{ url('privileges') }}">
                                    <button>
                                        <img src="{{ asset('assets/icons/userPrivileges-icon.svg') }}" alt="btn">
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
