<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  @vite('resources/css/app.css')
</head>
  <body class="bg-blue-600">
    <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="openSidebar()">
      <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
    </span>
    <div class="sidebar duration-500 fixed top-0 bottom-0 lg:left-0 w-[250px] overflow-y-auto text-center bg-[#930027]">
      <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
          <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
          <h1 class="font-bold text-gray-200 text-[15px] ml-3">TailwindCSS</h1>
          <i class="bi bi-x cursor-pointer ml-16 " onclick="openSidebar()"></i>
        </div>
        <div class="my-2 bg-gray-600 h-[1px]"></div>
      </div>
      <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
      </div> -->
      <x-sidebarLinks :title="'Dashboard'" :icon="'dashboard-icon.svg'"></x-sidebarLinks>
      <x-sidebarLinks :title="'Customers'" :icon="'user-icon.svg'"></x-sidebarLinks>
      <x-sidebarLinks :title="'Estimates'" :icon="'estimate-icon.svg'"></x-sidebarLinks>
      <div  class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer mx-5 hover:bg-[#edf2f7] hover:text-[black] text-white" onclick="dropdown()">
        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.8C0 1.32261 0.263392 0.864773 0.732233 0.527208C1.20107 0.189642 1.83696 0 2.5 0H17.5C18.163 0 18.7989 0.189642 19.2678 0.527208C19.7366 0.864773 20 1.32261 20 1.8V16.2C20 16.6774 19.7366 17.1352 19.2678 17.4728C18.7989 17.8104 18.163 18 17.5 18H2.5C1.83696 18 1.20107 17.8104 0.732233 17.4728C0.263392 17.1352 0 16.6774 0 16.2V1.8ZM17.5 1.8H2.5V16.2H17.5V1.8ZM9.435 4.2867C9.66934 4.45547 9.80098 4.68435 9.80098 4.923C9.80098 5.16165 9.66934 5.39052 9.435 5.5593L7.00375 7.308C6.71076 7.51877 6.31354 7.63716 5.89937 7.63716C5.48521 7.63716 5.08799 7.51877 4.795 7.308L3.69 6.5124C3.57061 6.42938 3.47538 6.33007 3.40987 6.22026C3.34436 6.11046 3.30988 5.99236 3.30844 5.87286C3.30699 5.75336 3.33862 5.63485 3.40147 5.52424C3.46432 5.41363 3.55714 5.31315 3.67451 5.22864C3.79187 5.14414 3.93144 5.07731 4.08506 5.03206C4.23868 4.98681 4.40328 4.96404 4.56925 4.96507C4.73523 4.96611 4.89925 4.99094 5.05176 5.03811C5.20426 5.08528 5.34219 5.15384 5.4575 5.2398L5.9 5.5584L7.6675 4.2858C7.90191 4.11708 8.21979 4.02229 8.55125 4.02229C8.8827 4.02229 9.20059 4.11798 9.435 4.2867ZM11.25 6.3C11.25 6.06131 11.3817 5.83239 11.6161 5.6636C11.8505 5.49482 12.1685 5.4 12.5 5.4H15C15.3315 5.4 15.6495 5.49482 15.8839 5.6636C16.1183 5.83239 16.25 6.06131 16.25 6.3C16.25 6.53869 16.1183 6.76761 15.8839 6.9364C15.6495 7.10518 15.3315 7.2 15 7.2H12.5C12.1685 7.2 11.8505 7.10518 11.6161 6.9364C11.3817 6.76761 11.25 6.53869 11.25 6.3ZM3.75 10.35C3.75 9.99196 3.94754 9.64858 4.29917 9.39541C4.65081 9.14223 5.12772 9 5.625 9H8.125C8.62228 9 9.09919 9.14223 9.45083 9.39541C9.80246 9.64858 10 9.99196 10 10.35V12.15C10 12.508 9.80246 12.8514 9.45083 13.1046C9.09919 13.3578 8.62228 13.5 8.125 13.5H5.625C5.12772 13.5 4.65081 13.3578 4.29917 13.1046C3.94754 12.8514 3.75 12.508 3.75 12.15V10.35ZM6.25 10.8V11.7H7.5V10.8H6.25ZM11.25 11.25C11.25 11.0113 11.3817 10.7824 11.6161 10.6136C11.8505 10.4448 12.1685 10.35 12.5 10.35H15C15.3315 10.35 15.6495 10.4448 15.8839 10.6136C16.1183 10.7824 16.25 11.0113 16.25 11.25C16.25 11.4887 16.1183 11.7176 15.8839 11.8864C15.6495 12.0552 15.3315 12.15 15 12.15H12.5C12.1685 12.15 11.8505 12.0552 11.6161 11.8864C11.3817 11.7176 11.25 11.4887 11.25 11.25Z" fill="white"/>
          </svg>
          
        <div class="flex justify-between w-full items-center">
          <span class="text-[15px] ml-4 text-black-600 font-bold">Items</span>
          <span class="text-sm rotate-180" id="arrow">
            <i class="bi bi-chevron-down"></i>
          </span>
        </div>
      </div>
      <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-[#edf2f7] hover:text-[black] mx-5 rounded-md mt-1">
          Items
        </h1>
        <h1 class="cursor-pointer p-2 hover:bg-[#edf2f7] hover:text-[black] mx-5 rounded-md mt-1">
          Groups
        </h1>
      </div>
      <x-sidebarLinks :title="'Calendar'" :icon="'calendar-icon.svg'"></x-sidebarLinks>

      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-box-arrow-in-right"></i>
        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
      </div>
    </div>
    <div class="bg-[#930027] h-screen">
      <div class="main-container duration-500 rounded-l-3xl h-screen overflow-auto bg-[#edf2f7] ml-[250px] p-3">
 