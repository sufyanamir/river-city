@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">User Roles</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Roles List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Role'" :id="'addRole'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Departement</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td><img class=" w-18 h-18 rounded-full" src="{{ asset('assets/images/demo-user.svg') }}" alt="image"></td>
                            <td>Client Name</td>
                            <td>John</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addRole-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="addRole-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add User Role</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-1 gap-2">
                        <h3 class=" text-lg font-medium text-left">Details</h3>
                        <div class=" my-2">
                            <input type="text" name="departement" id="departement" placeholder="Enter Departement" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2">
                            <input type="text" name="role" id="role" placeholder="Enter Role" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                    </div>
                    <div class="">
                        <button id="updateEvent" class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addRole").click(function(e) {
        e.preventDefault();
        $("#addRole-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addRole-modal").addClass('hidden');
        $("#addRole-form")[0].reset()
    });
</script>