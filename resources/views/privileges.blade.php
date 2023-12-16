@include('layouts.header')
<div class="my-4">
    <h1 class=" text-2xl font-semibold mb-3">Privileges</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" lg:flex justify-between p-3 grid sm:grid-cols-2 mx-auto">

            <img class=" w-28 h-28 rounded-full" style="object-fit: cover;" src="{{ (isset($user->user_image)) ? asset($user->user_image) : 'assets/images/demo-user.svg'}}" alt="">
            <div class="ml-8 mt-7">
                <h4 class=" text-xl font-semibold">{{ $user->name }} {{ $user->last_name }}</h4>
                <p class="text-[#858585]">{{ $user->user_departement }} {{ $user->user_role }}</p>
            </div>
            {{-- address --}}
            <div class=" w-1/2 mt-8 pl-16 text-[#858585]">
                <p>
                    {{ $user->address }}
                </p>
            </div>
            <div class="sm:pl:8  mt-8 pl-16 text-[#858585]">
                <p>{{ $user->email }}</p>
                <p>{{ $user->phone }}</p>
            </div>

        </div>
        <form action="/addUserPrivileges/{{ $user->id }}" method="post">
            @csrf
            <div class="py-4">
                <div class=" overflow-x-auto">
                    <div class="border grid grid-cols-12 p-3  font-bold   ">
                        <p class="col-span-8 pl-14"><input type="checkbox" class="" name="" id="priName"> <label for="priName">Name</label></p>
                        <p class="col-span-4">Action</p>
                    </div>
                    <div class="p-3 ">
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[user]" id="addPrivilegeUser" {{ isset($user->user_privileges['user']) ? 'checked' : '' }}>
                                <label for="addPrivilegeUser" class=" font-bold">Users</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[user][edit]" id="privilegeUserEdit" {{ isset($user->user_privileges['user']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeUserEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[user][delete]" id="privilegeUserDelete" {{ isset($user->user_privileges['user']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeUserDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[user][add]" id="privilegeUserAdd" {{ isset($user->user_privileges['user']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeUserAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[user][view]" id="privilegeUserView" {{ isset($user->user_privileges['user']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeUserView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[estimate]" id="addPrivilegeEstimate" {{ isset($user->user_privileges['estimate']) ? 'checked' : '' }}>
                                <label for="addPrivilegeEstimate" class=" font-bold">Estimate</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[estimate][edit]" id="privilegeEstimateEdit" {{ isset($user->user_privileges['estimate']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeEstimateEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[estimate][delete]" id="privilegeEstimateDelete" {{ isset($user->user_privileges['estimate']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeEstimateDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[estimate][add]" id="privilegeEstimateAdd" {{ isset($user->user_privileges['estimate']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeEstimateAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[estimate][view]" id="privilegeEstimateView" {{ isset($user->user_privileges['estimate']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeEstimateView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[schedule]" id="addprivilegeSchedule" {{ isset($user->user_privileges['schedule']) ? 'checked' : '' }}>
                                <label for="addprivilegeSchedule" class=" font-bold">Schedule</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[schedule][edit]" id="privilegeScheduleEdit" {{ isset($user->user_privileges['schedule']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeScheduleEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[schedule][delete]" id="privilegeScheduleDelete" {{ isset($user->user_privileges['schedule']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeScheduleDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[schedule][add]" id="privilegeScheduleAdd" {{ isset($user->user_privileges['schedule']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeScheduleAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[schedule][view]" id="privilegeScheduleView" {{ isset($user->user_privileges['schedule']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeScheduleView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[item]" id="addPrivilegeItem" {{ isset($user->user_privileges['item']) ? 'checked' : '' }}>
                                <label for="addPrivilegeItem" class=" font-bold">Items</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[item][edit]" id="privilegeItemsEdit" {{ isset($user->user_privileges['item']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeItemsEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[item][delete]" id="privilegeItemsDelete" {{ isset($user->user_privileges['item']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeItemsDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[item][add]" id="privilegeItemsAdd" {{ isset($user->user_privileges['item']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeItemsAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[item][view]" id="privilegeItemsView" {{ isset($user->user_privileges['item']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeItemsView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[labour]" id="addPrivilegeLabour" {{ isset($user->user_privileges['labour']) ? 'checked' : '' }}>
                                <label for="addPrivilegeLabour" class=" font-bold">Labour</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[labour][edit]" id="privilegeLabourEdit" {{ isset($user->user_privileges['labour']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeLabourEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[labour][delete]" id="privilegeLabourDelete" {{ isset($user->user_privileges['labour']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeLabourDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[labour][add]" id="privilegeLabourAdd" {{ isset($user->user_privileges['labour']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeLabourAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[labour][view]" id="privilegeLabourView" {{ isset($user->user_privileges['labour']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeLabourView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[materials]" id="addPrivilegeMaterials" {{ isset($user->user_privileges['materials']) ? 'checked' : '' }}>
                                <label for="addPrivilegeMaterials" class=" font-bold">Materials</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[materials][edit]" id="privilegeMaterialsEdit" {{ isset($user->user_privileges['materials']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeMaterialsEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[materials][delete]" id="privilegeMaterialsDelete" {{ isset($user->user_privileges['materials']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeMaterialsDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[materials][add]" id="privilegeMaterialsAdd" {{ isset($user->user_privileges['materials']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeMaterialsAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[materials][view]" id="privilegeMaterialsView" {{ isset($user->user_privileges['materials']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeMaterialsView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[files]" id="addPrivilegeFiles" {{ isset($user->user_privileges['files']) ? 'checked' : '' }}>
                                <label for="addPrivilegeFiles" class=" font-bold">Files</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[files][edit]" id="privilegeFilesEdit" {{ isset($user->user_privileges['files']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeFilesEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[files][delete]" id="privilegeFilesDelete" {{ isset($user->user_privileges['file']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeFilesDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[files][add]" id="privilegeFilesAdd"  {{ isset($user->user_privileges['files']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeFilesAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[files][view]" id="privilegeFilesView"  {{ isset($user->user_privileges['files']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeFilesView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[campaign]" id="addPrivilegeCampaign" {{ isset($user->user_privileges['campaign']) ? 'checked' : '' }}>
                                <label for="addPrivilegeCampaign" class=" font-bold">Campaign</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[campaign][edit]" id="privilegeCampaignEdit" {{ isset($user->user_privileges['camapign']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeCampaignEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[campaign][delete]" id="privilegeCampaignDelete" {{ isset($user->user_privileges['campaign']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeCampaignDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[campaign][add]" id="privilegeCampaignAdd" {{ isset($user->user_privileges['campaign']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeCampaignAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[campaign][view]" id="privilegeCampaignView" {{ isset($user->user_privileges['campaign']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeCampaignView" class=" text-gray-500">View</label>
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
        </form>
    </div>
    @include('layouts.footer')