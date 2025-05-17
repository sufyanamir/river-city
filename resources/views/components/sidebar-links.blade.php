<a href="{{ $url }}">
    <div class="{{ $class }} sidebar-link p-2 mt-3 flex items-center rounded-md px-4 mx-5 duration-300 cursor-pointer hover:bg-[#edf2f7] hover:text-[#930027]">
        <img class=" plain-icon" src="{{ asset('assets/icons/' . $icon) }}" alt="icon">
        <img class=" hover-icon hidden" src="{{ asset('assets/icons/' . $hoverIcon) }}" alt="icon">
        <span class="text-[15px] ml-4 font-bold">{{ $title }}</span>
    </div>
</a>
