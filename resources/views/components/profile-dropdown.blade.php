<div>
    <div class="grid grid-cols-2 gap-1">
        <div>
            <h6 class="">Lorem Ipsum</h6>
            <p class="text-xs text-[#ACADAE]">Administer</p>
        </div>
        <button type="button" class="w-10" id="profile-btn">
            <img src="{{ asset('assets/icons/userprofile-icon.svg') }}" alt="icon">
        </button>
    </div>
    <div id="profile-menu" class=" topbar-manuLeaving absolute right-1 z-10 mt-2 w-56 origin-top-right rounded-md bg-[#930027] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="#" class=" block px-4 py-2 text-sm bg-[#edf2f7] text-[#930027]" role="menuitem" tabindex="-1" id="menu-item-0"><b>Profile</b></a>
            <a href="/settings" class=" sidebar-link text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200" role="menuitem" tabindex="-1" id="menu-item-1">
                <div class="flex justify-start">
                    <img class=" plain-icon" src="{{ asset('assets/icons/single-user.svg') }}" alt="icon">
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-single-user.svg') }}" alt="icon">
                    <p class=" mx-auto">My Account</p>
                </div>
            </a>
            <a href="/" class=" sidebar-link text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200" role="menuitem" tabindex="-1" id="menu-item-1">
                <div class="flex justify-start">
                    <img class=" plain-icon" src="{{ asset('assets/icons/logout2.svg') }}" alt="icon">
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-logout2.svg') }}" alt="icon">
                    <p class=" mx-auto">Logout</p>
                </div>
            </a>
        </div>
    </div>
</div>