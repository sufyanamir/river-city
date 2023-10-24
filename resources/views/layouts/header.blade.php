<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>River City</title>
  <style>
    ::-webkit-scrollbar {
      width: 5px;
    }

    ::-webkit-scrollbar:horizontal {
      height: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(190, 0, 70, 1);
      border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
      /* background-color: #930027; */
    }

    ::-webkit-scrollbar-track:horizontal {
      display: none;
    }

    ::-webkit-scrollbar-horizontal {
      display: none;
    }
  </style>
  <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
  @vite('resources/css/app.css')
</head>

<body class="bg-[#930027]">
  <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer openClose-sidebar">
    <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
  </span>
  <div class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center">
        <img src="{{ asset('assets/icons/projectLogo.svg') }}" alt="">
        <i class="bi bi-x cursor-pointer  ml-6 openClose-sidebar"></i>
      </div>
    </div>
    <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
    <x-sidebarLinks :class="'text-white'" :url="'/'" :title="'Dashboard'" :icon="'dashboard-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="'/customers'" :title="'Customers'" :icon="'user-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="'/estimates'" :title="'Estimates'" :icon="'estimate-icon.svg'"></x-sidebarLinks>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card1">
      <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.8C0 1.32261 0.263392 0.864773 0.732233 0.527208C1.20107 0.189642 1.83696 0 2.5 0H17.5C18.163 0 18.7989 0.189642 19.2678 0.527208C19.7366 0.864773 20 1.32261 20 1.8V16.2C20 16.6774 19.7366 17.1352 19.2678 17.4728C18.7989 17.8104 18.163 18 17.5 18H2.5C1.83696 18 1.20107 17.8104 0.732233 17.4728C0.263392 17.1352 0 16.6774 0 16.2V1.8ZM17.5 1.8H2.5V16.2H17.5V1.8ZM9.435 4.2867C9.66934 4.45547 9.80098 4.68435 9.80098 4.923C9.80098 5.16165 9.66934 5.39052 9.435 5.5593L7.00375 7.308C6.71076 7.51877 6.31354 7.63716 5.89937 7.63716C5.48521 7.63716 5.08799 7.51877 4.795 7.308L3.69 6.5124C3.57061 6.42938 3.47538 6.33007 3.40987 6.22026C3.34436 6.11046 3.30988 5.99236 3.30844 5.87286C3.30699 5.75336 3.33862 5.63485 3.40147 5.52424C3.46432 5.41363 3.55714 5.31315 3.67451 5.22864C3.79187 5.14414 3.93144 5.07731 4.08506 5.03206C4.23868 4.98681 4.40328 4.96404 4.56925 4.96507C4.73523 4.96611 4.89925 4.99094 5.05176 5.03811C5.20426 5.08528 5.34219 5.15384 5.4575 5.2398L5.9 5.5584L7.6675 4.2858C7.90191 4.11708 8.21979 4.02229 8.55125 4.02229C8.8827 4.02229 9.20059 4.11798 9.435 4.2867ZM11.25 6.3C11.25 6.06131 11.3817 5.83239 11.6161 5.6636C11.8505 5.49482 12.1685 5.4 12.5 5.4H15C15.3315 5.4 15.6495 5.49482 15.8839 5.6636C16.1183 5.83239 16.25 6.06131 16.25 6.3C16.25 6.53869 16.1183 6.76761 15.8839 6.9364C15.6495 7.10518 15.3315 7.2 15 7.2H12.5C12.1685 7.2 11.8505 7.10518 11.6161 6.9364C11.3817 6.76761 11.25 6.53869 11.25 6.3ZM3.75 10.35C3.75 9.99196 3.94754 9.64858 4.29917 9.39541C4.65081 9.14223 5.12772 9 5.625 9H8.125C8.62228 9 9.09919 9.14223 9.45083 9.39541C9.80246 9.64858 10 9.99196 10 10.35V12.15C10 12.508 9.80246 12.8514 9.45083 13.1046C9.09919 13.3578 8.62228 13.5 8.125 13.5H5.625C5.12772 13.5 4.65081 13.3578 4.29917 13.1046C3.94754 12.8514 3.75 12.508 3.75 12.15V10.35ZM6.25 10.8V11.7H7.5V10.8H6.25ZM11.25 11.25C11.25 11.0113 11.3817 10.7824 11.6161 10.6136C11.8505 10.4448 12.1685 10.35 12.5 10.35H15C15.3315 10.35 15.6495 10.4448 15.8839 10.6136C16.1183 10.7824 16.25 11.0113 16.25 11.25C16.25 11.4887 16.1183 11.7176 15.8839 11.8864C15.6495 12.0552 15.3315 12.15 15 12.15H12.5C12.1685 12.15 11.8505 12.0552 11.6161 11.8864C11.3817 11.7176 11.25 11.4887 11.25 11.25Z" fill="white" />
      </svg>

      <div class="flex justify-between w-full items-center">
        <span class="text-[15px] ml-4 font-bold" id="dropdown-text1">Items</span>
        <span class="text-sm duration-300" id="arrow1">
          <i class="bi bi-chevron-down"></i>
        </span>
      </div>
    </div>
    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 duration-300 font-bold hidden" id="submenu1">
      <x-sidebarLinks :class="'bg-white text-[#930027]'" :url="'/items'" :title="'Items'" :icon="'item-icon.svg'"></x-sidebarLinks>
      <x-sidebarLinks :class="'bg-white text-[#930027]'" :url="'/group'" :title="'Groups'" :icon="'group-icon.svg'"></x-sidebarLinks>
    </div>
    <x-sidebarLinks :class="'text-white'" :url="''" :title="'Calendar'" :icon="'calendar-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="'/campaign'" :title="'Campaign'" :icon="'campaign-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="''" :title="'Reports'" :icon="'reports-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="'/emails'" :title="'Email Templates'" :icon="'emailTemplate-icon.svg'"></x-sidebarLinks>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[#930027] text-white" id="dropdown-card2">
      <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.0506 7.69166C11.29 7.69166 10.5465 7.46614 9.914 7.04351C9.28154 6.62098 8.78866 6.02031 8.4976 5.31756C8.20645 4.61483 8.13035 3.84156 8.27875 3.09554C8.42715 2.34953 8.79337 1.66427 9.33128 1.12642C9.86908 0.588567 10.5544 0.22229 11.3003 0.0739028C12.0463 -0.0744949 12.8196 0.00166265 13.5224 0.292746C14.2251 0.583829 14.8258 1.07676 15.2483 1.7092C15.6709 2.34165 15.8965 3.0852 15.8965 3.84583C15.8965 4.86581 15.4913 5.84402 14.7701 6.56529C14.0488 7.28646 13.0707 7.69166 12.0506 7.69166ZM12.0506 1.53833C11.5943 1.53833 11.1481 1.67366 10.7687 1.92721C10.3892 2.18077 10.0935 2.54115 9.91882 2.96279C9.74417 3.38443 9.69843 3.84839 9.78744 4.296C9.87656 4.74361 10.0962 5.15477 10.419 5.47749C10.7417 5.80023 11.1529 6.02001 11.6004 6.10902C12.0481 6.19804 12.512 6.1523 12.9336 5.97765C13.3553 5.803 13.7157 5.50723 13.9692 5.1278C14.2228 4.74834 14.3581 4.30221 14.3581 3.84583C14.3581 3.23384 14.115 2.64693 13.6823 2.21418C13.2495 1.78144 12.6626 1.53833 12.0506 1.53833Z" fill="white" />
        <path d="M19.2304 14.8705C19.0273 14.8679 18.8331 14.786 18.6895 14.6423C18.5458 14.4987 18.4639 14.3045 18.4613 14.1014C18.4613 12.1015 17.3742 10.7683 12.0516 10.7683C6.72894 10.7683 5.64185 12.1015 5.64185 14.1014C5.64185 14.3053 5.56081 14.501 5.41656 14.6452C5.27232 14.7895 5.07667 14.8705 4.87268 14.8705C4.66869 14.8705 4.47304 14.7895 4.3288 14.6452C4.18455 14.501 4.10352 14.3053 4.10352 14.1014C4.10352 9.22998 9.67228 9.22998 12.0516 9.22998C14.4309 9.22998 19.9996 9.22998 19.9996 14.1014C19.9969 14.3045 19.9151 14.4987 19.7714 14.6423C19.6277 14.786 19.4336 14.8679 19.2304 14.8705Z" fill="white" />
        <path d="M6.22505 8.52252H5.89687C5.08089 8.44366 4.32967 8.0439 3.80846 7.41113C3.28725 6.77836 3.03875 5.96448 3.11762 5.14846C3.19651 4.33248 3.5963 3.58126 4.22906 3.06004C4.86182 2.53884 5.67571 2.29033 6.4917 2.36921C6.59632 2.37371 6.69893 2.39952 6.79323 2.44508C6.88753 2.49062 6.97153 2.55496 7.04009 2.63411C7.10865 2.71327 7.16033 2.8056 7.19194 2.90544C7.22356 3.00528 7.23446 3.11052 7.22397 3.21472C7.21348 3.31891 7.18182 3.41987 7.13094 3.5114C7.08006 3.60293 7.01102 3.6831 6.92806 3.74701C6.84509 3.81091 6.74995 3.85721 6.64847 3.88305C6.54698 3.90889 6.44129 3.91373 6.33786 3.89728C6.13767 3.87733 5.93551 3.89791 5.74344 3.95782C5.55137 4.01774 5.37336 4.11574 5.22001 4.24597C5.06426 4.37161 4.93508 4.527 4.84 4.70307C4.74491 4.87915 4.68584 5.07238 4.66621 5.27153C4.64501 5.47314 4.66414 5.67702 4.7225 5.87116C4.78086 6.0654 4.87728 6.246 5.00613 6.4025C5.13499 6.5591 5.29371 6.68842 5.47305 6.78298C5.65238 6.87754 5.84876 6.93548 6.05071 6.95343C6.38457 6.98204 6.71881 6.90297 7.00447 6.7278C7.17855 6.62043 7.38817 6.58648 7.58724 6.63366C7.7863 6.68073 7.95845 6.80503 8.06593 6.97907C8.17341 7.1532 8.20725 7.36283 8.16018 7.56189C8.113 7.76095 7.98871 7.93314 7.81466 8.04051C7.33901 8.34387 6.7891 8.51063 6.22505 8.52252Z" fill="white" />
        <path d="M0.769166 14.1012C0.565993 14.0985 0.371897 14.0167 0.228217 13.873C0.0845466 13.7293 0.00265619 13.5352 0 13.332C0 10.563 0.738399 8.71704 4.35861 8.71704C4.5626 8.71704 4.75824 8.79806 4.90249 8.94236C5.04673 9.08655 5.12777 9.28222 5.12777 9.48621C5.12777 9.69019 5.04673 9.88587 4.90249 10.0301C4.75824 10.1744 4.5626 10.2554 4.35861 10.2554C1.94855 10.2554 1.53833 11.0245 1.53833 13.332C1.53568 13.5352 1.45379 13.7293 1.31012 13.873C1.16644 14.0167 0.972338 14.0985 0.769166 14.1012Z" fill="white" />
      </svg>


      <div class="flex justify-between w-full items-center">
        <span class="text-[15px] ml-4 font-bold" id="dropdown-text2">Users</span>
        <span class="text-sm duration-300" id="arrow2">
          <i class="bi bi-chevron-down"></i>
        </span>
      </div>
    </div>
    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu2">
      <x-sidebarLinks :class="'bg-white text-[#930027]'" :url="'/users'" :title="'Users'" :icon="'user-icon.svg'"></x-sidebarLinks>
      <x-sidebarLinks :class="'bg-white text-[#930027]'" :url="'/userRole'" :title="'User role'" :icon="'userRole-icon.svg'"></x-sidebarLinks>
    </div>
    <x-sidebarLinks :class="'text-white'" :url="'/crew'" :title="'Crew'" :icon="'user-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="''" :title="'Settings'" :icon="'settings-icon.svg'"></x-sidebarLinks>
    <x-sidebarLinks :class="'text-white'" :url="''" :title="'Help'" :icon="'help-icon.svg'"></x-sidebarLinks>

    <div class="p-2.5 mt-3  flex items-center rounded-md px-4 duration-300 cursor-pointer text-white">
      <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.54545 8.18182H11.8182V10H4.54545V12.7273L0 9.09091L4.54545 5.45455V8.18182ZM3.63636 14.5455H6.09818C7.1479 15.4712 8.44244 16.0744 9.82648 16.2827C11.2105 16.4909 12.6252 16.2954 13.9009 15.7195C15.1766 15.1437 16.259 14.212 17.0182 13.0362C17.7775 11.8604 18.1814 10.4905 18.1814 9.09091C18.1814 7.69129 17.7775 6.3214 17.0182 5.14563C16.259 3.96985 15.1766 3.03813 13.9009 2.46227C12.6252 1.88642 11.2105 1.69089 9.82648 1.89915C8.44244 2.10741 7.1479 2.71061 6.09818 3.63637H3.63636C4.48242 2.50653 5.5803 1.58956 6.84279 0.958313C8.10528 0.327069 9.49759 -0.00105786 10.9091 2.56208e-06C15.93 2.56208e-06 20 4.07 20 9.09091C20 14.1118 15.93 18.1818 10.9091 18.1818C9.49759 18.1829 8.10528 17.8548 6.84279 17.2235C5.5803 16.5923 4.48242 15.6753 3.63636 14.5455Z" fill="white" />
      </svg>
      <span class="text-[15px] ml-4 text-gray-200  font-bold">Logout</span>
    </div>
  </div>
  <div class="bg-[#930027] h-screen">
    <div class="main-container duration-500 rounded-l-3xl h-screen overflow-auto bg-[#edf2f7] ml-[250px] p-3">
      <div class="topbar py-1">
        <div class="flex justify-end gap-4">
          <!-------------------------------- plus icon ------------------------------------>
          <x-quick-add-btn :icon="'plus-icon.svg'"></x-quick-add-btn>
          <!-------------------------------- plus icon ------------------------------------>
          <!-------------------------------- notification icon ------------------------------------>
          <div class="relative">
            <img src="{{ asset('assets/icons/bell.svg') }}" alt="logo">
            <div class="absolute top-0 right-0 bg-[#F5222D] text-white rounded-full w-4 h-4 flex items-center justify-center">
              3
            </div>
          </div>
          <!-------------------------------- notification icon ------------------------------------>
          <!-------------------------------- profile icon ------------------------------------>
          <x-profile-dropdown></x-profile-dropdown>
          <!-------------------------------- profile icon ------------------------------------>
        </div>
      </div>