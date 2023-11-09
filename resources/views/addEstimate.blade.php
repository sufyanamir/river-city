@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Estimates</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class="pb-5">
            <div class="bg-[#930027] mt-5">
                <h2 class="py-3 text-center text-[#FFFFFF] text-[18px]/[27px] font-semibold">New Quotation</h2>
            </div>
            <div class=" px-4">
                <form action="">
                    <div class="mt-10 mb-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 m-3">
                        <div class="sm:col-span-3 flex justify-between gap-2">
                            <label for="date" class=" text-sm font-medium my-auto  text-black">Date</label>
                            <input type="date" name="first-name" id="first-name" autocomplete="given-name" class=" p-2 w-[85%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="sm:col-span-3 flex justify-between gap-2">
                            <label for="customer" class=" text-sm font-medium my-auto text-gray-900">Customer</label>
                            <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[76%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Select Customer</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                            <div class=" my-auto">
                                <x-quick-add-btn :icon="'plus-icon.svg'"></x-quick-add-btn>
                            </div>
                        </div>
                        <!-- <div></div> -->
                        <div class=" sm:col-span-3 flex justify-between gap-2">
                            <label for="email" class=" text-sm font-medium my-auto   text-black">Email</label>
                            <input type="email" name="email" id="email" autocomplete="given-email" class="  p-2 w-[85%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="sm:col-span-3 flex justify-between gap-2">
                            <label for="number" class=" text-sm font-medium my-auto  text-black">Phone No</label>
                            <input type="text" name="email" id="email" placeholder="Phone Number" class="   p-2 w-[85%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="sm:col-span-6 flex justify-between gap-6">
                            <label for="address" class=" text-sm font-medium my-auto  text-black">Address</label>
                            <textarea type="text" name="address" id="address" placeholder="Address" class="   p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <div class="sm:col-span-3 flex justify-between gap-2 py-2">
                            <label for="sceduler" class=" text-sm font-medium my-auto text-gray-900">Sceduler</label>
                            <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[85%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Select Customer</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                        </div>
                        <div class="sm:col-span-3 flex justify-between gap-2 py-2">
                            <label for="date" class=" text-sm font-medium my-auto text-black">Date Time</label>
                            <input type="date" name="first-name" id="first-name" autocomplete="given-name" class=" p-2 w-[90%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="sm:col-span-6 flex justify-between gap-10">
                            <label for="note" class=" text-sm font-medium my-auto text-black">Note</label>
                            <textarea type="text" name="note" id="note" placeholder="Note" class="   p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="border-t text-right ">
                        <x-add-button :title="'Add'" :class="'m-5 px-6'" :id="''"></x-add-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')