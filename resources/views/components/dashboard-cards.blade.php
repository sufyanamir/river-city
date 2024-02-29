<div class=" bg-[#FCFCFC] rounded-lg shadow-lg">
    <div class=" p-4 ">
        <div class="flex justify-between  items-center w-full">
            <div>
                <p class=" text-gray-400  font-semibold">{{ $title }}</p>
                <p class=" text-lg font-semibold">{{ $value }}</p>
            </div>
            <div class=" float-right">
                <img src="{{ asset('assets/icons/' . $img) }}" alt="">
            </div>
        </div>
    </div>
</div>
