<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
    <title>River City</title>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar:horizontal {
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            border: 1px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track:hover {
            background-color: #930027;
        }

        ::-webkit-scrollbar-track:horizontal {
            display: none;
        }

        ::-webkit-scrollbar-horizontal {
            display: none;
        }

        .sidebar-link:hover {
            .plain-icon {
                display: none;
            }

            .hover-icon {
                display: block;
            }
        }
    </style>
    <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
</head>
<!-- Debug: Display decoded user_privileges -->
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp

<body class="bg-[#930027]">
    @if(session('user_details')['user_role'] == 'admin')
    <div class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <img src="{{ asset('assets/icons/projectLogo.svg') }}" class=" mx-auto" alt="icon">
                <!-- <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i> -->
            </div>
        </div>
        <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
        <x-sidebar-links :class="'text-white'" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'" :icon="'dashboard-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/customers'" :title="'Customers'" :hoverIcon="'hover-user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/estimates'" :title="'Estimates'" :hoverIcon="'hover-estimate-icon.svg'" :icon="'estimate-icon.svg'"></x-sidebar-links>
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card1">
            <img class=" plain-icon" src="{{ asset('assets/icons/item-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-item-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="dropdown-text1">Items</span>
                <span class="text-sm duration-300" id="arrow1">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>

        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="submenu1">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/items'" :title="'Items'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/itemTemplates'" :title="'Templates'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/group'" :title="'Groups'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
        </div>
        <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/feedGallery'" :title="'Gallery'" :hoverIcon="'hover-gallery-icon.svg'" :icon="'gallery-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/campaign'" :title="'Campaign'" :hoverIcon="'hover-campaign-icon.svg'" :icon="'campaign-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/reports'" :title="'Reports'" :hoverIcon="'hover-reports-icon.svg'" :icon="'reports-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/emails'" :title="'Email Templates'" :hoverIcon="'hover-emailTemplate-icon.svg'" :icon="'emailTemplate-icon.svg'"></x-sidebar-links>
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card2">
            <img class=" plain-icon" src="{{ asset('assets/icons/user-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-user-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="dropdown-text2">Users</span>
                <span class="text-sm duration-300" id="arrow2">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu2">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/users'" :title="'Users'" :hoverIcon="'user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/userRole'" :title="'User role'" :hoverIcon="'userRole-icon.svg'" :icon="'userRole-icon.svg'"></x-sidebar-links>
        </div>
        <x-sidebar-links :class="'text-white'" :url="'/crew'" :title="'Crew'" :hoverIcon="'hover-user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'" :icon="'settings-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'" :icon="'help-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'" :icon="'logout-icon.svg'"></x-sidebar-links>
    </div>
    @elseif(session('user_details')['user_role'] == 'crew')
    <div class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <img src="{{ asset('assets/icons/projectLogo.svg') }}" class=" mx-auto" alt="icon">
                <!-- <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i> -->
            </div>
        </div>
        <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
        <x-sidebar-links :class="'text-white'" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'" :icon="'dashboard-icon.svg'"></x-sidebar-links>
        {{-- <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="crew-dropdown-card1">
            <img class=" plain-icon" src="{{ asset('assets/icons/estimate-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-estimate-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="crew-dropdown-text1">Jobs</span>
                <span class="text-sm duration-300" id="crew-arrow1">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="crew-submenu1">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/jobs'" :title="'All'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/completeJobs'" :title="'Complete'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/pendigJobs'" :title="'Pending'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/approvedJobs'" :title="'Approved'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/cancelJobs'" :title="'Cancel'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
        </div> --}}
        <x-sidebar-links :class="'text-white'" :url="'/jobs'" :title="'Jobs'" :hoverIcon="'hover-item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'" :icon="'settings-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'" :icon="'help-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'" :icon="'logout-icon.svg'"></x-sidebar-links>
    </div>
    @else
    <div class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <img src="{{ asset('assets/icons/projectLogo.svg') }}" class=" mx-auto" alt="icon">
                <!-- <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i> -->
            </div>
        </div>
        <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
        <x-sidebar-links :class="'text-white'" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'" :icon="'dashboard-icon.svg'"></x-sidebar-links>
        @if(isset($userPrivileges->customers) && $userPrivileges->customers->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/customers'" :title="'Customers'" :hoverIcon="'hover-user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->estimate) && $userPrivileges->estimate->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/estimates'" :title="'Estimates'" :hoverIcon="'hover-estimate-icon.svg'" :icon="'estimate-icon.svg'"></x-sidebar-links>
        @endif
        <!-- <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="crew-dropdown-card1">
            <img class=" plain-icon" src="{{ asset('assets/icons/estimate-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-estimate-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="crew-dropdown-text1">Jobs</span>
                <span class="text-sm duration-300" id="crew-arrow1">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="crew-submenu1">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/jobs'" :title="'All'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/completeJobs'" :title="'Complete'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/pendigJobs'" :title="'Pending'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/approvedJobs'" :title="'Approved'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/cancelJobs'" :title="'Cancel'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
        </div> -->
        <!-- <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="user-dropdown-card1">
            <img class=" plain-icon" src="{{ asset('assets/icons/estimate-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-estimate-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="user-dropdown-text1">Estimates</span>
                <span class="text-sm duration-300" id="user-arrow1">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="user-submenu1">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/estimates'" :title="'All'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/completeEstimates'" :title="'Complete'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/pendigEstimates'" :title="'Pending'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/approvedEstimates'" :title="'Approved'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/cancelEstimates'" :title="'Cancel'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
        </div> -->
        @if(isset($userPrivileges->item) && $userPrivileges->item->view === "on")
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card1">
            <img class=" plain-icon" src="{{ asset('assets/icons/item-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-item-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="dropdown-text1">Items</span>
                <span class="text-sm duration-300" id="arrow1">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>

        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="submenu1">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/items'" :title="'Items'" :hoverIcon="'item-icon.svg'" :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/group'" :title="'Groups'" :hoverIcon="'group-icon.svg'" :icon="'group-icon.svg'"></x-sidebar-links>
        </div>
        @endif
        @if(isset($userPrivileges->calendar) && $userPrivileges->calendar->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        @endif
        {{-- <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links> --}}
        @if(isset($userPrivileges->paymentTemplates) && $userPrivileges->paymentTemplates->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/payment-template'" :title="'PAY Template'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->gallery) && $userPrivileges->gallery->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/feedGallery'" :title="'Gallery'" :hoverIcon="'hover-gallery-icon.svg'" :icon="'gallery-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->campaign) && $userPrivileges->campaign->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/campaign'" :title="'Campaign'" :hoverIcon="'hover-campaign-icon.svg'" :icon="'campaign-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->reports) && $userPrivileges->reports->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/reports'" :title="'Reports'" :hoverIcon="'hover-reports-icon.svg'" :icon="'reports-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->emails) && $userPrivileges->emails->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/emails'" :title="'Email Templates'" :hoverIcon="'hover-emailTemplate-icon.svg'" :icon="'emailTemplate-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->user) && $userPrivileges->user->view === "on")
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card2">
            <img class=" plain-icon" src="{{ asset('assets/icons/user-icon.svg') }}" alt="icon">
            <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-user-icon.svg') }}" alt="icon">
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4 font-bold" id="dropdown-text2">Users</span>
                <span class="text-sm duration-300" id="arrow2">
                    <i class="bi bi-chevron-down"></i>
                </span>
            </div>
        </div>
        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu2">
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/users'" :title="'Users'" :hoverIcon="'user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/userRole'" :title="'User role'" :hoverIcon="'userRole-icon.svg'" :icon="'userRole-icon.svg'"></x-sidebar-links>
        </div>
        @endif
        @if(isset($userPrivileges->crew) && $userPrivileges->crew->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/crew'" :title="'Crew'" :hoverIcon="'hover-user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
        @endif
        <x-sidebar-links :class="'text-white'" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'" :icon="'settings-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'" :icon="'help-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'" :icon="'logout-icon.svg'"></x-sidebar-links>
    </div>
    @endif
    <div class="bg-[#930027] h-screen">
        <div class="main-container duration-500 rounded-l-3xl h-screen overflow-auto bg-[#edf2f7] ml-[250px] p-3">
            <div class="topbar py-1 flex justify-between">
                <div>
                    <span class=" text-white text-4xl cursor-pointer open-sidebar hidden">
                        <i class="bi bi-filter-left px-2 bg-[#930027] rounded-md"></i>
                    </span>
                </div>
                <div class="flex justify-end gap-5">
                    {{-- <div class=" my-auto">
                        @if (session('user_details')['user_role'] == 'admin')
                            <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                        @elseif(isset($userPrivileges->estimate) && isset($userPrivileges->estimate->add) && $userPrivileges->estimate->add === 'on')
                            <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                        @endif
                    </div> --}}
                    <!-------------------------------- plus icon ------------------------------------>
                    @if(session('user_details')['user_role'] == 'admin')
                    <div class=" my-auto">
                        <x-quick-add-btn :hoverIcon="''" :icon="'plus-icon.svg'"></x-quick-add-btn>
                    </div>
                    @endif
                    <!-------------------------------- plus icon ------------------------------------>
                    <!-------------------------------- notification icon ------------------------------------>
                    <div class="relative my-auto">
                        <a href="/notifications">
                            <img src="{{ asset('assets/icons/bell.svg') }}" alt="logo">
                            <div class="absolute top-0 right-0 bg-[#F5222D] text-white rounded-full w-3 h-3 flex items-center justify-center">
                                
                            </div>
                        </a>
                    </div>
                    <!-------------------------------- notification icon ------------------------------------>
                    <!-------------------------------- profile icon ------------------------------------>
                    <div class=" my-auto">
                        <x-profile-dropdown></x-profile-dropdown>
                    </div>
                    <!-------------------------------- profile icon ------------------------------------>
                </div>
            </div>
            