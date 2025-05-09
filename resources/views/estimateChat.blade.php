@include('layouts.header')
<style>
    /* Add your CSS styling here */
#userDropdown {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    z-index: 1;
}

#userDropdown button {
    width: 100%;
    padding: 8px;
    text-align: left;
    border: none;
    background-color: white;
    border-radius: 4px;
}
#userDropdown button:hover{
    background-color: #f5f5f5;
}
</style>
<div class="bg-white rounded-lg mt-2">
    <div class=" flex justify-between bg-[#930027] p-3 rounded-t-lg">
        <h2 class=" text-xl font-semibold mb-2 text-white " id="modal-title">Project Chat</h2>
    </div>
    <!-- Modal content here -->
    <div class="col-span-10  pl-2 ">
        <div class="grid sm:grid-cols-10">
            <div class="col-span-8 p-3">
                <p class="text-[#F5222D] text-xl font-bold">
                    {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                </p>
                <p class="text-[#323C47] text-lg font-semibold">
                    {{ $customer->customer_project_name }}
                </p>
                <p class="mt-2 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                    <span class="pl-2">{{ $customer->customer_primary_address }}</span>
                </p>
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                    <span class="pl-2">Project Owner: {{ $customer->owner }}
                    </span>
                </p>
                <hr class="bg-gray-300 my-2 w-full">
                <p class="mt-1 flex text-[#323C47] font-medium">
                    <img src="{{ asset('assets/icons/page-icon.svg') }}" alt="">
                    <span class="pl-2">Estimate Pending Schedule
                    </span>
                </p>
                {{-- <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/person-icon.svg') }}" alt="">
                <span class="pl-2 flex">{{ $customer->owner }} Assigned To Schedule Estimate On <span class="pl-2 text-[#31A613] flex">
                        <img class="pr-1" src="{{ asset('assets/icons/green-calendar.svg') }}" alt="">
                        {{ date('d, F Y', strtotime($customer->created_at)) }}</span>
                </span>
                </p> --}}
            </div>
            <div class=" col-span-2 p-3 text-right">
                <p class="text-lg font-bold text-[#323C47]">
                    Estimate
                    <br>
                    <span>{{ $estimate->project_name }}</span>
                </p>
                <p class="mt-[2px] text-[#323C47]">
                    {{ $estimate->project_number }}
                </p>
                <p class="text-[#323C47]">
                    {{ $estimate->estimate_status }}
                </p>
                <p class="text-[#323C47]">
                    {{ date('d, F Y', strtotime($estimate->created_at)) }}
                </p>
            </div>
        </div>
    </div>
    <div class=" pb-2">
        <div class=" border rounded-lg h-72 w-full overflow-auto">
            <div class=" m-2" id="chat-dialog">
                <div class="pb-2">
                    <!-- Chat messages will be dynamically inserted here -->
                    @foreach($chatMessages as $message)
                    <div class="mx-2 my-3">
                            <div>
                                <div class="flex justify-start gap-1 mb-2">
                                    <img class="w-7 h-7 rounded-full" style="object-fit: cover;" src="{{ (isset($message->addedUser->user_image) && asset_exists($message->addedUser->user_image)) ? asset($message->addedUser->user_image) : asset('assets/images/demo-user.svg') }}" alt="image">
                                    <h6 class="font-medium text-red-500">{{ $message->added_user_name }}: </h6>
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
                                <span class="text-xs mx-2">{{ date('m/d/y', strtotime($message->created_at)) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="pb-2">
        <form method="POST" action="/sendChat" id="chat-form">
            @csrf
            <input type="hidden" name="estimate_id" id="estimate_id" value="{{$estimate->estimate_id}}">
            <label for="chat" class="sr-only">Your message</label>
            <div class="relative flex items-center px-3 py-2 rounded-lg bg-gray-50">
                <textarea id="message" name="chat_message" rows="1" class="message block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                <div id="userDropdown" class="userDropdown"></div>
                <button type="button" id="recordButton" class="inline-flex justify-center p-2 text-red-600 rounded-full cursor-pointer hover:bg-red-100 text-lg">
                    🎤
                </button>
                <button type="submit" id="chatSubmit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100" disabled>
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
            <input type="hidden" name="mentioned_user_ids[]" id="mentioned_user_ids">
            <input type="hidden" name="audio_data" id="audio_data">
        </form>
        <audio id="audioPlayback" class="mx-2 my-1" controls style="display:none;"></audio>
    </div>
</div>
@include('layouts.footer')
<script>
// Corrected JavaScript code
// Get the users data with proper structure
const users = {!! json_encode($users->map(function($user) {
    return [
        'id' => $user->id,
        'name' => $user->name,
        'user_role' => $user->user_role
    ];
})) !!};

// Function to scroll to the bottom of the chat
function scrollToBottom() {
    const chatDialog = document.getElementById('chat-dialog');
    const chatContainer = chatDialog.closest('.overflow-auto');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
}

// Scroll to bottom when page loads
$(document).ready(function() {
    scrollToBottom();
});

// Get the textarea, user dropdown, and hidden input elements
const messageTextarea = $("#message");
const userDropdown = $("#userDropdown");
const userIdInput = $("#mentioned_user_ids");

// Track mentioned user ids
let mentionedUserIds = [];

// Event listener for typing '@' in the textarea
messageTextarea.on("input", function(event) {
    const text = event.target.value;
    const lastIndex = text.lastIndexOf("@");

    if (lastIndex !== -1) {
        const query = text.substring(lastIndex + 1);
        const matchingUsers = users.filter(user => 
            user.name.toLowerCase().includes(query.toLowerCase())
        );

        // Display matching users in the dropdown
        renderDropdown(matchingUsers);
    } else {
        // Hide the dropdown if '@' is not present
        userDropdown.hide();
    }
});

// Function to render the user dropdown
function renderDropdown(users) {
    if (users.length > 0) {
        const dropdownContent = users.map(user => `
            <button type="button" onclick="mentionUser('${user.name}', '${user.id}', '${user.user_role}')">${user.name} (${user.user_role})</button>
        `).join("");

        userDropdown.html(dropdownContent).show();
    } else {
        userDropdown.hide();
    }
}

// Function to handle user selection from the dropdown
function mentionUser(userName, userId, userRole) {
    const currentText = messageTextarea.val();
    const lastIndex = currentText.lastIndexOf("@");
    const newText = currentText.substring(0, lastIndex) + `@${userName} (${userRole}) `;

    messageTextarea.val(newText);

    // Add the mentioned user's id to the array
    mentionedUserIds.push(userId);
    
    // Set the array of mentioned user ids in the hidden input
    userIdInput.val(mentionedUserIds);
    
    userDropdown.hide();
}

// Close the dropdown when clicking outside of it
$(document).on("click", function(event) {
    if (!$(event.target).closest("#userDropdown").length && !$(event.target).is("#message")) {
        userDropdown.hide();
    }
});

// Enable submit button when message has content
messageTextarea.on("input", function() {
    $("#chatSubmit").prop("disabled", !$(this).val().trim());
});

</script>
<script>
    let chatRecorder, imageRecorder, chatAudioChunks, imageAudioChunks;

    // Get DOM elements
    const chatTextarea = document.getElementById('message');
    const chatSubmit = document.getElementById('chatSubmit');
    const chatAudioData = document.getElementById('audio_data');
    
    const imageTextarea = document.getElementById('imageMessage');
    const imageSubmit = document.getElementById('imageSubmit');
    const imageAudioData = document.getElementById('image_audio_data');

    // Function to update submit button state
    function updateChatSubmitState() {
        chatSubmit.disabled = !((chatTextarea.value.trim().length > 0) || (chatAudioData.value.length > 0));
    }

    function updateImageSubmitState() {
        imageSubmit.disabled = !((imageTextarea.value.trim().length > 0) || (imageAudioData.value.length > 0));
    }

    // Chat Form Event Listeners
    chatTextarea.addEventListener('input', updateChatSubmitState);
    
    document.getElementById('recordButton').addEventListener('click', async function() {
        if (!chatRecorder || chatRecorder.state === "inactive") {
            startChatRecording();
        } else {
            stopChatRecording();
        }
    });

    // Image Form Event Listeners
    imageTextarea.addEventListener('input', updateImageSubmitState);
    
    document.getElementById('imageRecordButton').addEventListener('click', async function() {
        if (!imageRecorder || imageRecorder.state === "inactive") {
            startImageRecording();
        } else {
            stopImageRecording();
        }
    });

    // Chat Recording Functions
    async function startChatRecording() {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        chatRecorder = new MediaRecorder(stream);
        chatAudioChunks = [];

        chatRecorder.ondataavailable = event => {
            chatAudioChunks.push(event.data);
        };

        chatRecorder.onstop = async () => {
            const audioBlob = new Blob(chatAudioChunks, { type: 'audio/wav' });
            const reader = new FileReader();
            reader.readAsDataURL(audioBlob);
            reader.onloadend = () => {
                chatAudioData.value = reader.result;
                document.getElementById('audioPlayback').src = reader.result;
                document.getElementById('audioPlayback').style.display = "block";
                updateChatSubmitState(); // Update button state after recording
            };
        };

        chatRecorder.start();
        document.getElementById('recordButton').textContent = "⏹️";
    }

    function stopChatRecording() {
        chatRecorder.stop();
        document.getElementById('recordButton').textContent = "🎤";
    }

    // Image Recording Functions
    async function startImageRecording() {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        imageRecorder = new MediaRecorder(stream);
        imageAudioChunks = [];

        imageRecorder.ondataavailable = event => {
            imageAudioChunks.push(event.data);
        };

        imageRecorder.onstop = async () => {
            const audioBlob = new Blob(imageAudioChunks, { type: 'audio/wav' });
            const reader = new FileReader();
            reader.readAsDataURL(audioBlob);
            reader.onloadend = () => {
                imageAudioData.value = reader.result;
                document.getElementById('imageAudioPlayback').src = reader.result;
                document.getElementById('imageAudioPlayback').style.display = "block";
                updateImageSubmitState(); // Update button state after recording
            };
        };

        imageRecorder.start();
        document.getElementById('imageRecordButton').textContent = "⏹️";
    }

    function stopImageRecording() {
        imageRecorder.stop();
        document.getElementById('imageRecordButton').textContent = "🎤";
    }

    // Initial state check
    updateChatSubmitState();
    updateImageSubmitState();
</script>