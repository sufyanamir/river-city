<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="https://kit.fontawesome.com/4ae3f77a6d.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
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
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="crew-dropdown-card1">
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
        </div>
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="user-dropdown-card1">
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
        </div>
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
        <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/payment-template'" :title="'PAY Template'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
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
        @if(isset($userPrivileges->user) && $userPrivileges->user->view === "on")
            <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/users'" :title="'Users'" :hoverIcon="'user-icon.svg'" :icon="'user-icon.svg'"></x-sidebar-links>
            @endif
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
        <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="crew-dropdown-card1">
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
        </div>
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
        <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        @if(isset($userPrivileges->paymentTemplates) && $userPrivileges->paymentTemplates->view === "on")
        <x-sidebar-links :class="'text-white'" :url="'/payment-template'" :title="'PAY Template'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links>
        @endif
        @if(isset($userPrivileges->feedGallery) && $userPrivileges->feedGallery->view === "on")
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
                    <div class=" my-auto">
                        <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                    </div>
                    <!-------------------------------- plus icon ------------------------------------>
                    <div class=" my-auto">
                        <x-quick-add-btn :hoverIcon="''" :icon="'plus-icon.svg'"></x-quick-add-btn>
                    </div>
                    <!-------------------------------- plus icon ------------------------------------>
                    <!-------------------------------- notification icon ------------------------------------>
                    <div class="relative my-auto">
                        <a href="/notifications">
                            <img src="{{ asset('assets/icons/bell.svg') }}" alt="logo">
                            <div class="absolute top-0 right-0 bg-[#F5222D] text-white rounded-full w-4 h-4 flex items-center justify-center">
                                3
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
            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addEstimate-modal">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                    </div>

                    <!-- Modal panel -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg">
                        <form action="" id="addEstimate-form">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <!-- Modal content here -->
                                <div class=" flex justify-between border-b-2">
                                    <h2 class=" text-xl font-semibold mb-2 text-[#930027]" >Add Customer</h2>
                                    <button class="modal-close" type="button">
                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                    </button>
                                </div>
                                <!-- task details -->
                                <div class=" text-center grid grid-cols-4 gap-2">
                                    <div class=" flex justify-between border-b-2 mb-2 col-span-4 mt-4">
                                        <h2 class=" text-xl font-semibold mb-2 text-[#930027]" >Contact</h2>
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">First Name</h5>
                                        <input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Last  Name</h5>
                                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Last  Name</h5>
                                        <input type="text" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Phone No.</h5>
                                        <input type="tel" name="phone" id="phone" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-4 ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Company Name (Optional)</h5>
                                        <input type="text" name="companyName" id="companyName" placeholder="Company Name (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" flex justify-between border-b-2 mb-2 col-span-4  mt-1 mb-3">
                                        <h2 class=" text-xl font-semibold mb-2 text-[#930027]" >Billing</h2>
                                    </div>
                                    <div class=" col-span-2 ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Last  Name</h5>
                                        <input type="text" name="address1" id="address1" placeholder="Address 1" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2 ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Address 2 (Optional)</h5>
                                        <input type="text" name="address2" id="address2" placeholder="Address 2 (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">City</h5>
                                        <input type="text" name="city" id="city" placeholder="City" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">State/Province</h5>
                                        <input type="text" name="state" id="state" placeholder="State/Province" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Zip/Postal Code</h5>
                                        <input type="text" name="zipCode" id="zipCode" placeholder="Zip/Postal Code" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Tax</h5>
                                        <input type="text" name="taxRate" id="taxRate" placeholder="Tax Rate (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Potential Value</h5>
                                        <input type="text" name="potentialValue" id="potentialValue" placeholder="Potential Value" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-4">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Note</h5>
                                        <input type="text" name="note" id="note" placeholder="Internal Notes (Optional, only visible to employees)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Source</h5>
                                        <input type="text" name="source" id="source" placeholder="Source (Optional)" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Owner</h5>
                                        <input type="text" name="owner" id="owner" placeholder="Owner Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <!-- <div class=" pt-3">


                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <input type="email" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <input type="tel" name="number" id="number" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div> -->
                                </div>
                                <div class=" flex justify-between border-b-2 mb-2 mt-4">
                                    <h2 class=" text-xl font-semibold mb-2 text-[#930027]" id="modal-title">Add Estimate</h2>
                                </div>
                                <div class=" text-center grid grid-cols-4 gap-2">
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Estimate Date</h5>
                                        <input type="date" name="owner" id="owner" placeholder="Owner Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Email</h5>
                                        <input type="text" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Phone</h5>
                                        <input type="tel" name="phone" id="phone" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Schedule Date</h5>
                                        <input type="date" name="phone" id="phone" placeholder="Schedule Date/Time" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-2">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Select Schedule</h5>
                                        <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                            <option>Select Schedule</option>
                                            <option>Canada</option>
                                            <option>Mexico</option>
                                        </select>
                                    </div>
                                    <div class=" col-span-2 ">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Address</h5>
                                        <input type="text" name="address" id="address" placeholder="Address" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    </div>
                                    <div class=" col-span-4 relative">
                                        <h5 class="text-gray-600 mb-1  font-medium text-left">Note</h5>
                                        <textarea type="text" name="estimate_note" id="estimate_note" placeholder="Note" class="  p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"></textarea>
                                        <button type="button" id="estimate-mic" class=" absolute mt-10 right-4" onclick="voice('estimate-mic', 'estimate_note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                    </div>
                                </div>
                                <div class="">
                                    <button id="updateEvent" class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
