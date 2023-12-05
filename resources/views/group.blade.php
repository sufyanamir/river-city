@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Groups</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Group List</h4>
            </div>
            <div>
                <x-add-button :id="'addGroup'" :title="'+Add Group'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Group Name</th>
                            <th>Type</th>
                            <th>Items</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td>Living room</td>
                            <td>Interior</td>
                            <td>10</td>
                            <td>Lorum Lorum Lorum Lorum Lorum Ipsum...</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- add group --}}
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addGroup-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="addGroup-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Group</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2 my-2">
                            <input type="text" name="groupName" id="groupName" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2">
                            <input type="text" name="totalItems" id="totalItems" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2">
                            <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option>Services</option>
                                <option>Product</option>
                                <option>Assemblies</option>
                            </select>
                        </div>
                        <div class=" text-left col-span-2">
                            <h3 class=" font-medium text-lg">Items</h3>
                            {{-- <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Item name</option>
                                <option>Interior</option>
                                <option>Exterior</option>
                                <option>Labour</option>
                            </select> --}}
                            <input type="text" id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            <button type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="" aria-expanded="true" aria-haspopup="true">
                                <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                            </button>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="selectItems" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="my-2 col-span-2">
                            <textarea name="" id="" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <button id="updateEvent" class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add group --}}

{{-- select ietms --}}
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="selectItems-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <form action="" id="selectItems-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <div class=" " id="">
                            <x-add-button :id="''" :title="'All'" :class="' bg-[#E02B20] px-6'"></x-add-button>
                            <x-add-button :id="''" :title="'Product'" :class="''"></x-add-button>
                            <x-add-button :id="''" :title="'Labour'" :class="''"></x-add-button>
                            <x-add-button :id="''" :title="'Assemblies'" :class="''"></x-add-button>
                        </div>
                        <button class="addItemsModal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <div class=" my-2">
                        <input type="text" name="search" id="search" placeholder="Search" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    </div>
                    <!-- task details -->

                    <div class="relative overflow-x-auto h-60 overflow-y-auto my-2">
                        <table class="w-full text-sm text-left ">
                            <thead class="text-xs text-white uppercase bg-[#930027]">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item name
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Units
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cost
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($items as $values)
                                    
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$values['item_name']}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$values['item_type']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$values['item_units']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{$values['item_cost']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{$values['item_price']}}
                                    </td>
                                    <td>
                                        <input type="checkbox" name="Edit" id="privilegeUserEdit">
                                        <label for="privilegeUserEdit" class=" text-gray-500 opacity-1"></label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" flex justify-between pt-2">
                        <button id="updateEvent" class=" mb-2 py-1 px-7 rounded-md border ">Cancel
                        </button>
                        <button id="updateEvent" class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- select ietms --}}

@include('layouts.footer')
<script>
    $("#addGroup").click(function(e) {
        e.preventDefault();
        $("#addGroup-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addGroup-modal").addClass('hidden');
        $("#addGroup-form")[0].reset()
    });
</script>
<script>
    $("#selectItems").click(function(e) {
        e.preventDefault();
        $("#selectItems-modal").removeClass('hidden');
    });

    $(".addItemsModal-close").click(function(e) {
        e.preventDefault();
        $("#selectItems-modal").addClass('hidden');
        $("#selectItems-form")[0].reset()
    });
</script>