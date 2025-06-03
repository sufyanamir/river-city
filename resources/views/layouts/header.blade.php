@php
    use App\Models\Notifications;
    use Illuminate\Support\Facades\Auth;

    $user = session('user_details');
    $notificationsCount = Notifications::where('added_user_id', $user['id'])
        ->where('notification_status', 'unread')
        ->where('notification_type', '<>', 'mention')
        ->count()
        + Notifications::where('mentioned_user_id', $user['id'])
        ->whereIn('notification_type', ['mention', 'mentionGallery'])
        ->where('notification_status', 'unread')
        ->count();
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <script type="module" src="https://cdn.jsdelivr.net/npm/player.style/tailwind-audio/+esm"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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

        .sidebar {
            /* add transition for transform */
            transition: transform 0.5s ease;
            /* initially sidebar is visible on large screens */
            transform: translateX(0);
        }

        .sidebar.sidebar-hidden {
            /* hide sidebar by sliding it to the left */
            transform: translateX(-100%);
        }

        .sidebar-slide-out {
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .sidebar-slide-in {
            transform: translateX(0);
            transition: transform 0.5s ease;
        }

        @media (max-width: 499px) {
            .navLogo{
                width: 115px !important;

            }
        }

         @media (max-width: 767px) {
            .
        }
        /* Large screen width animation */
        @media (min-width: 1024px) {
            .sidebar-collapse {
                width: 0 !important;
                transition: width 0.5s ease;
                overflow: hidden;
            }

            .sidebar-expand {
                width: 250px !important;
                transition: width 0.5s ease;
            }
        }

        /* Transition for main container margin and border-radius */
        .main-container {
            transition: margin-left 0.5s ease, border-radius 0.5s ease;
        }

  /* Full screen loader */
 #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }
      #loader img {
          width: 300px;
          fill: #930027;
      }


    </style>
    <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
</head>
<!-- Debug: Display decoded user_privileges -->
@php
    $userPrivileges = session('user_details')['user_privileges'];
@endphp


<body class="bg-[#930027]">
    <div id="loader">
    <img src="{{ asset('assets/images/infinite-spinner.svg') }}" alt="Loading">
  </div>
