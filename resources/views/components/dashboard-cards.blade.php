<div class=" bg-[#FCFCFC] rounded-lg">
    <div class=" p-2 ">
        <div class="flex justify-between w-full">
            <div>
                <p class=" text-gray-400">{{ $title }}</p>
                <p class=" text-lg font-semibold">{{ $value }}</p>
            </div>
            <div class=" float-right">
                <img src="{{ asset('assets/icons/' . $img) }}" alt="">
            </div>
        </div>
    </div>
</div>