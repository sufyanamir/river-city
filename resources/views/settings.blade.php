@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" p-3 bg-[#930027] text-white text-xl font-semibold rounded-t-lg">
            Settings
        </div>
        <div class="p-3">
            <form action="/updateSettings" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ session('user_details')['id'] }}">
                <div class="text-center mb-2">
                    <div id="dropzone" class="profile-dropzone" style="padding: 0 !important">
                        <img id="profileImage" src="{{ (isset($user_details->user_image)) ? asset($user_details->user_image) : 'assets/images/demo-user.svg'}}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;" alt="text">
                        <div class="file-input-container">
                            <input class="file-input" type="file" name="upload_image" id="fileInput1">
                            <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11" alt="icon">
                            </div>
                        </div>
                    </div>
                    <h3>{{ $user_details['email'] }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="full_name" class="block mb-2 font-medium text-[#930027]">Full name</label>
                        <input type="text" id="full_name" name="name" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $user_details['name'] }}" placeholder="Enter Your Name">
                    </div>
                    <div>
                        <label for="phone_number" class="block mb-2 font-medium text-[#930027]">Phone Number</label>
                        <input type="text" id="phone_number" name="phone" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $user_details['phone'] }}" placeholder="XXX-XXX-XXXX/XXXXXXXXXX">
                    </div>
                    <div class=" col-span-2">
                        <label for="Address" class="block mb-2 font-medium text-[#930027]">Address</label>
                        <input type="text" id="Address" name="address" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $user_details['address'] }}" placeholder="Enter Your Address">
                    </div>
                    <div class=" col-span-2">
                        <label for="old_password" class="block mb-2 font-medium text-[#930027]">Old Password</label>
                        <input type="password" id="old_password" name="old_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Password">
                    </div>
                    <div class=" ">
                        <label for="new_password" class="block mb-2 font-medium text-[#930027]">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter New Password">
                    </div>
                    <div class=" ">
                        <label for="confirm_password" class="block mb-2 font-medium text-[#930027]">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Confirm Password">
                        <p id="password_match_status" style="color: green;"></p>
                    </div>
                </div>
                <div class="my-3 text-right">
                    <button id=""  class=" save-btn bg-[#930027] text-white p-2 px-7 rounded-md font-medium">
                        <div  class=" text-center hidden spinner" id="spinner">
                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text" id="text">
                            Update
                        </div>
                    </button>
                </div>
            </form>
        </div>
        @if(session('user_details')['user_role'] == 'admin')
        <div class=" p-3 text-[#930027] text-xl font-semibold border-b-2">
            Company
        </div>
        <div class="p-3">
            <form action="/updateCompany" method="POST">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->company_row_id }}">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="company_labor_cost" class="block mb-2 font-medium text-[#930027]">Labor Cost</label>
                        <input type="text" id="company_labor_cost" name="labor_cost" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $company->company_labor_cost }}">
                    </div>
                    <div>
                        <label for="company_labor_budget" class="block mb-2 font-medium text-[#930027]">Labor</label>
                        <input type="text" id="company_labor_budget" name="labor_budget" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $company->company_labor_budget }}">
                    </div>
                    <div class="">
                        <label for="company_material_budget" class="block mb-2 font-medium text-[#930027]">Material</label>
                        <input type="text" id="company_material_budget" name="material_budget" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $company->company_material_budget }}">
                    </div>
                </div>
                <div class="my-3 text-right">
                    <button id=""  class=" save-btn bg-[#930027] text-white p-2 px-7 rounded-md font-medium">
                        <div  class=" text-center hidden spinner" id="spinner">
                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text" id="text">
                            Update
                        </div>
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        $('#confirm_password').on('input', function() {
            var newPassword = $('#new_password').val();
            var confirmPassword = $(this).val();
            var passwordMatchStatus = $('#password_match_status');

            if (newPassword === confirmPassword) {
                passwordMatchStatus.text('Password matched').css('color', 'green');
            } else {
                passwordMatchStatus.text('Password not matched').css('color', 'red');
            }
        });
    });
</script>