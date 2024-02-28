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
        <div class=" border rounded-lg h-40 w-full overflow-auto">
            <div class=" m-2" id="chat-dialog">
                <div class="pb-2">
                    <!-- Chat messages will be dynamically inserted here -->
                    @foreach($chatMessages as $message)
                    <div class="m-2">
                        <div>
                            <div class="text-right">
                                <span class="text-sm">{{ date('d, F Y', strtotime($message->created_at)) }}</span>
                            </div>
                            <div class="flex justify-start gap-2">
                                <h6 class="font-medium text-red-500">{{ $message->added_user_name }}: </h6>
                                <p>{{ $message->chat_message }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class=" pb-2">
        <form method="POST" action="/sendChat" id="chat-form">
            @csrf
            <input type="hidden" name="estimate_id" id="estimate_id" value="{{$estimate->estimate_id}}">
            <label for="chat" class="sr-only">Your
                message</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                <textarea id="message" name="chat_message" rows="1" class="message block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                <div id="userDropdown" class="userDropdown"></div>
                <button class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send
                        message</span>
                </button>
            </div>
            <input type="hidden" name="mentioned_user_ids[]" id="mentioned_user_ids">
        </form>
    </div>
</div>
@include('layouts.footer')
<script>
    // Your existing JavaScript code
        // Your list of users with names and ids
const users = {!! json_encode($users->pluck('name', 'id')) !!};

// Get the textarea, user dropdown, and hidden input elements
const messageTextarea = $("#message");
const userDropdown = $("#userDropdown");
const userIdInput = $("#mentioned_user_ids");

// Append the hidden input to the form
// $("#chat-form").append(userIdInput);

// Track mentioned user ids
let mentionedUserIds = [];

// Event listener for typing '@' in the textarea
messageTextarea.on("input", function(event) {
    const text = event.target.value;
    const lastIndex = text.lastIndexOf("@");

    if (lastIndex !== -1) {
        const query = text.substring(lastIndex + 1);
        const matchingUsers = Object.entries(users)
            .filter(([id, name]) =>
                name.toLowerCase().includes(query.toLowerCase())
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
        const dropdownContent = users.map(([id, name]) => `
            <button type="button" onclick="mentionUser('${name}', '${id}')">${name}</button>
        `).join("");

        userDropdown.html(dropdownContent).show();
    } else {
        userDropdown.hide();
    }
}

// Function to handle user selection from the dropdown
function mentionUser(userName, userId) {
    const currentText = messageTextarea.val();
    const lastIndex = currentText.lastIndexOf("@");
    const newText = currentText.substring(0, lastIndex) + `@${userName} `;

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

</script>