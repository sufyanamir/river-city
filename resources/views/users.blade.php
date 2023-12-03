@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Users</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Users List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add User'" :id="'addUser'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td><img class=" w-18 h-18 rounded-full" src="{{ asset('assets/images/demo-user.svg') }}"
                                    alt="image"></td>
                            <td>Client Name</td>
                            <td>Labour</td>
                            <td>client@gmail.com</td>
                            <td>123 456 789</td>
                            <td>Town, City, Country</td>
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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addUser-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addUser" id="addUser-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add User</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2">
                            <h3 class=" text-lg font-medium text-left">Details</h3>
                        </div>
                        <div class=" pt-3">
                            <input type="text" name="firstName" id="firstName" placeholder="First Name"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <input type="email" name="email" id="email" placeholder="Email"
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <input type="tel" name="phone" id="phone" placeholder="Phone No."
                                autocomplete="given-name"
                                class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <div id="dropzone" class="dropzone"
                                style=" width: 139px !important; height: 139px !important;">
                                <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}"
                                    style="width: 139px; height: 139px; border-radius: 50%; object-fit: cover;"
                                    alt="text">
                                <div class="file-input-container">
                                    <input class="file-input" type="file" name="upload_image" id="fileInput1">
                                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11"
                                            alt="icon">
                                    </div>
                                </div>
                            </div>
                            <!-- <div>
                                <label>
                                    <input type="checkbox" checked class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" checked class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" checked class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                            </div> -->
                            <div>
                                <select id="role" name="role" autocomplete="customer-name"
                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                    <option value="">role</option>
                                    @foreach ($user_roles as $row)
                                        <option >{{ $row['role'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" col-span-2 my-2">
                            <textarea name="address" id="" placeholder="Address"
                                class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <button id="updateEvent"
                            class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addUser").click(function(e) {
        e.preventDefault();
        $("#addUser-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addUser-modal").addClass('hidden');
        $("#addUser-form")[0].reset()
    });
</script>
