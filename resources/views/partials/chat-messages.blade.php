<div class="m-2" id="chat-dialog">
    <div class="pb-2">
        <!-- Chat messages will be dynamically inserted here -->
        @foreach($chatMessages as $message)
        <div class="mx-2 my-3">
            <div>
                <div class="flex justify-between gap-1 mb-2">
                    <div class=" flex justify-start gap-1">
                        <img class="w-7 h-7 rounded-full" style="object-fit: cover;" src="{{ (isset($message->addedUser->user_image) && asset_exists($message->addedUser->user_image)) ? asset($message->addedUser->user_image) : asset('assets/images/demo-user.svg') }}" alt="image">
                        <h6 class="font-medium text-red-500">{{ $message->added_user_name }}: </h6>
                    </div>
                    <span class="text-xs mx-2 my-auto">{{ date('m/d/y', strtotime($message->created_at)) }}</span>
                </div>
                <div class="">
                    @if($message->chat_message && Str::startsWith($message->chat_message, 'voice_messages/') && Str::endsWith($message->chat_message, '.wav'))
                    <audio controls class="max-w-[300px]">
                        <source src="{{ Storage::url($message->chat_message) }}" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                    @else
                    <div class=" bg-gray-100 rounded-lg w-full p-2">
                        <p>{{ $message->chat_message }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>