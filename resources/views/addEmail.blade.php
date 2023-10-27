@include('layouts.header')
<style>
    /* Default color for the radio button */
    input[type="radio"] {
        /* Add any styles you want for the unchecked state here */
    }

    /* Style the radio button when it's checked */
    input[type="radio"]:checked {
        background-color: #930027;
        /* You can add other styles to customize the checked state */
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
            <form action="">
                <div class="mt-10 mb-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3 ml-6 flex justify-between">
                        <label for="name" class=" text-sm font-medium leading-6  text-black">Name</label>
                        <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-3 mr-6 flex justify-between">
                        <label for="type" class=" text-sm font-medium leading-6 text-gray-900">Type</label>
                        <select id="customer" name="customer" autocomplete="customer-name" class=" ml-1 pl-2 w-[78%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"">
                            <option>Select Customer</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                            <input type="checkbox" checked name="" id="clientCheck">
                            <label for="clientCheck" class=" font-semibold">Client</label>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                        <input type="checkbox" checked name="" id="senderCheck">
                        <label for="senderCheck" class=" font-semibold">Sender</label>
                    </div>
                    <div class=" sm:col-span-2 ml-6 text-center">
                        <input type="checkbox" checked name="" id="projectOwnerCheck">
                        <label for="projectOwnerCheck" class=" font-semibold">Project Owner</label>
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">To</label>
                        <textarea placeholder="Optional" class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="" id=""></textarea>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">Subject</label>
                        <textarea placeholder="Subject (account_company_name] [project_document_type} # [project_number)" class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="" id=""></textarea>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" sm:col-span-6 mx-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">Body</label>
                        <textarea placeholder="Body Optional " class="  ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6" name="" id=""></textarea>
                        <!-- <input type="email" name="email" id="email" autocomplete="given-email" class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class="sm:col-span-6 mx-20">
                        <label for="number" class=" text-sm leading-6 text-gray-400">Format:</label>
                        <input type="radio" name="format" id="plainText"> <label for="plainText" class="text-gray-400">Plain Text</label>
                        <input type="radio" name="format" id="markDown"> <label for="markDown" class="text-gray-400">Markdown</label>
                        <!-- <input type="text" name="email" id="email" placeholder="Phone Number" class="   ml-1 pl-2 w-[85%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class="sm:col-span-6 mx-6 flex justify-start">
                        <label for="note" class=" text-sm font-medium leading-6  text-black">Attachments</label>
                        <input type="checkbox" checked name="" id="attachments">
                        <label for="attachments" class=" text-gray-400">Include Project Documents</label>
                        <!-- <input type="text" name="note" id="note" placeholder="Note" class="   ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"> -->
                    </div>
                    <div class=" mx-28">
                        <input class=" border p-2 rounded-xl" type="file" name="" id="">
                    </div>

                </div>
                <div class="border-t text-right ">
                    <x-add-button :title="'Save'" :class="'m-5 px-6'" :id="''"></x-add-button>
                </div>

            </form>
        </div>
    </div>
</div>
@include('layouts.footer')