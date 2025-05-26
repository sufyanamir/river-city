<div>
    <div class="grid grid-cols-2 gap-1">
        <div>
            @if (session()->has('user_details'))
                <h6 class="text-[#0000000]">{{ session('user_details')['name'] }}</h6>
                <p class="text-xs text-[#ACADAE]">{{ session('user_details')['user_role'] }}</p>
            @endif
        </div>
        @php
            $userImage = session('user_details')['user_image'] ?? null;
            $imageSrc = $userImage ? asset($userImage) : asset('assets/images/demo-user.svg');
        @endphp

        <button type="button" id="profile-btn">
            <img  id="user_img" class="h-10 w-10 rounded-md" style="object-fit: cover;" src="{{ $imageSrc }}" alt="icon"
                onerror="this.onerror=null;this.src='{{ asset('assets/images/demo-user2.png') }}';">
        </button>

    </div>
    <div id="profile-menu"
        class=" topbar-manuLeaving absolute right-1 z-10 mt-2 w-56 origin-top-right rounded-md bg-[#930027] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <span class=" block px-4 py-2 text-sm bg-[#edf2f7] text-[#930027]" role="menuitem" tabindex="-1"
                id="menu-item-0"><b>Profile</b></span>
            <a href="/settings"
                class=" sidebar-link text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200"
                role="menuitem" tabindex="-1" id="menu-item-1">
                <div class="flex justify-start">
                    <img class=" plain-icon" src="{{ asset('assets/icons/single-user.svg') }}" alt="icon">
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-single-user.svg') }}"
                        alt="icon">
                    <p class=" mx-auto">My Account</p>
                </div>
            </a>
            <a href="/logout"
                class=" sidebar-link text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200"
                role="menuitem" tabindex="-1" id="menu-item-1">
                <div class="flex justify-start">
                    <img class=" plain-icon" src="{{ asset('assets/icons/logout2.svg') }}" alt="icon">
                    <img class=" hover-icon hidden" src="{{ asset('assets/icons/hover-logout2.svg') }}" alt="icon">
                    <p class=" mx-auto">Logout</p>
                </div>
            </a>
        </div>
    </div>
</div>
