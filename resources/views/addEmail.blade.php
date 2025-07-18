@include('layouts.header')
<style>
    /* Default color for the radio button */
    input[type="radio"] {
        /* Add any styles you want for the u state here */
    }

    /* Style the radio button when it's */
    input[type="radio"] {
        background-color: #930027;
        /* You can add other styles to customize the state */
    }
</style>
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Email</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="pb-5">
            <div class="bg-[#930027] mt-5 relative">
                <h2 class="py-3 text-center text-[#FFFFFF] text-[18px]/[27px] font-semibold">Email Template</h2>
                <div class=" absolute top-0 right-0 my-3 mr-6">
                    <img src="{{ asset('assets/icons/question-icon.svg') }}" alt="icon">
                </div>
            </div>
            <form action="/addEmail" id="formData" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-10 mb-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3 ml-6 flex justify-between">
                        <label for="name" class=" text-sm font-medium leading-6  text-black">Name</label>
                        <input type="text" name="email_name" id="email_name" autocomplete="given-name"
                            class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-3 mr-6 flex justify-between">
                        <label for="type" class=" text-sm font-medium leading-6 text-gray-900 mx-auto">Type</label>
                        <select id="type" name="email_type" autocomplete="customer-name"
                            class=" ml-1 pl-2 w-[78%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <option>Select</option>
                            <option>all project</option>
                            <option>promotion</option>
                            <option>event</option>
                        </select>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                        <input type="checkbox" name="recieving_chcekbox" id="clientCheck">
                        <label for="clientCheck" class=" font-semibold">Client</label>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                        <input type="checkbox" name="recieving_chcekbox" id="senderCheck">
                        <label for="senderCheck" class=" font-semibold">Sender</label>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                        <input type="checkbox" name="recieving_chcekbox" id="projectOwnerCheck">
                        <label for="projectOwnerCheck" class=" font-semibold">Project Owner</label>
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">To</label>
                        <textarea placeholder="Optional"
                            class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                            name="email_to" id="email_to"></textarea>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">Subject</label>
                        <textarea placeholder="Subject (account_company_name] [project_document_type} # [project_number)"
                            class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                            name="email_subject" id="email_subject"></textarea>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between relative">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">Body</label>
                        <textarea placeholder="Body Optional "
                            class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                            name="email_body" id="email_body"></textarea>
                        <button type="button" id="estimate-mic" class=" absolute mt-10 bottom-1 right-4"
                            onclick="voice('estimate-mic', 'email_notes')"><i
                                class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class="sm:col-span-6 mx-20">
                        <label for="number" class=" text-sm leading-6 text-gray-400">Format:</label>
                        <input type="radio" name="email_format" value="plain text" id="plainText"> <label
                            for="plainText" class="text-gray-400">Plain Text</label>
                        <input type="radio" name="email_format" value="mark down" id="markDown"> <label
                            for="markDown" class="text-gray-400">Markdown</label>
                        <!-- <input type="text" name="email" id="email" placeholder="Phone Number" class="   ml-1 pl-2 w-[85%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class="sm:col-span-6 mx-6 flex justify-start gap-2">
                        <label for="note"
                            class=" text-sm font-medium leading-6 my-auto  text-black">Attachments</label>
                        <input type="checkbox" id="emailAttachmentsCheck">
                        <label for="emailAttachmentsCheck" class=" text-gray-400">Include Project Documents</label>
                        <!-- <input type="text" name="note" id="note" placeholder="Note" class="   ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" mx-28">
                        <input class=" border p-2 rounded-xl hidden" type="file" name="email_attachments"
                            id="emailAttachmentsfile">
                    </div>

                </div>
                <div class="border-t text-right ">
                    <button class=" m-3 p-2 rounded-md font-medium bg-[#930027] text-white">
                        <div class=" text-center hidden spinner" id="spinner">
                            <svg aria-hidden="true"
                                class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text" id="text">
                            Save
                        </div>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
