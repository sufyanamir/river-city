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
                                <input type="checkbox" name="privileges[customers]" id="addPrivilegecustomers" {{ isset($user->user_privileges['customers']) ? 'checked' : '' }}>
                                <label for="addPrivilegecustomers" class=" font-bold">Customers</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[customers][edit]" id="privilegeCustomersEdit" {{ isset($user->user_privileges['customers']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeCustomersEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[customers][delete]" id="privilegeCustomersDelete" {{ isset($user->user_privileges['customers']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeCustomersDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[customers][add]" id="privilegeCustomersAdd" {{ isset($user->user_privileges['customers']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeCustomersAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[customers][view]" id="privilegeCustomersView" {{ isset($user->user_privileges['customers']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeCustomersView" class=" text-gray-500">View</label>
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
                                <input type="checkbox" name="privileges[campaign]" id="addPrivilegeCampaign" {{ isset($user->user_privileges['campaign']) ? 'checked' : '' }}>
                                <label for="addPrivilegeCampaign" class=" font-bold">Campaign</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[campaign][edit]" id="privilegeCampaignEdit" {{ isset($user->user_privileges['campaign']['edit']) ? 'checked' : '' }}>
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
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[emails]" id="addPrivilegeEmails" {{ isset($user->user_privileges['emails']) ? 'checked' : '' }}>
                                <label for="addPrivilegeEmails" class=" font-bold">emails</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[emails][edit]" id="privilegeEmailsEdit" {{ isset($user->user_privileges['emails']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeEmailsEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[emails][delete]" id="privilegeEmailsDelete" {{ isset($user->user_privileges['emails']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeEmailsDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[emails][add]" id="privilegeEmailsAdd" {{ isset($user->user_privileges['emails']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeEmailsAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[emails][view]" id="privilegeEmailsView" {{ isset($user->user_privileges['emails']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeEmailsView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="grid grid-cols-12 mt-4">
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
                        </div> --}}
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[crew]" id="addPrivilegeCrew" {{ isset($user->user_privileges['user']) ? 'checked' : '' }}>
                                <label for="addPrivilegeCrew" class=" font-bold">Crew</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    <div>
                                        <input type="checkbox" name="privileges[crew][edit]" id="privilegeCrewEdit" {{ isset($user->user_privileges['crew']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeCrewEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[crew][delete]" id="privilegeCrewDelete" {{ isset($user->user_privileges['crew']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeCrewDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[crew][add]" id="privilegeCrewAdd" {{ isset($user->user_privileges['crew']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeCrewAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[crew][view]" id="privilegeCrewView" {{ isset($user->user_privileges['crew']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeCrewView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[gallery]" id="addPrivilegeGallery" {{ isset($user->user_privileges['gallery']) ? 'checked' : '' }}>
                                <label for="addPrivilegeGallery" class=" font-bold">Gallery</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    {{-- <div>
                                        <input type="checkbox" name="privileges[calendar][edit]" id="privilegeCalendarEdit" {{ isset($user->user_privileges['calendar']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeCalendarEdit" class=" text-gray-500">Edit</label>
                                    </div> --}}
                                    <div>
                                        <input type="checkbox" name="privileges[gallery][delete]" id="privilegeGalleryDelete" {{ isset($user->user_privileges['gallery']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeGalleryDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[gallery][add]" id="privilegeGalleryAdd" {{ isset($user->user_privileges['gallery']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeGalleryAdd" class=" text-gray-500">Add</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[gallery][view]" id="privilegeGalleryView" {{ isset($user->user_privileges['gallery']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeGalleryView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[calendar]" id="addPrivilegeCalendar" {{ isset($user->user_privileges['calendar']) ? 'checked' : '' }}>
                                <label for="addPrivilegeCalendar" class=" font-bold">Calendar</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    {{-- <div>
                                        <input type="checkbox" name="privileges[calendar][edit]" id="privilegeCalendarEdit" {{ isset($user->user_privileges['calendar']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeCalendarEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[calendar][delete]" id="privilegeCalendarDelete" {{ isset($user->user_privileges['calendar']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeCalendarDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[calendar][add]" id="privilegeCalendarAdd" {{ isset($user->user_privileges['calendar']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeCalendarAdd" class=" text-gray-500">Add</label>
                                    </div> --}}
                                    <div>
                                        <input type="checkbox" name="privileges[calendar][view]" id="privilegeCalendarView" {{ isset($user->user_privileges['calendar']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeCalendarView" class=" text-gray-500">View</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-4">
                            <div class="pl-[57px] col-span-8 ">
                                <input type="checkbox" name="privileges[reports]" id="addPrivilegeReports" {{ isset($user->user_privileges['reports']) ? 'checked' : '' }}>
                                <label for="addPrivilegeReports" class=" font-bold">Reports</label>
                            </div>
                            <div class="col-span-4 mr-20">
                                <div class="flex justify-between">
                                    {{-- <div>
                                        <input type="checkbox" name="privileges[reports][edit]" id="privilegeReportsEdit" {{ isset($user->user_privileges['reports']['edit']) ? 'checked' : '' }}>
                                        <label for="privilegeReportsEdit" class=" text-gray-500">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[reports][delete]" id="privilegeReportsDelete" {{ isset($user->user_privileges['reports']['delete']) ? 'checked' : '' }}>
                                        <label for="privilegeReportsDelete" class=" text-gray-500">Delete</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="privileges[reports][add]" id="privilegeReportsAdd" {{ isset($user->user_privileges['reports']['add']) ? 'checked' : '' }}>
                                        <label for="privilegeReportsAdd" class=" text-gray-500">Add</label>
                                    </div> --}}
                                    <div>
                                        <input type="checkbox" name="privileges[reports][view]" id="privilegeReportsView" {{ isset($user->user_privileges['reports']['view']) ? 'checked' : '' }}>
                                        <label for="privilegeReportsView" class=" text-gray-500">View</label>
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
    <script>
        $(document).ready(function () {
            // Function to toggle the state of related checkboxes
            function toggleRelatedCheckboxes(mainCheckbox, relatedCheckboxes) {
                const isChecked = mainCheckbox.prop('checked');

                relatedCheckboxes.prop('disabled', !isChecked);
                relatedCheckboxes.prop('checked', isChecked);
            }

            // Add event listener to each main checkbox
            $('input[type="checkbox"][name^="privileges["]').each(function () {
                const mainCheckbox = $(this);
                const mainCheckboxName = mainCheckbox.attr('name');
                const relatedCheckboxes = $(`input[type="checkbox"][name^="${mainCheckboxName}["]`);

                // Click event handler for each main checkbox
                mainCheckbox.on('click', function () {
                    toggleRelatedCheckboxes(mainCheckbox, relatedCheckboxes);
                });

                // Initial toggle state based on the main checkbox state
                toggleRelatedCheckboxes(mainCheckbox, relatedCheckboxes);
            });
        });
    </script>