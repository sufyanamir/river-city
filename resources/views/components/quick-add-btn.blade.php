<div class="relative inline-block text-left">
    <div>
        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
        <img src="{{ asset('assets/icons/' . $icon) }}" alt="icon">    
    </button>
    </div>
    <div id="topbar-menu" class=" topbar-manuLeaving absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-[#930027] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <span class=" block px-4 py-2 text-sm bg-[#edf2f7] text-[#930027]" role="menuitem" tabindex="-1" id="menu-item-0"><b>Utilities</b></span>
            <a href="/customers" class="text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200" role="menuitem" tabindex="-1" id="menu-item-1">Customers</a>
            <a href="/items" class="text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200" role="menuitem" tabindex="-1" id="menu-item-2">Items</a>
            <a href="/estimates" class=" text-white block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200" role="menuitem" tabindex="-1" id="menu-item-2">Estimates</a>
        </div>
    </div>
</div>