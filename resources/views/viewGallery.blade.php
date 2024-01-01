@include('layouts.header')
@php
    $userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full overflow-auto rounded-lg shadow-lg">
        <div class="grid sm:grid-cols-11 p-4">
            <div class="col-span-1  flex justify-end p-3 pr-0">
                <button type="button" class="flex">
                    <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}"
                        alt="">
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
                    <span class="pl-2">Project Owner: {{ $customer->owner }}
                    </span>
                </p>
            </div>
        </div>
        <hr class="bg-gray-300 my-3 h-[2px] w-full">
        <div id="universalTableBody">
            <div class=" grid sm:grid-cols-11 pb-4 px-4">
                <div class="col-span-1"></div>
                <div class="col-span-10 px-3  flex justify-between">
                    <p class="text-[22px]/[25.78px] font-medium">Images <span>{{ count($estimate_images) }}</span></p>
                    @if (session('user_details')['user_role'] == 'admin')
                        <x-add-button :title="'Add Image'" :class="'px-4'" :id="'addImage-btn'" />
                    @elseif(isset($userPrivileges->gallery) && isset($userPrivileges->gallery->add) && $userPrivileges->gallery->add === 'on')
                        <x-add-button :title="'Add Image'" :class="'px-4'" :id="'addImage-btn'" />
                    @endif
                </div>
            </div>
            <hr class="bg-gray-300 h-[2px] w-full">
            <div class="grid sm:grid-cols-12 p-4">
                <div class="col-span-1"></div>
                <div class="col-span-10 p-3 grid grid-cols-3">
                    @foreach ($estimate_images as $image)
                        <div class="col-span-1 p-2 relative">
                            <a href="{{ asset('storage/' . $image->estimate_image) }}" data-fancybox="image-set"
                                data-caption="Your Image Caption">
                                <img class="rounded-xl" style="width: 100%; height: 200px; object-fit: cover;"
                                    src="{{ asset('storage/' . $image->estimate_image) }}" alt="">
                            </a>
                            @if (session('user_details')['user_role'] == 'admin')
                                <form action="/deleteEstimateImage{{ $image->estimate_image_id }}" method="post">
                                    @csrf
                                    <button class="cursor-pointer absolute top-4 right-4">
                                        <img class="" src="{{ asset('assets/icons/img-del-icon.svg') }}"
                                            alt="">
                                    </button>
                                </form>
                            @elseif(isset($userPrivileges->gallery) &&
                                    isset($userPrivileges->gallery->delete) &&
                                    $userPrivileges->gallery->delete === 'on')
                                <form action="/deleteEstimateImage{{ $image->estimate_image_id }}" method="post">
                                    @csrf
                                    <button class="cursor-pointer absolute top-4 right-4">
                                        <img class="" src="{{ asset('assets/icons/img-del-icon.svg') }}"
                                            alt="">
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 h-[2px] w-full">
        <div class="p-3 px-6">
            <x-add-button :title="'Back'" :class="' px-7 bg-black-100 border-2 text-[#000]'" :id="'back-btn'" />
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addImage-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addEstimateImage" enctype="multipart/form-data" method="post" id="addImage-btn-form">
                @csrf
                <input type="hidden" value="{{ $estimate->estimate_id }}" name="estimate_id" id="estimate_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Images</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2  py-2">
                        <div>
                            <input type="hidden" name="estimate_id" id="estimate_id"
                                value="{{ $estimate->estimate_id }}">
                            <input type="file" name="upload_image[]" id="upload_image" multiple>
                        </div>
                    </div>
                    <div class=" border-t">
                        <button id=""
                            class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addImage-btn").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").addClass('hidden');
        $("#addImage-btn-form")[0].reset()
    });
</script>
<script>
    $(document).ready(function() {
        $("#back-btn").on("click", function() {
            window.history.back();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({
            // Options for Fancybox
            loop: true, // Enables looping through images
            buttons: ["slideShow", "fullScreen", "thumbs", "close"],
        });
    });
</script>
