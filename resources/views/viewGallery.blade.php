@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full overflow-auto rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-11 p-4">
            <div class="col-span-1  flex justify-end p-3 pr-0">
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                </button>
            </div>
            <div class="col-span-10  pl-3 ">
                <p class="text-[#F5222D] text-[25px]/[29.3px] font-bold">
                    {{ $estimate->customer_name }} {{ $estimate->customer_last_name }}
                </p>
                <p class="text-[#323C47] text-[20px]/[23.44px] font-semibold">
                    {{ $estimate->project_name }}
                </p>
                <p class="mt-4 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                    <span class="pl-2">{{ $estimate->customer_address }}</span>
                </p>
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/mail-icon.svg') }}" alt="">
                    <span class="pl-2">{{ $customer->customer_email }}
                    </span>
                </p>
                <p class="mt-1 flex text-[#323C47]font-medium">
                    <img src="{{ asset('assets/icons/tel-icon.svg') }}" alt="">
                    <span class="pl-2">{{ $estimate->customer_phone }}
                    </span>
                </p>
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                    <span class="pl-2">Project Owner: {{$customer->owner}}
                    </span>
                </p>
            </div>
        </div>
        <hr class="bg-gray-300 my-3 h-[2px] w-full">
        <div class=" grid sm:grid-cols-11 pb-4 px-4">
            <div class="col-span-1"></div>
            <div class="col-span-10 px-3  flex justify-between">
                <p class="text-[22px]/[25.78px] font-medium">Images <span>{{count($estimate_images)}}</span></p>
                <x-add-button :title="'Add Image'" :class="'px-4'" :id="''" />
            </div>
        </div>
        <hr class="bg-gray-300 h-[2px] w-full">
        <div class="grid sm:grid-cols-12 p-4">
            <div class="col-span-1"></div>
            <div class="col-span-10 p-3 grid grid-cols-3">
                @foreach($estimate_images as $image)
                <div class="col-span-1 p-2 relative">
                    <a href="{{ asset('storage/' . $image->estimate_image) }}" data-fancybox="image-set" data-caption="Your Image Caption">
                        <img class="rounded-xl" style="width: 100%; height: 200px; object-fit: cover;" src="{{ asset('storage/' . $image->estimate_image) }}" alt="">
                    </a>
                    <form action="/deleteEstimateImage{{$image->estimate_image_id}}" method="post">
                        @csrf
                        <button class="cursor-pointer absolute top-4 right-4">
                            <img class="" src="{{asset('assets/icons/img-del-icon.svg')}}" alt="">
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <hr class="bg-gray-300 h-[2px] w-full">
        <div class="p-3 px-6">
            <x-add-button :title="'Back'" :class="' px-7 bg-white border-2 text-[#000] hover:bg-white'" :id="''" />
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({
            // Options for Fancybox
            loop: true, // Enables looping through images
            buttons: ["slideShow", "fullScreen", "thumbs", "close"],
        });
    });
</script>