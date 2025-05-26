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
                <thead class=" text-black text-sm">
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Customer Details</th>
                    </tr>
                </thead>
                <tbody id="universalTableBody" class=" text-sm">
                    @foreach ($estimates_with_images as $item)
                    <tr>
                    <td>
                            {{ $item['estimate']->estimate_id }}
                        </td>
                        <td>
                        {{ ucfirst($item['estimate']->customer_name) }} {{ ucfirst($item['estimate']->customer_last_name) }}
                        </td>
                        <td>
                            <div class=" bg-[#F5F5F5] flex justify-between rounded-[10px] m-4">
                                <div class=" p-2  ">
                                    <a href="/viewGallery{{ $item['estimate']->estimate_id }}" class=" flex justify-around gap-4">
                                        <div class="pl-3">
                                            <h3 class="text-[#323C47] font-bold">{{ $item['estimate']->project_name }}</h3>
                                            <p class="font-medium text-sm text-[#858585]">
                                                {{ $item['estimate']->customer_address }}
                                            </p>
                                        </div>
                                        <div class=" border-l-2"></div>
                                        <div class="pl-3">
                                            <h3 class="text-[#323C47] font-bold">Images</h3>
                                            <p class="font-medium text-sm text-[#858585]">{{ count($item['images']) }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class=" p-3 px-4">
                                    <button class="p-2 rounded-md font-medium bg-[#930027] text-white" id="copyLink-btn{{$item['estimate']->estimate_id}}">
                                        <div class="text">
                                            Copy Link
                                        </div>
                                    </button>
                                </div>
                                <script>
                                    document.getElementById("copyLink-btn{{$item['estimate']->estimate_id}}").addEventListener('click', function() {
                                        const baseUrl = window.location.origin;
                                        const link = `${baseUrl}/viewImages/{{$item['estimate']->estimate_id}}`;
                                        navigator.clipboard.writeText(link).then(() => {
                                            alert('Link copied to clipboard!');
                                        }).catch(err => {
                                            console.error('Failed to copy link: ', err);
                                        });
                                    });
                                </script>
                                {{-- <div class="col-span-1 p-3">
                                    <div class="h-full mx-auto rounded bg-[#D9D9D9] w-[5px]"></div>
                                </div> --}}
                                {{-- <div class="col-span-5 grid grid-cols-5 gap-3 mx-2 my-auto">
                                    @foreach ($item['images']->take(5) as $image)
                                    <div class="col-span-1 py-2">
                                        <img src="{{ asset('storage/' . $image->estimate_image) }}" style="object-fit: cover" class=" rounded-md w-full h-20" alt="Estimate Image">
                                    </div>
                                    @endforeach
                                </div> --}}
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
