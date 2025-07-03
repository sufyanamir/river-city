@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
 use Illuminate\Support\Str;
@endphp
<div class=" my-4">
    <div class=" grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3">
        <div class=" col-span-2 bg-white w-full overflow-auto rounded-lg shadow-lg">
            <div class=" p-3 bg-[#930027] rounded-t-lg text-white">
                <h1 class=" text-2xl font-semibold">Estimates</h1>
            </div>
            <div class="grid sm:grid-cols-11 p-4">
                {{-- <div class="col-span-1  flex justify-end p-3 pr-0">
                    <button type="button" class="flex">
                        <img class="h-[50px] w-[50px] " src="{{ asset('assets/icons/edit-estimate-icon.svg') }}" alt="">
                </button>
            </div> --}}
            <div class="col-span-10  pl-3 ">
                <div class="flex justify-between">
                    <div>
                        <p class="text-[#F5222D] text-[25px]/[29.3px] font-bold">
                            {{ ucfirst($estimate->customer_name) }} {{ ucfirst($estimate->customer_last_name) }}
                        </p>
                        <p class="text-[#323C47] text-[20px]/[23.44px] font-semibold">
                            {{ $estimate->project_name }}
                        </p>
                    </div>
                    <div>
                        <p class="mt-4 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/home-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $estimate->customer_address }}</span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/mail-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $customer->customer_email }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47]font-medium">
                            <img src="{{ asset('assets/icons/tel-icon.svg') }}" alt="">
                            <span class="pl-2">{{ $estimate->customer_phone }}
                            </span>
                        </p>
                        <p class="mt-1 flex text-[#323C47] font-medium">
                            <img src="{{ asset('assets/icons/stat-icon.svg') }}" alt="">
                            <span class="pl-2">Project Owner: {{ $customer->owner }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 my-3 h-[2px] w-full">
        <div id="universalTableBody">
            <div class=" grid sm:grid-cols-11 pb-4 px-4">
                <div class="col-span-1"></div>
                <div class="col-span-10 px-3  flex justify-between">
                    <p class="text-[22px]/[25.78px] font-medium">Images <span>{{ count($estimate_images) }}</span></p>
                    <div>
                    <button class="p-2 rounded-md font-medium bg-[#930027] text-white" id="copyLink-btn">
                        <div class="text">
                            Copy Link
                        </div>
                    </button>
                    <script>
                        document.getElementById('copyLink-btn').addEventListener('click', function() {
                            const baseUrl = window.location.origin;
                            const link = `${baseUrl}/viewImages/{{$estimate->estimate_id}}`;
                            navigator.clipboard.writeText(link).then(() => {
                                alert('Link copied to clipboard!');
                            }).catch(err => {
                                console.error('Failed to copy link: ', err);
                            });
                        });
                    </script>
                    @if (session('user_details')['user_role'] == 'admin')
                    <button class="p-2 rounded-md font-medium bg-[#930027] text-white" id="addImage-btn">
                        <div class=" text-center hidden spinner" id="spinner">
                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text" id="text">
                            Add Image
                        </div>
                    </button>
                    @elseif(isset($userPrivileges->gallery) && isset($userPrivileges->gallery->add) && $userPrivileges->gallery->add === 'on')
                    <button class="p-2 rounded-md font-medium bg-[#930027] text-white" id="addImage-btn">
                        <div class=" text-center hidden spinner" id="spinner">
                            <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text" id="text">
                            Add Image
                        </div>
                    </button>
                    @endif
                    </div>
                </div>
            </div>
            <hr class="bg-gray-300 h-[2px] w-full">
            <div class="grid sm:grid-cols-12 p-4">
                <div class="col-span-1"></div>
                <div class="col-span-10 p-3 grid grid-cols-6">
                    @foreach ($estimate_images as $image)
                    <div class="col-span-1 p-2 relative hover:scale-105 duration-300">
                        <!-- <a href="{{ asset('storage/' . $image->estimate_image) }}"> -->
                        <button id="image-btn{{$image->estimate_image_id}}" class="">
                @php
    $imagePath = $image->estimate_image ?? '';
    $isCloudinary = Str::startsWith($imagePath, 'http');

    // If Cloudinary, apply optimizations
    $imageSrc = $isCloudinary
        ? str_replace('/upload/', '/upload/w_800,h_600,c_limit,q_auto,f_auto/', $imagePath)
        : asset('storage/' . $imagePath);
@endphp

@if ($imagePath)
    <img class="rounded-xl"
         style="width: 100%; height: 100px; object-fit: cover;"
         src="{{ $imageSrc }}"
         alt="Uploaded Image">
@else
    <p class="text-red-500 text-sm">No image uploaded.</p>
@endif



                        </button>
                        <!-- </a> -->
                        @if (session('user_details')['user_role'] == 'admin')
                        <form action="/deleteEstimateImage{{ $image->estimate_image_id }}" method="post">
                            @csrf
                            <button class="cursor-pointer absolute top-4 right-4">
                                <img class="" src="{{ asset('assets/icons/img-del-icon.svg') }}" alt="">
                            </button>
                        </form>
                        @elseif(isset($userPrivileges->gallery) &&
                        isset($userPrivileges->gallery->delete) &&
                        $userPrivileges->gallery->delete === 'on')
                        <form action="/deleteEstimateImage{{ $image->estimate_image_id }}" method="post">
                            @csrf
                            <button class="cursor-pointer absolute top-4 right-4">
                                <img class="" src="{{ asset('assets/icons/img-del-icon.svg') }}" alt="">
                            </button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="bg-gray-300 h-[2px] w-full">
        <div class="p-3 px-6">
            <x-add-button :title="'Back'" :class="' px-7 bg-black-100 border-2 text-[#000]'" :id="'back-btn'" />
        </div>
    </div>
    <div class=" col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1 w-full overflow-auto ">
        <div class=" p-3 bg-[#930027] rounded-t-lg text-white">
            <h1 class=" text-2xl font-semibold">Project Chat</h1>
        </div>
        <div class="pb-2">
            <div class="border rounded-lg w-full h-[480px] bg-white overflow-auto">
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
            </div>
        </div>
        <!-- First Form (Chat Form) -->
        <div class="pb-2">
            <form method="POST" action="/sendChat" id="chat-form">
                @csrf
                <input type="hidden" name="estimate_id" id="estimate_id" value="{{$estimate->estimate_id}}">
                <label for="chat" class="sr-only">Your message</label>
                <div class="relative flex items-center px-3 py-2 rounded-lg bg-gray-50">
                    <textarea id="message" name="chat_message" rows="2" class="message block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                    <div id="userDropdown" class="userDropdown"></div>
                    <button type="button" id="recordButton" class="inline-flex justify-center p-2 text-red-600 rounded-full cursor-pointer hover:bg-red-100 text-2xl">
                        🎤
                    </button>
                    <button type="submit" id="chatSubmit" class="text-2xl inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100" disabled>
                        <svg class="w-6 h-6 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
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
</div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addImage-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" flex justify-between border-b">
                    <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Images</h2>
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <!-- task details -->
                <div class="  py-2">
                    <form action="/addEstimateImage" style="width: 100%; height: 200%;" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="estimate_id" value="{{$estimate->estimate_id}}">
                        <div class="fallback">
                            <input name="file[]" type="file" multiple />
                        </div>
                    </form>
                </div>
                <div class=" border-t">
                    <button id="reloadButton" class=" my-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 " disabled>Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="image-btn-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
       <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-lg h-[90vh]">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 h-[80vh]">
        <div class="flex justify-between border-b">
            <h2 class="text-xl font-semibold mb-2" id="modal-title">Image Details</h2>
            <button class="image-btn-close" type="button">
                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
            </button>
        </div>

        <div class="mt-2 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 h-[77vh]">
            <div class="flex justify-between w-full">
                <!-- Image container with canvas overlay -->
                <div class="relative w-[100%]">
                    <img class="object-contain w-full h-[77vh] rounded-l-lg border-r-2 border-[#e5e7eb] pr-1" id="imageView" crossorigin="anonymous" src="" alt="">
                    <canvas id="imageCanvas" class="absolute top-0 left-0 w-full h-[77vh] pointer-events-none"></canvas>

                    <!-- Edit menu button -->
                    {{-- <button id="editMenuButton" class="absolute top-5 left-5 p-1 bg-white rounded-full shadow-md hover:bg-gray-100">
                        <img src="{{asset('assets/icons/ellipsis-vertical.svg')}}" class="w-6 h-6" alt="Edit options">
                    </button> --}}

                    <!-- Edit options dropdown -->
                    <div id="editOptions" class="absolute top-4 left-2 bg-white rounded-md shadow-lg py-1 z-10 w-40">
                       <button id="enableDrawing" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                    <img src="{{asset('assets/icons/pencil.png')}}" alt="" class="w-[18px]">
            <span id="enableDrawingText">Draw on Image</span>
            </button>

            <button id="clearDrawing" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hidden flex items-center gap-2">
            <img src="{{asset('assets/icons/block.png')}}" class="w-[18px]" alt="">
            Clear Drawing
            </button>

            <button id="saveDrawing" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hidden flex items-center gap-2">
                <div id="saveLoader" class="absolute inset-0 bg-white bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-[#930027]"></div>
</div>

            <img src="{{asset('assets/icons/diskette.png')}}" class="w-[18px]" alt="">
            Save Changes
            </button>

                    </div>
                </div>

                <!-- Chat section -->
                <div class="flex flex-col justify-between leading-normal w-[40%]">
                    <div class="h-[77vh] overflow-y-auto w-full">
                        <div id="chatDiv" class="w-full h-[396px] overflow-auto"></div>
                        <form method="POST" action="/addImageChat" enctype="multipart/form-data" id="image-chat-form">
                            @csrf
                            <input type="hidden" name="estimate_image_id" id="estimate_image_id" value="">
                            <div class="relative flex items-center px-3 py-2 rounded-lg bg-gray-50">
                                <textarea id="imageMessage" name="message" rows="1" class="message block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your message..."></textarea>
                                <div id="imageUserDropdown" class="userDropdown"></div>
                                <button type="button" id="imageRecordButton" class="inline-flex justify-center p-2 text-red-600 rounded-full cursor-pointer hover:bg-red-100 text-lg">
                                    🎤
                                </button>
                                <button type="submit" id="imageSubmit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100" disabled>
                                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                                    </svg>
                                </button>
                            </div>
                            <input type="hidden" name="mentioned_users[]" id="image_mentioned_user_ids">
                            <input type="hidden" name="audio_data" id="image_audio_data">
                        </form>
                    </div>
                    <audio id="imageAudioPlayback" class="mx-2 my-1" controls style="display:none;"></audio>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
@include('layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/recorderjs/0.1.0/recorder.min.js"></script>
<script>
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

    // Updated user data structure to include user_role
    const users = {!! json_encode($users->map(function($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'user_role' => $user->user_role
        ];
    })) !!};

    // Function to initialize mention functionality for a given form
    function initializeMentionFunctionality(textareaId, dropdownId, hiddenInputId) {
        const messageTextarea = $("#" + textareaId);
        const userDropdown = $("#" + dropdownId);
        const userIdInput = $("#" + hiddenInputId);

        messageTextarea.on("input", function(event) {
            const text = event.target.value;
            const lastIndex = text.lastIndexOf("@");

            if (lastIndex !== -1) {
                const query = text.substring(lastIndex + 1);
                const matchingUsers = users.filter(user =>
                    user.name.toLowerCase().includes(query.toLowerCase())
                );

                // Display matching users in the dropdown
                renderDropdown(matchingUsers, dropdownId, textareaId, hiddenInputId);
            } else {
                userDropdown.hide();
            }
        });

        // Function to render the user dropdown
        function renderDropdown(users, dropdownId, textareaId, hiddenInputId) {
            const dropdown = $("#" + dropdownId);
            if (users.length > 0) {
                const dropdownContent = users.map(user => `
                <button type="button" onclick="mentionUser('${user.name}', '${user.id}', '${user.user_role}', '${textareaId}', '${hiddenInputId}', '${dropdownId}')">${user.name} (${user.user_role})</button>
            `).join("");
                dropdown.html(dropdownContent).show();
            } else {
                dropdown.hide();
            }
        }

        // Close dropdown when clicking outside
        $(document).on("click", function(event) {
            if (!$(event.target).closest("#" + dropdownId).length && !$(event.target).is("#" + textareaId)) {
                userDropdown.hide();
            }
        });

        // Enable submit button when message has content (optional enhancement)
        messageTextarea.on("input", function() {
            const submitBtn = $(this).closest("form").find("button[type='submit']");
            submitBtn.prop("disabled", !$(this).val().trim());
        });
    }

    // Updated function to handle user selection from the dropdown
    function mentionUser(userName, userId, userRole, textareaId, hiddenInputId, dropdownId) {
        const messageTextarea = $("#" + textareaId);
        const userIdInput = $("#" + hiddenInputId);
        const dropdown = $("#" + dropdownId);

        const currentText = messageTextarea.val();
        const lastIndex = currentText.lastIndexOf("@");
        const newText = currentText.substring(0, lastIndex) + `@${userName} (${userRole}) `;

        messageTextarea.val(newText);

        // Add the mentioned user's ID
        let mentionedUserIds = userIdInput.val() ? userIdInput.val().split(",") : [];
        mentionedUserIds.push(userId);
        userIdInput.val(mentionedUserIds.join(","));

        dropdown.hide();
    }

    // Initialize mention functionality for both forms
    initializeMentionFunctionality("message", "userDropdown", "mentioned_user_ids"); // For first form
    initializeMentionFunctionality("imageMessage", "imageUserDropdown", "image_mentioned_user_ids"); // For second form
</script>
<script>
    $("#addImage-btn").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").removeClass('hidden');
    });
    $(".image-btn-close").click(function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent the event from bubbling up
        $('#estimate_image_id').val('');
        $("#image-btn-modal").addClass('hidden');
    });
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addImage-btn-modal").addClass('hidden');
        $("#addImage-btn-form")[0].reset();
    });
