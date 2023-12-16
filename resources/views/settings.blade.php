@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Settings</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="p-3">
            <form action="">
                <div class="text-center mb-2">
                    <div id="dropzone" class="dropzone" style="padding: 0 !important">
                        <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;" alt="text">
                        <div class="file-input-container">
                            <input class="file-input" type="file" name="upload_image" id="fileInput1">
                            <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11" alt="icon">
                            </div>
                        </div>
                    </div>
                    <h3>Lorumipsum@email.com</h3>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="full_name" class="block mb-2 font-medium text-[#930027]">Full name</label>
                        <input type="text" id="full_name" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Your Name" required>
                    </div>
                    <div>
                        <label for="phone_number" class="block mb-2 font-medium text-[#930027]">Phone Number</label>
                        <input type="text" id="phone_number" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Your Number" required>
                    </div>
                    <div class=" col-span-2">
                        <label for="Address" class="block mb-2 font-medium text-[#930027]">Address</label>
                        <input type="text" id="Address" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Your Address" required>
                    </div>
                    <div class=" col-span-2">
                        <label for="old_password" class="block mb-2 font-medium text-[#930027]">Old Password</label>
                        <input type="text" id="old_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Password" required>
                    </div>
                    <div class=" ">
                        <label for="new_password" class="block mb-2 font-medium text-[#930027]">New Password</label>
                        <input type="text" id="new_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter New Password" required>
                    </div>
                    <div class=" ">
                        <label for="confirm_password" class="block mb-2 font-medium text-[#930027]">Confirm New Password</label>
                        <input type="text" id="confirm_password" class="bg-gray-50 border outline-none border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Confirm Password" required>
                    </div>
                </div>
                <div class="my-3 text-right">
                    <x-add-button :title="'Update'" :id="''" :class="'px-7'"></x-add-button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
