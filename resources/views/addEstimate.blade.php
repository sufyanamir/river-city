@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="pb-5">
            <div class="bg-[#930027] mt-5">
                <h2 class="py-3 text-center text-[#FFFFFF] text-[18px]/[27px] font-semibold">New Quotation</h2>
            </div>
            <form action="">
                <div class="mt-10 mb-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3 ml-6 flex justify-between">
                        <label for="date" class=" text-sm font-medium leading-6  text-black">Date</label>
                        <input type="date" name="first-name" id="first-name" autocomplete="given-name"
                            class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-3 mr-6 flex justify-between">
                        <label for="customer" class=" text-sm font-medium leading-6 text-gray-900">Customer</label>
                        <select id="customer" name="customer" autocomplete="customer-name"
                            class=" ml-1 pl-2 w-[78%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"">
                            <option>Select Customer</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                        <x-quick-add-btn :icon="'plus-icon.svg'"></x-quick-add-btn>

                    </div>
                    <div class="sm:col-span-3 ml-6 flex justify-between">
                        <label for="email" class=" text-sm font-medium leading-6   text-black">Email</label>
                        <input type="email" name="email" id="email" autocomplete="given-email"
                            class="  ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-3 mr-6 flex justify-between">
                        <label for="number" class=" text-sm font-medium leading-6  text-black">Phone No</label>
                        <input type="text" name="email" id="email" placeholder="Phone Number"
                            class="   ml-1 pl-2 w-[85%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-6 mx-6 flex justify-between">
                        <label for="address" class=" text-sm font-medium leading-6  text-black">Address</label>
                        <input type="text" name="address" id="address" placeholder="Phone Number"
                            class="   ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-3 ml-6 flex justify-between">
                        <label for="sceduler" class=" text-sm font-medium leading-6 text-gray-900">Sceduler</label>
                        <select id="sceduler" name="customer" autocomplete="customer-name"
                            class=" ml-1 pl-2 w-[90%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <option>Select Sceduler</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>
                    <div class="sm:col-span-3 mr-6 flex justify-between">
                        <label for="date" class=" text-sm font-medium leading-6  text-black">Schedule <br>
                            Date Time</label>
                        <input type="date" name="first-name" id="first-name" autocomplete="given-name"
                            class=" ml-1 pl-2 w-[85%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-6 mx-6 flex justify-between">
                        <label for="note" class=" text-sm font-medium leading-6  text-black">Note</label>
                        <input type="text" name="note" id="note" placeholder="Note"
                            class="   ml-1 pl-2 w-[95%] outline-none rounded-md border-0 py-1.5 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                    </div>

                </div>
                <div class="border-t text-right ">
                    <x-add-button :title="'Add'" :class="'m-5 px-6'"  :id="''" ></x-add-button>
                </div>

            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
