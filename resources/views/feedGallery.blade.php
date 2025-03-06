@include('layouts.header')
<div class="my-4">
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="rounded-t-lg bg-[#930027] grid sm:grid-cols-12 ">
            <div class="col-span-6 flex justify-between p-4">
                <h2 class="my-auto pr-3 font-medium  text-white">Gallery list</h2>
            </div>
        </div>
        <hr class="bg-gray-900">
        <div class=" overflow-x-auto p-2">
            <table id="universalTable" class="display" style="width:100%">
                <thead class=" text-white text-sm">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="universalTableBody" class=" text-sm">
                    @foreach ($estimates_with_images as $item)
                    <tr>
                    <td>
                            {{ $item['estimate']->estimate_id }}
                        </td>
                        <td>
                        {{ $item['estimate']->customer_name }} {{ $item['estimate']->customer_last_name }}
                        </td>
                        <td>
                            <div class="grid sm:grid-cols-11 bg-[#F5F5F5] rounded-[10px] m-4">
                                <div class="col-span-5 p-2 flex justify-between">
                                    <a href="/viewGallery{{ $item['estimate']->estimate_id }}">
                                        <div class="pl-3">
                                            <h3 class="text-[#323C47] font-bold">{{ $item['estimate']->project_name }}</h3>
                                            <p class="font-medium text-sm text-[#858585]">
                                                {{ $item['estimate']->customer_address }}
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
                                        <img src="{{ asset('storage/' . $image->estimate_image) }}" style="object-fit: cover" class=" rounded-md w-full h-20" alt="Estimate Image">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layouts.footer')