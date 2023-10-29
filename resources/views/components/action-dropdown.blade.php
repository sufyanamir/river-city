<div class="relative inline-block text-left">
    <div>
        <button type="button" class=" inline-flex w-full text-white justify-center gap-x-1.5 rounded-md bg-[#930027] px-2 py-2 text-sm font-semibol shadow-sm hover:bg-[#930017]" id="action-menubutton" aria-expanded="true" aria-haspopup="true">
            Options
            <svg class="-mr-1 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <div id="action-menu" class=" topbar-manuLeaving absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <a href="{{url('estimates/new')}}" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-view-icon.svg') }}" alt="icon"> View</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-edit-icon.svg') }}" alt="icon"> Edit</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-report-icon.svg') }}" alt="icon"> Report</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-activity-icon.svg') }}" alt="icon"> Activity</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-files-icon.svg') }}" alt="icon"> Files</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-gallery-icon.svg') }}" alt="icon"> Gallery</a>
            <a href="#" class=" block px-4 py-2 text-sm hover:bg-[#edf2f7] hover:text-[#930027] rounded-sm m-2 duration-200 flex gap-4" role="menuitem" tabindex="-1" id="menu-item-1"><img src="{{ asset('assets/icons/dropdown-del-icon.svg') }}" alt="icon"> Delete</a>
        </div>
    </div>
</div>