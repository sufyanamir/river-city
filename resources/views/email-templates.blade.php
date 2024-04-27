@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Email Template List</h4>
            </div>
            <div>
                @if (session('user_details')['user_role'] == 'admin')
                <a href="/addEmail">
                    <x-add-button :title="'+Add Template'" :class="''" :id="''"></x-add-button>
                </a>
                @elseif(isset($userPrivileges->emails) && isset($userPrivileges->emails->add) && $userPrivileges->emails->add === 'on')
                <a href="/addEmail">
                    <x-add-button :title="'+Add Template'" :class="''" :id="''"></x-add-button>
                </a>
                @endif
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Format</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach($emailTemplates as $email)
                        <tr>
                            <td>{{ $email->email_name }}</td>
                            <td>{{ $email->email_type }}</td>
                            <td>{{ $email->email_format }}</td>
                            <td>
                                @if (session('user_details')['user_role'] == 'admin')
                                <button id="editEmail{{$email->email_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->emails) && isset($userPrivileges->emails->edit) && $userPrivileges->emails->edit === 'on')
                                <button id="editEmail{{$email->email_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                                @if (session('user_details')['user_role'] == 'admin')
                                <form class=" inline-block" action="/delete/email/{{ $email->email_id }}" method="post">
                                    @csrf
                                    <button disabled>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @elseif(isset($userPrivileges->emails) && isset($userPrivileges->emails->delete) && $userPrivileges->emails->delete === 'on')
                                <form class=" inline-block" action="/delete/email/{{ $email->email_id }}" method="post">
                                    @csrf
                                    <button disabled>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @endif
                                <button>
                                    <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="btn">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editEmail-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/updateEmail" method="post" enctype="multipart/form-data" id="formData">
                @csrf
                <input type="hidden" name="email_id" id="email_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Edit Email</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div>
                            <label for="name" class=" text-sm font-medium leading-6  text-black">Name:</label>
                            <input type="text" name="email_name" id="email_name" autocomplete="given-name" class="  ml-1 pl-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            <label for="name" class=" text-sm font-medium leading-6  text-black">Type:</label>
                            <select id="type" name="email_type" autocomplete="customer-name" class=" ml-1 pl-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">Select</option>
                                <option>all project</option>
                                <option>promotion</option>
                                <option>event</option>
                            </select>
                        </div>
                        <div class=" col-span-2">
                            <label for="name" class=" text-sm font-medium leading-6  text-black">To:</label>
                            <textarea placeholder="Optional" class="  ml-1 pl-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="email_to" id="email_to"></textarea>
                        </div>
                        <div class=" col-span-2">
                            <label for="name" class=" text-sm font-medium leading-6  text-black">Subject:</label>
                            <textarea placeholder="Subject (account_company_name] [project_document_type} # [project_number)" class="  ml-1 pl-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="email_subject" id="email_subject"></textarea>
                        </div>
                        <div class=" col-span-2">
                            <label for="name" class=" text-sm font-medium leading-6  text-black">Body:</label>
                            <textarea placeholder="Body Optional " class="  ml-1 pl-2 w-[100%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="email_body" id="email_body"></textarea>
                            <button type="button" id="estimate-mic" class=" absolute bottom-11 right-8" onclick="voice('email-mic', 'email_notes')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class="">
                        <button id="updateEvent" class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(".modal-close").click(function(e) {
        e.preventDefault();
        e.stopPropagation(); // Add this line
        $("#editEmail-modal").addClass('hidden');
        $("#formData")[0].reset();
    });

    $(document).ready(function() {
        $('[id^="editEmail"]').click(function() {
            var itemId = this.id.replace('editEmail', '');
            $.ajax({
                url: '/getEmailToEdit/' + itemId,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var email = response.emailData;
                        // Show modal
                        $('#editEmail-modal').removeClass('hidden');

                        $('#email_id').val(email.email_id);
                        $('#email_name').val(email.email_name);
                        $('#email_type').val(email.email_type);
                        $('#email_to').val(email.email_to);
                        $('#email_subject').val(email.email_subject);
                        $('#email_body').val(email.email_body);

                        // Update modal fields based on item type


                        // You can continue to populate other fields based on your data
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });
</script>