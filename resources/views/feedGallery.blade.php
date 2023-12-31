@include('layouts.header')
<div class="my-4">
    <h1 class=" text-2xl font-semibold mb-3">Gallery</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="m-2  just grid sm:grid-cols-12 ">
            <div class="col-span-6 flex justify-between p-4">
                <h2 class="my-auto pr-3 font-medium  text-black">Gallery list</h2>
                <x-add-button :title="'All'" :id="''" :class="'bg-[#E02B20] px-6'"></x-add-button>
                <x-add-button :title="'New'" :id="''" :class="' px-6'"></x-add-button>
                <x-add-button :title="'Pending'" :id="''" :class="' px-6'"></x-add-button>
                <x-add-button :title="'Complete'" :id="''" :class="' px-6'"></x-add-button>
            </div>
            <div class="col-span-6 flex justify-end">
                <div class="my-auto">
                    <img class=" m-2" src="{{ asset('assets/images/searchbox.svg') }}" alt="">
                </div>
            </div>
        </div>
        <hr class="bg-gray-900">
        @foreach ($estimates_with_images as $item)
        <div class="grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
            <div class="col-span-5 p-2 flex justify-between">
                <a href="/viewGallery{{ $item['estimate']->estimate_id }}">
                    <div class="pl-3">
                        <h3 class="text-[#323C47] font-bold">{{ $item['estimate']->project_name }}</h3>
                        <p class="font-medium text-sm text-[#858585]">
                            {{ $item['estimate']->customer_name }} {{ $item['estimate']->customer_last_name }} / {{ $item['estimate']->customer_address }}
                        </p>
                    </div>
                    <div class="pl-3">
                        <h3 class="text-[#323C47] font-bold">Images</h3>
                        <p class="font-medium text-sm text-[#858585]">{{ count($item['images']) }}</p>
                    </div>
                </a>
            </div>
            <div class="col-span-1 p-3">
                <div class="h-full mx-auto rounded bg-[#D9D9D9] w-[5px]"></div>
            </div>
            <div class="col-span-5 grid grid-cols-5 gap-3 mx-2 my-auto">
                @foreach ($item['images']->take(5) as $image)
                <div class="col-span-1 py-2">
                    <img src="{{ asset('storage/' . $image->estimate_image) }}" style="object-fit: cover" class=" w-full h-20" alt="Estimate Image">
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')