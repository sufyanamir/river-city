@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-2 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Notifications</h4>
            </div>
            <div class="flex justify-between gap-3">
                <form action="/clearNotifications" method="post">
                    @csrf
                    <button id="" class="bg-white text-black  p-2 rounded-md font-medium mb-2">
                        Clear All
                    </button>
                </form>
                <form action="/markNotifications" method="post">
                    @csrf
                    <button id="" class="bg-white text-black  p-2 rounded-md font-medium mb-2">
                        Mark as Read
                    </button>
                </form>
            </div>
        </div>
        <div class="py-2">
            @if(count($notifications) > 0 || count($mentions) > 0)
            @foreach ($mentions as $notification)
            <div class=" bg-[#F5F5F5] rounded-lg p-3 m-2 relative">
                @if ($notification->notification_status == 'unread')
                <span class="absolute top-1 left-1 inline-flex items-center justify-center w-2 h-2 mr-2 text-sm font-semibold text-[#04BB16] bg-[#04BB16] rounded-full">
                    @endif
                </span>
                <div class=" flex justify-between gap-2 py-4">
                    @if($notification->notification_type == 'mention')
                    <a href="/estimates/getChatMessage/{{$notification->estimate_id}}" class=" hover:border-b border-[#930027]">
                        <p class=" text-[#930027]">{{ $notification->notification_message }}</p>
                    </a>
                    @elseif($notification->notification_type == 'mentionGallery')
                    <a href="/viewGallery{{$notification->estimate_id}}" class=" hover:border-b border-[#930027]">
                        <p class=" text-[#930027]">{{ $notification->notification_message }}</p>
                    </a>
                    @endif
                    <div class=" flex gap-2">
                        <a href="/markNotification/{{$notification->notification_id}}" class=" text-xs hover:underline hover:text-[#930027] text-[#930027]">
                            Mark as Read
                        </a>
                        <p class=" text-xs">{{ date('d, F Y', strtotime($notification->created_at)) }}</p>
                    </div>
                </div>
                <span class="absolute top-1 right-1">
                    <a href="/deleteNotification/{{$notification->notification_id}}">
                        <img src="{{ asset('assets/icons/bin-icon.svg') }}" alt="delete">
                    </a>
                </span>
            </div>
            @endforeach
            @foreach ($notifications as $notification)
            <div class=" bg-[#F5F5F5] rounded-lg p-3 m-2 relative">
                @if ($notification->notification_status == 'unread')
                <span class="absolute top-1 left-1 inline-flex items-center justify-center w-2 h-2 mr-2 text-sm font-semibold text-[#04BB16] bg-[#04BB16] rounded-full">
                    @endif
                </span>
                <div class=" flex justify-between gap-2 py-4">
                    <p>{{ $notification->notification_message }}</p>
                    <div class=" flex gap-2">
                        <a href="/markNotification/{{$notification->notification_id}}" class=" text-xs hover:underline hover:text-[#930027] text-[#930027]">
                            Mark as Read
                        </a>
                        <p class=" text-xs">{{ date('d, F Y', strtotime($notification->created_at)) }}</p>
                    </div>
                </div>
                <span class="absolute top-1 right-1 flex">
                    <a href="/deleteNotification/{{$notification->notification_id}}" class="bg-white rounded-full p-1">
                        <img src="{{ asset('assets/icons/bin-icon.svg') }}" alt="delete">
                    </a>
                </span>
            </div>
            @endforeach
            @else
            <div class=" bg-[#F5F5F5] rounded-lg p-3 m-2 relative">
                <div class=" text-center">
                    <p>No notifications right now!</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')