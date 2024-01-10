@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Estimate Activity</h4>
            </div>
            {{-- <form action="/markNotifications" method="post">
                @csrf
                <button id="" class="bg-white text-black  p-2 rounded-md font-medium mb-2">
                    Mark as Read
                </button>
            </form> --}}
        </div>
        @foreach ($activities as $activity)
            <div class=" py-1">
                <div class="bg-[#F5F5F5] rounded-lg p-3 m-2">
                    <h1 class=" font-semibold text-lg">{{ $activity->activity_title }}:</h1>
                    <p>{{ $activity->activity_description }}</p>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>
</div>
@include('layouts.footer')
