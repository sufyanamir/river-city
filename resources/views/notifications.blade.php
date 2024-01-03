@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Notifications</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="p-3">
            <div class=" border-b-2">
                <h4 class=" text-lg font-semibold">Notificaitons</h4>
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