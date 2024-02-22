@include('layouts.header')
<div class="my-4">
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" p-3 bg-[#930027] rounded-t-lg">
        <h1 class=" text-2xl font-semibold text-white">Privileges</h1>
        </div>
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
                                    <div>
                                        <div class=" my-auto">
                                            <div class="relative inline-block text-left">
                                                <div>
                                                    <button type="button" class=" inline-flex w-full text-white justify-center gap-x-1.5 rounded-md bg-[#930027] px-2 py-2 text-sm font-semibol shadow-sm hover:bg-[#930017]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
                                                        More
                                                        <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div id="action-menu" class=" topbar-manuLeaving absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                    <div class="py-1" role="none">
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][contacts]" id="privilegeEstimateContacts" {{ isset($user->user_privileges['estimate']['contacts']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateContacts" class=" text-gray-500">Contacts</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][items]" id="privilegeEstimateItems" {{ isset($user->user_privileges['estimate']['items']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateItems" class=" text-gray-500">Items</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][files]" id="privilegeEstimateFiles" {{ isset($user->user_privileges['estimate']['files']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateFiles" class=" text-gray-500">Files</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][photos]" id="privilegeEstimatePhotos" {{ isset($user->user_privileges['estimate']['photos']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimatePhotos" class=" text-gray-500">Photos</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][proposals]" id="privilegeEstimateProposals" {{ isset($user->user_privileges['estimate']['proposals']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateProposals" class=" text-gray-500">Proposals</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][notes]" id="privilegeEstimateNotes" {{ isset($user->user_privileges['estimate']['notes']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateNotes" class=" text-gray-500">Notes</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][emails]" id="privilegeEstimateEmails" {{ isset($user->user_privileges['estimate']['emails']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateEmails" class=" text-gray-500">Emails</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][timeentries]" id="privilegeEstimateTimeentries" {{ isset($user->user_privileges['estimate']['timeentries']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateTimeentries" class=" text-gray-500">Time Entries</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][todos]" id="privilegeEstimateTodos" {{ isset($user->user_privileges['estimate']['todos']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateTodos" class=" text-gray-500">To-Dos</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="privileges[estimate][expenses]" id="privilegeEstimateExpenses" {{ isset($user->user_privileges['estimate']['expenses']) ? 'checked' : '' }}>
                                                            <label for="privilegeEstimateExpenses" class=" text-gray-500">Expenses</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                <button  class="bg-[#930027] text-white m-2  p-2 rounded-md font-medium">
                    Update
                </button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var menubutton = document.getElementById('action-menubutton');
            var menu = document.getElementById('action-menu');
    
            menubutton.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('topbar-menuEntring');
                menu.classList.toggle('topbar-manuLeaving');
            });
    
            document.addEventListener('click', function (e) {
                if (!menubutton.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('topbar-manuLeaving');
                    menu.classList.remove('topbar-menuEntring');
                }
            });
        });
    </script>