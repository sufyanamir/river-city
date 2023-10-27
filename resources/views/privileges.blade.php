@include('layouts.header')
<div class="my-4">
    <h1 class=" text-2xl font-semibold mb-3">Privileges</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" lg:flex justify-between p-3 grid sm:grid-cols-2 mx-auto">

            <img class=" w-28 h-28" src="{{ asset('assets/images/demo-user.svg') }}" alt="">
            <div class="ml-8 mt-7">
                <h4 class=" text-xl font-semibold">User Full Name</h4>
                <p class="text-[#858585]">Department Role</p>
            </div>
            {{-- address --}}
            <div class=" w-1/2 mt-8 pl-16 text-[#858585]">
                <p>
                    User Address 222 Merrimac ST
                    Newburyport, Massachusetts 01950
                </p>
            </div>
            <div class="sm:pl:8  mt-8 pl-16 text-[#858585]">
                <p>Useremail@gmail.com</p>
                <p>978-379-7979</p>
            </div>

        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <div class="border grid grid-cols-12 p-3  font-bold   ">
                    <p class="col-span-8 pl-14"><input type="checkbox" class="" name="" id="priName"> <label for="priName">Name</label></p>
                    <p class="col-span-4">Action</p>
                </div>
                <div class="p-3 ">
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeUser">
                            <label for="addPrivilegeUser" class=" font-bold">Users</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" name="Edit" id="privilegeUserEdit">
                                    <label for="privilegeUserEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeUserDelete">
                                    <label for="privilegeUserDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" checked name="Add" id="privilegeUserAdd">
                                    <label for="privilegeUserAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" name="" id="addPrivilegeEstimate">
                            <label for="addPrivilegeEstimate" class=" font-bold">Estimate</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" name="Edit" id="privilegeEstimateEdit">
                                    <label for="privilegeEstimateEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeEstimateDelete">
                                    <label for="privilegeEstimateDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" checked name="Add" id="privilegeEstimateAdd">
                                    <label for="privilegeEstimateAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addprivilegeSchedule">
                            <label for="addprivilegeSchedule" class=" font-bold">Schedule</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeScheduleEdit">
                                    <label for="privilegeScheduleEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeScheduleDelete">
                                    <label for="privilegeScheduleDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeScheduleAdd">
                                    <label for="privilegeScheduleAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeItem">
                            <label for="addPrivilegeItem" class=" font-bold">Items</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeItemsEdit">
                                    <label for="privilegeItemsEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeItemsDelete">
                                    <label for="privilegeItemsDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeItemsAdd">
                                    <label for="privilegeItemsAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeLabour">
                            <label for="addPrivilegeLabour" class=" font-bold">Labour</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeLabourEdit">
                                    <label for="privilegeLabourEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeLabourDelete">
                                    <label for="privilegeLabourDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeLabourAdd">
                                    <label for="privilegeLabourAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeMaterials">
                            <label for="addPrivilegeMaterials" class=" font-bold">Materials</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeMaterialsEdit">
                                    <label for="privilegeMaterialsEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeMaterialsDelete">
                                    <label for="privilegeMaterialsDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeMaterialsAdd">
                                    <label for="privilegeMaterialsAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeFiles">
                            <label for="addPrivilegeFiles" class=" font-bold">Files</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeFilesEdit">
                                    <label for="privilegeFilesEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeFilesDelete">
                                    <label for="privilegeFilesDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeFilesAdd">
                                    <label for="privilegeFilesAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-4">
                        <div class="pl-[57px] col-span-8 ">
                            <input type="checkbox" checked name="" id="addPrivilegeCampaign">
                            <label for="addPrivilegeCampaign" class=" font-bold">Campaign</label>
                        </div>
                        <div class="col-span-4 mr-20">
                            <div class="flex justify-between">
                                <div>
                                    <input type="checkbox" checked name="Edit" id="privilegeCampaignEdit">
                                    <label for="privilegeCampaignEdit" class=" text-gray-500">Edit</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Delete" id="privilegeCampaignDelete">
                                    <label for="privilegeCampaignDelete" class=" text-gray-500">Delete</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="Add" id="privilegeCampaignAdd">
                                    <label for="privilegeCampaignAdd" class=" text-gray-500">Add</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="border text-right">
            <x-add-button :title="'Update'" :id="''" :class="'m-5 px-6'"></x-add-button>
        </div>
</div>
@include('layouts.footer')