<div id="main-dashbords" style="display: block;">

    <audio id="messageSound" src="{{ asset('assets/sounds/message-sound.wav') }}"></audio>
    @if (session('user_details')['user_role'] == 'admin')
        <div
            class="sidebar fixed top-0 left-0 h-screen w-[250px] bg-[#930027] z-[10] duration-500 overflow-y-auto text-center">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <img src="{{ asset('assets/icons/projectLogo.svg') }}" class=" mx-auto" alt="icon">
                    <button id="sidebarClose" class="text-white text-3xl lg:hidden cursor-pointer p-2 ">
                        <i class="bi bi-x bg-[#930027] px-2 py-1 rounded-md"></i>
                    </button>
                    <!-- <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i> -->
                </div>
            </div>
            <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
            {{-- Dashboard link --}}
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'"
                :icon="'dashboard-icon.svg'"></x-sidebar-links>
            {{-- Customer link --}}
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/customers'" :title="'Customers'" :hoverIcon="'hover-user-icon.svg'"
                :icon="'user-icon.svg'"></x-sidebar-links>
            {{-- Estimates link --}}
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/estimates'" :title="'Estimates'" :hoverIcon="'hover-estimate-icon.svg'"
                :icon="'estimate-icon.svg'"></x-sidebar-links>
            {{-- Items dropdown menu --}}
            <div id="dropdown-card1"
                class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white"
                id="dropdown-card1">
                <img class=" plain-icon" src="{{ asset('assets/icons/item-icon.svg') }}" alt="icon">
                <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-item-icon.svg') }}" alt="icon">
                <div class="flex justify-between w-full items-center">
                    <span class="text-[15px] ml-4 font-bold" id="dropdown-text1">Items</span>
                    <span class="text-sm duration-300" id="arrow1">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </div>

            </div>
            <div id="submenu1"
                class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden">
                <x-sidebar-links :class="'bg-white text-[#930027] sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/items'" :title="'Items'" :hoverIcon="'item-icon.svg'"
                    :icon="'item-icon.svg'"></x-sidebar-links>
                <x-sidebar-links :class="'bg-white text-[#930027] sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/itemTemplates'" :title="'Templates'" :hoverIcon="'item-icon.svg'"
                    :icon="'item-icon.svg'"></x-sidebar-links>
                <x-sidebar-links :class="'bg-white text-[#930027] sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/group'" :title="'Groups'" :hoverIcon="'group-icon.svg'"
                    :icon="'group-icon.svg'"></x-sidebar-links>
            </div>
            {{-- Other admin links --}}
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'"
                :icon="'calendar-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'"
                :icon="'calendar-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/feedGallery'" :title="'Gallery'" :hoverIcon="'hover-gallery-icon.svg'"
                :icon="'gallery-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/campaign'" :title="'Campaign'" :hoverIcon="'hover-campaign-icon.svg'"
                :icon="'campaign-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/reports'" :title="'Reports'" :hoverIcon="'hover-reports-icon.svg'"
                :icon="'reports-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/emails'" :title="'Email Templates'" :hoverIcon="'hover-emailTemplate-icon.svg'"
                :icon="'emailTemplate-icon.svg'"></x-sidebar-links>

            {{-- User dropdown menu --}}
            <div id="dropdown-card2"
                class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white"
                id="dropdown-card2">
                <img class=" plain-icon" src="{{ asset('assets/icons/user-icon.svg') }}" alt="icon">
                <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-user-icon.svg') }}" alt="icon">
                <div class="flex justify-between w-full items-center">
                    <span class="text-[15px] ml-4 font-bold" id="dropdown-text2">Users</span>
                    <span class="text-sm duration-300" id="arrow2">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </div>
            </div>
            <div id="submenu2" class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden">
                <x-sidebar-links :class="'bg-white text-[#930027] sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/users'" :title="'Users'" :hoverIcon="'user-icon.svg'"
                    :icon="'user-icon.svg'"></x-sidebar-links>
                <x-sidebar-links :class="'bg-white text-[#930027] sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/userRole'" :title="'User role'" :hoverIcon="'userRole-icon.svg'"
                    :icon="'userRole-icon.svg'"></x-sidebar-links>
            </div>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/crew'" :title="'Crew'" :hoverIcon="'hover-user-icon.svg'"
                :icon="'user-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'"
                :icon="'settings-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027] '" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'"
                :icon="'help-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027]'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'"
                :icon="'logout-icon.svg'"></x-sidebar-links>
        </div>
    @elseif(session('user_details')['user_role'] == 'crew')
        {{-- Crew sidebar --}}
        <div
            class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027] z-50">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center relative">
                    <img src="{{ asset('assets/icons/projectLogo.svg') }}" class=" mx-auto" alt="icon">

                    <!-- <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i> -->

                </div>
            </div>
            <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
            <x-sidebar-links :class="'text-white'" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'"
                :icon="'dashboard-icon.svg'"></x-sidebar-links>
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
            <x-sidebar-links :class="'text-white'" :url="'/jobs'" :title="'Jobs'" :hoverIcon="'hover-item-icon.svg'"
                :icon="'item-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'"
                :icon="'calendar-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'"
                :icon="'settings-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'"
                :icon="'help-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'"
                :icon="'logout-icon.svg'"></x-sidebar-links>
        </div>
    @else
        {{-- Default sidebar for other roles --}}
        <div
            class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
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
            <x-sidebar-links :class="'text-white'" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'hover-dashboard-icon.svg'"
                :icon="'dashboard-icon.svg'"></x-sidebar-links>
            @if (isset($userPrivileges->customers) && $userPrivileges->customers->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/customers'" :title="'Customers'" :hoverIcon="'hover-user-icon.svg'"
                    :icon="'user-icon.svg'"></x-sidebar-links>
            @endif
            @if (isset($userPrivileges->estimate) && $userPrivileges->estimate->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/estimates'" :title="'Estimates'" :hoverIcon="'hover-estimate-icon.svg'"
                    :icon="'estimate-icon.svg'"></x-sidebar-links>
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

            {{-- Check if user has 'view' privilege for 'item' --}}
            @if (isset($userPrivileges->item) && $userPrivileges->item->view === 'on')
                {{-- Sidebar dropdown menu for Items --}}
                <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white"
                    id="dropdown-card1">
                    {{-- Default icon --}}
                    <img class=" plain-icon" src="{{ asset('assets/icons/item-icon.svg') }}" alt="icon">
                    {{-- Hover icon, initially hidden --}}
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-item-icon.svg') }}"
                        alt="icon">

                    {{-- Menu title and arrow --}}
                    <div class="flex justify-between w-full items-center">
                        <span class="text-[15px] ml-4 font-bold" id="dropdown-text1">Items</span>
                        <span class="text-sm duration-300" id="arrow1">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>

                </div>
                {{-- Submenu items, initially hidden --}}
                <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden"
                    id="submenu1">
                    <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/items'" :title="'Items'" :hoverIcon="'item-icon.svg'"
                        :icon="'item-icon.svg'"></x-sidebar-links>
                    <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/group'" :title="'Groups'" :hoverIcon="'group-icon.svg'"
                        :icon="'group-icon.svg'"></x-sidebar-links>
                </div>
            @endif
            {{-- Calendar Links: Check if user has view privilege --}}

            {{-- Payment Templates Link --}}
            @if (isset($userPrivileges->calendar) && $userPrivileges->calendar->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'hover-calendar-icon.svg'"
                    :icon="'calendar-icon.svg'"></x-sidebar-links>
                <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'"
                    :icon="'calendar-icon.svg'"></x-sidebar-links>
            @endif



            {{-- Gallery Link --}}
            {{-- <x-sidebar-links :class="'text-white'" :url="'/crewCalendar'" :title="'Crew Calendar'" :hoverIcon="'hover-calendar-icon.svg'" :icon="'calendar-icon.svg'"></x-sidebar-links> --}}
            @if (isset($userPrivileges->paymentTemplates) && $userPrivileges->paymentTemplates->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/payment-template'" :title="'PAY Template'" :hoverIcon="'hover-calendar-icon.svg'"
                    :icon="'calendar-icon.svg'"></x-sidebar-links>
            @endif

            {{-- Campaign Link --}}
            @if (isset($userPrivileges->gallery) && $userPrivileges->gallery->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/feedGallery'" :title="'Gallery'" :hoverIcon="'hover-gallery-icon.svg'"
                    :icon="'gallery-icon.svg'"></x-sidebar-links>
            @endif

            {{-- Reports Link --}}
            @if (isset($userPrivileges->campaign) && $userPrivileges->campaign->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/campaign'" :title="'Campaign'" :hoverIcon="'hover-campaign-icon.svg'"
                    :icon="'campaign-icon.svg'"></x-sidebar-links>
            @endif


            {{-- Email Templates Link --}}
            @if (isset($userPrivileges->reports) && $userPrivileges->reports->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/reports'" :title="'Reports'" :hoverIcon="'hover-reports-icon.svg'"
                    :icon="'reports-icon.svg'"></x-sidebar-links>
            @endif
            {{-- User Dropdown Menu --}}
            @if (isset($userPrivileges->emails) && $userPrivileges->emails->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/emails'" :title="'Email Templates'" :hoverIcon="'hover-emailTemplate-icon.svg'"
                    :icon="'emailTemplate-icon.svg'"></x-sidebar-links>
            @endif
            @if (isset($userPrivileges->user) && $userPrivileges->user->view === 'on')
                <div class="p-2.5 mt-3 sidebar-link flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white"
                    id="dropdown-card2">
                    <img class=" plain-icon" src="{{ asset('assets/icons/user-icon.svg') }}" alt="icon">
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-user-icon.svg') }}"
                        alt="icon">
                    <div class="flex justify-between w-full items-center">
                        <span class="text-[15px] ml-4 font-bold" id="dropdown-text2">Users</span>
                        <span class="text-sm duration-300" id="arrow2">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>
                </div>
                {{-- User submenu, hidden by default --}}
                <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu2">
                    {{-- Link to Users page --}}
                    <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/users'" :title="'Users'" :hoverIcon="'user-icon.svg'"
                        :icon="'user-icon.svg'"></x-sidebar-links>
                    {{-- Link to User Roles page --}}
                    <x-sidebar-links :class="'bg-white text-[#930027]'" :url="'/userRole'" :title="'User role'" :hoverIcon="'userRole-icon.svg'"
                        :icon="'userRole-icon.svg'"></x-sidebar-links>
                </div>
            @endif
            {{-- Crew Link --}}
            @if (isset($userPrivileges->crew) && $userPrivileges->crew->view === 'on')
                <x-sidebar-links :class="'text-white'" :url="'/crew'" :title="'Crew'" :hoverIcon="'hover-user-icon.svg'"
                    :icon="'user-icon.svg'"></x-sidebar-links>
            @endif
            {{-- Static sidebar links (always shown) --}}
            <x-sidebar-links :class="'text-white'" :url="'/settings'" :title="'Settings'" :hoverIcon="'hover-settings-icon.svg'"
                :icon="'settings-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/help'" :title="'Help'" :hoverIcon="'hover-help-icon.svg'"
                :icon="'help-icon.svg'"></x-sidebar-links>
            <x-sidebar-links :class="'text-white'" :url="'/logout'" :title="'Logout'" :hoverIcon="'hover-logout-icon.svg'"
                :icon="'logout-icon.svg'"></x-sidebar-links>
        </div>
    @endif
    {{-- Sidebar background --}}
    <div class="bg-[#930027] h-screen">
        {{-- Main container for content, shifted right to make room for sidebar --}}
        <div class="main-container duration-500 rounded-l-3xl h-screen overflow-auto bg-[#edf2f7] ml-[250px] ps-4">
            {{-- Topbar --}}
            <div class="topbar py-1 flex justify-between bg-[#fff] rounded-[12px] sticky top-0 z-[9]">
                {{-- Sidebar toggle button for smaller screens --}}
                <div class="flex justify-center items-center">
                    <button id="sidebarToggle" class="text-white text-3xl cursor-pointer p-2">
                        <i class="bi bi-list bg-[#930027] px-2 py-1 rounded-md"></i>
                        <i class="bi bi-x bg-[#930027] px-2 py-1 rounded-md hidden toggle-close-icon"></i>
                    </button>
                </div>
                <a href="{{route('dashboard')}}" class="flex"><img id="navSideLogo" src="{{ asset('assets/icons/projectLogo.svg') }}" class="navLogo mx-[9px] justify-center" alt="icon"></a>
            {{-- @dd(session('user_details')) --}}


                {{-- Center Side --}}
                <div class="gap-6 hidden sm:hidden md:hidden lg:flex">
                     {{-- Dashboard link --}}
                    <x-sidebar-links :class="' text-[#930027] sidebar-link p-2 my-3 flex items-center rounded-md  duration-300 cursor-pointer hover:bg-[#930027] hover:text-white  mx-0  '" :url="'/dashboard'" :title="'Dashboard'" :hoverIcon="'dashboard-icon.svg'"
                        :icon="'hover-dashboard-icon.svg'"></x-sidebar-links>
                    {{-- Customers link --}}
                    <x-sidebar-links :class="' text-[#930027] sidebar-link p-2 my-3 flex items-center rounded-md duration-300 cursor-pointer hover:bg-[#930027] hover:text-white  mx-0  '" :url="'/customers'" :title="'Customers'" :hoverIcon="'user-icon.svg'"
                     :icon="'hover-user-icon.svg'"></x-sidebar-links>
                    {{-- Estimates link --}}
                    <x-sidebar-links :class="' text-[#930027] sidebar-link p-2 my-3 flex items-center rounded-md duration-300 cursor-pointer hover:bg-[#930027] hover:text-white  mx-0 '" :url="'/estimates'" :title="'Projects'" :hoverIcon="'estimate-icon.svg'"
                        :icon="'hover-estimate-icon.svg'"></x-sidebar-links>
                    <x-sidebar-links :class="' text-[#930027] sidebar-link p-2 my-3 flex items-center rounded-md \duration-300 cursor-pointer hover:bg-[#930027] hover:text-white  mx-0 '" :url="'/calendar'" :title="'Calendar'" :hoverIcon="'calendar-icon.svg'"
                        :icon="'hover-calendar-icon.svg'"></x-sidebar-links>
                    <x-sidebar-links :class="' text-[#930027] sidebar-link p-2 my-3 flex items-center rounded-md duration-300 cursor-pointer hover:bg-[#930027] hover:text-white  mx-0 '" :url="'/settings'" :title="'Settings'" :hoverIcon="'settings-icon.svg'"
                :icon="'hover-settings-icon.svg'"></x-sidebar-links>
                </div>


                {{-- Right-side icons and buttons --}}
                <div class="flex justify-end gap-5">
                    {{-- <div class=" my-auto">
                        @if (session('user_details')['user_role'] == 'admin')
                            <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                        @elseif(isset($userPrivileges->estimate) && isset($userPrivileges->estimate->add) && $userPrivileges->estimate->add === 'on')
                            <x-add-button :title="'+Add Estimates'" :class="'addEstimate'" :id="''"></x-add-button>
                        @endif
                    </div> --}}
                    <!-------------------------------- plus icon ------------------------------------>

                    {{-- Add button visible only for admin users --}}
                    @if (session('user_details')['user_role'] == 'admin')
                        {{-- <div class=" my-auto">
                            <x-quick-add-btn :hoverIcon="''" :icon="'plus-icon.svg'"></x-quick-add-btn>
                        </div> --}}
                    @endif
                    <!-------------------------------- plus icon ------------------------------------>
                    <!-------------------------------- notification icon ------------------------------------>
                    {{-- Notification bell with unread indicator --}}
                    <div class="relative my-auto">
                        <a href="/notifications">
                            <img src="{{ asset('assets/icons/bell.svg') }}" alt="logo">
                            @if(isset($notificationsCount) && $notificationsCount > 0)
                            <div class="absolute top-0 right-0 bg-[#F5222D] text-white rounded-full w-3 h-3 flex items-center justify-center p-2 text-xs">
                                {{ $notificationsCount }}
                            </div>
                            @endif
                        </a>
                    </div>
                    <!-------------------------------- notification icon ------------------------------------>
                    <!-------------------------------- profile icon ------------------------------------>

                    {{-- User profile dropdown --}}
                    <div class=" my-auto">
                        <x-profile-dropdown></x-profile-dropdown>
                    </div>
                    <!-------------------------------- profile icon ------------------------------------>
                </div>
            </div>
