@foreach($chatMessages as $message)
    <div class="m-2">
        <div>
            <div class="text-right">
                <span class="text-sm">{{ $message->created_at->format('m/d/Y, H:i:s') }}</span>
            </div>
            <div class="flex justify-start gap-2">
                <h6 class="font-medium text-red-500">{{ $message->added_user_id }}: </h6>
                <p>{{ $message->chat_message }}</p>
            </div>
        </div>
    </div>
@endforeach