</script>
<script>
    $(document).ready(function() {
        $("#back-btn").on("click", function() {
            window.history.back();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('[id^="image-btn"]').click(function() {
            var itemId = this.id.replace('image-btn', ''); // Extract item ID from button ID

            // Function to generate a random color
            function getRandomColor() {
                const colors = ["#e57373", "#f06292", "#ba68c8", "#64b5f6", "#4db6ac", "#81c784", "#ffb74d", "#a1887f", "#90a4ae"];
                return colors[Math.floor(Math.random() * colors.length)];
            }

            // Make an AJAX request to get item details
            $.ajax({
                url: '/getImageDetails' + itemId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let imagePath = response.data.estimate_image;

                        // Determine if the path is Cloudinary (starts with "http")
                        let isCloudinary = imagePath.startsWith('http');

                        // If from storage, prepend with asset path
                        let fullPath = isCloudinary ? imagePath : '/storage/' + imagePath;

                         // ✅ Use your public modal open function:
                        openImageEditor(
                            response.data.estimate_image_id,
                            response.data.estimate_id,
                            fullPath
                        );

                        // $('#imageView').attr('src', fullPath); // Set image src
                        // $('#estimate_image_id').val(response.data.estimate_image_id);

                         currentImageId = response.data.estimate_image_id;
                         currentEstimateId = response.data.estimate_id;

                        // Populate the modal with the retrieved data
                        // $('#imageView').attr('src', '/storage/' + response.data.estimate_image);
                        // $('#estimate_image_id').val(response.data.estimate_image_id);
                        console.log(response.data);

                        // Clear previous chat messages
                        $('#chatDiv').empty();

                        // Populate chat messages
                        if (response.data.chat && response.data.chat.length > 0) {
                            response.data.chat.forEach(function(chat) {
                                let randomColor = getRandomColor();
                                let chatContent = '';

                                // Check if the message contains a .wav file path
                                if (chat.message.endsWith('.wav')) {
                                    chatContent = `<audio controls>
                                    <source src="/storage/${chat.message}" type="audio/wav">
                                    Your browser does not support the audio element.
                                </audio>`;
                                } else {
                                    chatContent = `<p>${chat.message}</p>`;
                                }

                                let chatBubble = `<div class="mx-2 mb-3 chat-bubble ${chat.user_id === 1 ? 'sent' : 'received'}">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <strong style="color: ${randomColor};">${chat.user_name}</strong>
                                    <span class="chat-timestamp" style="color: ${randomColor};">${new Date(chat.created_at).toLocaleString()}</span>
                                </div>
                                ${chatContent}
                            </div>`;

                                $('#chatDiv').append(chatBubble);
                            });
                        } else {
                            $('#chatDiv').append('<p class="text-gray-500 text-center flex items-center justify-center h-full">No messages yet.</p>');
                        }

                        // Open the modal
                        $('#image-btn-modal').removeClass('hidden');

                        // Scroll the chat div to the bottom
                        const chatDiv = document.getElementById('chatDiv');
                        if (chatDiv) {
                            chatDiv.scrollTop = chatDiv.scrollHeight;
                        }
                    } else {
                        console.error('Error fetching item details.');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });

        $("[data-fancybox]").fancybox({
            loop: true,
            buttons: ["slideShow", "fullScreen", "thumbs", "close"],
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Add click event listener to the button
        $('#reloadButton').click(function() {
            // Reload the page
            location.reload();
        });
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

    // Add event listener for form submission
    document.getElementById('chat-form').addEventListener('submit', function() {
        // Set a timeout to call scrollToBottom after the message is sent
        setTimeout(function() {
            scrollToBottom();
        }, 500);
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
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: true
        });
        chatRecorder = new MediaRecorder(stream);
        chatAudioChunks = [];

        chatRecorder.ondataavailable = event => {
            chatAudioChunks.push(event.data);
        };

        chatRecorder.onstop = async () => {
            const audioBlob = new Blob(chatAudioChunks, {
                type: 'audio/wav'
            });
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
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: true
        });
        imageRecorder = new MediaRecorder(stream);
        imageAudioChunks = [];

        imageRecorder.ondataavailable = event => {
            imageAudioChunks.push(event.data);
        };

        imageRecorder.onstop = async () => {
            const audioBlob = new Blob(imageAudioChunks, {
                type: 'audio/wav'
            });
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

    // Add event listener for image chat form submission
    document.getElementById('image-chat-form').addEventListener('submit', function() {
        // Set a timeout to scroll the image chat to bottom after message is sent
        setTimeout(function() {
            const chatDiv = document.getElementById('chatDiv');
            if (chatDiv) {
                chatDiv.scrollTop = chatDiv.scrollHeight;
            }
        }, 500);
    });

    // Initial state check
    updateChatSubmitState();
    updateImageSubmitState();
</script>

{{-- for image upload save button disable --}}
<script>
    Dropzone.autoDiscover = false;

    let myDropzone = new Dropzone("#my-awesome-dropzone", {
        paramName: "file", // name used in form
        maxFilesize: 1000, // MB
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: true,

        init: function () {
            const saveButton = document.getElementById('reloadButton');

            // Disable button while uploading
            this.on("processing", function () {
                saveButton.disabled = true;
                saveButton.classList.add('opacity-50', 'cursor-not-allowed');
            });

            // Enable after all files uploaded
            this.on("queuecomplete", function () {
                saveButton.disabled = false;
                saveButton.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const imageView = document.getElementById('imageView');
    const canvas = document.getElementById('imageCanvas');
    const ctx = canvas.getContext('2d');
    const enableDrawingBtn = document.getElementById('enableDrawing');
    const enableDrawingText = document.getElementById('enableDrawingText');
    const clearDrawingBtn = document.getElementById('clearDrawing');
    const saveDrawingBtn = document.getElementById('saveDrawing');
    const closeButton = document.querySelector('.image-btn-close');

    // State
    let isDrawing = false;
    let isDrawingMode = false;
    let lastX = 0;
    let lastY = 0;
    let currentImageId = null;
    let currentEstimateId = null;

    // Initialize canvas
    function initCanvas() {
        resizeCanvas();
        ctx.strokeStyle = '#FF0000';
        ctx.lineWidth = 5;
        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';
    }

    function resizeCanvas() {
        if (imageView.complete && imageView.naturalWidth !== 0) {
            canvas.width = imageView.clientWidth;
            canvas.height = imageView.clientHeight;
        }
    }

    // Drawing functions
    function startDrawing(e) {
        if (!isDrawingMode) return;
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function draw(e) {
        if (!isDrawing) return;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function stopDrawing() {
        isDrawing = false;
    }

    async function saveEditedImage() {
        if (!currentImageId || !currentEstimateId) {
            alert('No image selected');
            return;
        }

        const TARGET_WIDTH = 900;
        const TARGET_HEIGHT = 700;

        // Create a new export canvas at your desired Cloudinary target size
        const exportCanvas = document.createElement('canvas');
        exportCanvas.width = TARGET_WIDTH;
        exportCanvas.height = TARGET_HEIGHT;
        const exportCtx = exportCanvas.getContext('2d');

        // Scale original image to target
        exportCtx.drawImage(imageView, 0, 0, TARGET_WIDTH, TARGET_HEIGHT);

        // Scale drawing overlay to target
        exportCtx.drawImage(canvas, 0, 0, TARGET_WIDTH, TARGET_HEIGHT);

        // Get data URL
        const imageDataUrl = exportCanvas.toDataURL('image/png');

        document.getElementById('saveLoader').classList.remove('hidden');
        try {
            const response = await fetch('/save-edited-image', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    estimate_id: currentEstimateId,
                    image_id: currentImageId,
                    edited_image: imageDataUrl,
                    original_url: imageView.src
                })
            });

            const data = await response.json();

            if (data.success) {
                imageView.src = data.new_url + '?' + Date.now();
                resetDrawingMode();
                Swal.fire('Success!', "Changes saved successfully!", 'success');
                location.reload();
            } else {
                throw new Error(data.message || 'Failed to save image');
            }
        } catch (error) {
            console.error('Save error:', error);
            alert('Error saving image: ' + error.message);
        } finally {
            document.getElementById('saveLoader').classList.add('hidden');
        }
    }

    function resetDrawingMode() {
        isDrawingMode = false;
        isDrawing = false;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        canvas.style.pointerEvents = 'none';

        enableDrawingText.textContent = 'Draw on Image';
        clearDrawingBtn.classList.add('hidden');
        saveDrawingBtn.classList.add('hidden');
    }

    // Event Listeners
    imageView.addEventListener('load', () => {
        resizeCanvas();
        initCanvas();
    });

    window.addEventListener('resize', resizeCanvas);

    enableDrawingBtn.addEventListener('click', () => {
        isDrawingMode = !isDrawingMode;
        canvas.style.pointerEvents = isDrawingMode ? 'auto' : 'none';

        clearDrawingBtn.classList.toggle('hidden', !isDrawingMode);
        saveDrawingBtn.classList.toggle('hidden', !isDrawingMode);

        enableDrawingText.textContent = isDrawingMode ? 'Disable Drawing' : 'Draw on Image';

        if (!isDrawingMode) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    });

    clearDrawingBtn.addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    saveDrawingBtn.addEventListener('click', saveEditedImage);

    // Drawing events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    // Touch support
    canvas.addEventListener('touchstart', (e) => {
        if (!isDrawingMode) return;
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        startDrawing({
            offsetX: touch.clientX - rect.left,
            offsetY: touch.clientY - rect.top
        });
    });

    canvas.addEventListener('touchmove', (e) => {
        if (!isDrawingMode) return;
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        draw({
            offsetX: touch.clientX - rect.left,
            offsetY: touch.clientY - rect.top
        });
    });

    canvas.addEventListener('touchend', stopDrawing);

    closeButton.addEventListener('click', resetDrawingMode);

    window.openImageEditor = function(imageId, estimateId, imageUrl) {
        currentImageId = imageId;
        currentEstimateId = estimateId;
        document.getElementById('estimate_image_id').value = imageId;
        imageView.crossOrigin = "anonymous";
        imageView.src = imageUrl;
        resetDrawingMode();
    };

    // Initialize state
    resetDrawingMode();
});
</script>
