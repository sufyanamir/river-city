@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-2 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Notifications</h4>
            </div>
            <form action="/markNotifications" method="post">
                @csrf
                <button id="" class="bg-white text-black  p-2 rounded-md font-medium mb-2">
                    Mark as Read
                </button>
            </form>
        </div>
        <div class=" p-2 m-3">
            <div class=" p-2 bg-[#930027] text-white rounded-t-2xl">
                <div class=" text-xl font-semibold">
                    <h4>Mentions</h4>
                </div>
            </div>
            @foreach ($mentions as $notification)
            <div class=" bg-[#F5F5F5] rounded-lg p-3 m-2 relative">
                @if ($notification->notification_status == 'unread')
                <span class="absolute top-1 left-1 inline-flex items-center justify-center w-2 h-2 mr-2 text-sm font-semibold text-[#04BB16] bg-[#04BB16] rounded-full">
                    @endif
                </span>
                <div>
                    <p>{{ $notification->notification_message }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @foreach ($notifications as $notification)
        <div class=" bg-[#F5F5F5] rounded-lg p-3 m-2 relative">
            @if ($notification->notification_status == 'unread')
            <span class="absolute top-1 left-1 inline-flex items-center justify-center w-2 h-2 mr-2 text-sm font-semibold text-[#04BB16] bg-[#04BB16] rounded-full">
                @endif
            </span>
            <div>
                <p>{{ $notification->notification_message }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@include('layouts.footer')