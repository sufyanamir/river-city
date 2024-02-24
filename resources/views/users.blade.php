@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Users List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add User'" :id="'addUser'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
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
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach($users as $user)
                        <tr>
                            <td><img class=" w-10 h-10 rounded-full" style="object-fit: cover;" src="{{ (isset($user->user_image)) ? asset($user->user_image) : 'assets/images/demo-user.svg'}}" alt="image"></td>
                            <td>{{ $user->name }} {{ $user->last_name }}</td>
                            <td>{{ $user->user_role }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <button id="edit-user{{$user->id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="edit-user-modal{{$user->id}}">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Background overlay -->
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                        </div>

                                        <!-- Modal panel -->
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <form action="/editUser" id="formData{{$user->id}}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="hidden" name="userId" value="{{$user->id}}">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <!-- Modal content here -->
                                                    <div class=" flex justify-between border-b-2">
                                                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add User</h2>
                                                        <button class="modal-close{{$user->id}}" type="button">
                                                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                        </button>
                                                    </div>
                                                    <!-- task details -->
                                                    <div class=" text-center grid grid-cols-2 gap-2">
                                                        <div class=" col-span-2">
                                                            <h3 class=" text-lg font-medium text-left">Details</h3>
                                                        </div>
                                                        <div class=" pt-3">
                                                            <label for="" class="text-gray-700 block text-left mb-1 "> First Name</label>
                                                            <input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="given-name" value="{{$user->name}}" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            <label for="" class="text-gray-700 block text-left mb-1 ">Last Name</label>
                                                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="given-name"  value="{{$user->last_name}}" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            <label for="" class="text-gray-700 block text-left mb-1 ">Email</label>
                                                            <input   value="{{$user->email}}" type="email" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                            <label for="" class="text-gray-700 block text-left mb-1 ">Phone No</label>
                                                            <input  value="{{$user->phone}}" type="tel" name="phone" id="phone" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                        </div>
                                                        <div>
                                                            <div id="dropzone" class="dropzone" style=" width: 139px !important; height: 139px !important; padding:0%">
                                                                <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}" style="width:100%; height: 100%; border-radius: 50%; object-fit: cover;" alt="text">
                                                                <div class="file-input-container">
                                                                    <input class="file-input" type="file" name="upload_image" id="fileInput1">
                                                                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                                                        <img src="{{ asset('assets/icons/{$user->user_image}') }}" class=" w-11" alt="icon">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label for="" class="text-gray-700 block text-left mb-1 ">Role</label>
                                                                <select id="role" name="role" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                                    <option value="">role</option>
                                                                    @foreach ($user_roles as $row)
                                                                    <option  {{ $user->user_role == $row['role'] ? 'selected' : '' }}>{{ $row['role'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" col-span-2 my-2">
                                                            <label for="" class="text-gray-700 block text-left mb-1 ">Address</label>
                                                            <textarea name="address" id="" placeholder="Address" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$user->address}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                                                            <div  class=" text-center hidden spinner" id="spinner">
                                                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                                </svg>
                                                            </div>
                                                            <div class="text" id="text">
                                                                save
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById("edit-user{{$user->id}}").addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("edit-user-modal{{$user->id}}").classList.remove('hidden');
                                    });

                                    document.querySelector(".modal-close{{$user->id}}").addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("edit-user-modal{{$user->id}}").classList.add('hidden');
                                        document.getElementById("formData{{$user->id}}").reset();
                                    });
                                </script>

                                <form class=" inline-block" action="/delete/user/{{$user->id}}" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                <a href="{{ url('/privileges/' . $user->id) }}">
                                    <button>
                                        <div class="text">
                                            <img class="" src="{{ asset('assets/icons/userPrivileges-icon.svg') }}" alt="btn">
                                        </div>
                                        <div class=" text-center hidden spinner">
                                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                            </svg>
                                        </div>
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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addUser-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addUser" id="formData" enctype="multipart/form-data" method="post">
                @csrf
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
                            <label for="" class="text-gray-700 block text-left mb-1 "> First Name</label>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <label for="" class="text-gray-700 block text-left mb-1 ">Last Name</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <label for="" class="text-gray-700 block text-left mb-1 ">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <label for="" class="text-gray-700 block text-left mb-1 ">Phone No</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div>
                            <div id="dropzone" class="dropzone" style=" width: 139px !important; height: 139px !important; padding:0%">
                                <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}" style="width:100%; height: 100%; border-radius: 50%; object-fit: cover;" alt="text">
                                <div class="file-input-container">
                                    <input class="file-input" type="file" name="upload_image" id="fileInput1">
                                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11" alt="icon">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="" class="text-gray-700 block text-left mb-1 ">Role</label>
                                <select id="role" name="role" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                    <option value="">role</option>
                                    @foreach ($user_roles as $row)
                                    <option>{{ $row['role'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="" class="text-gray-700 block text-left mb-1 ">Address</label>
                            <textarea name="address" id="" placeholder="Address" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div  class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Add
                            </div>
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
        $("#formData")[0].reset()
    });
</script>
