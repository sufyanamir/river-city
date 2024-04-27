@include('layouts.header')
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Group List</h4>
            </div>
            <div>
                <x-add-button :id="'addGroup'" :title="'+Add Group'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Group Name</th>
                            <th>Type</th>
                            <th>Items</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{ ucwords($group->group_name) }}</td>
                            <td>{{ ucfirst($group->group_type) }}</td>
                            <td>{{ $group->items_count }}</td>
                            <td>{{ ucfirst($group->group_description) }}</td>
                            <td>
                                <button id="editGroup{{$group->group_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editGroup-modal{{$group->group_id}}">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Background overlay -->
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
                                        </div>

                                        <!-- Modal panel -->
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <form action="/editGroup" method="post" id="formData{{$group->group_id}}">
                                                @csrf
                                                <input type="hidden" name="group_id" value="{{$group->group_id}}">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <!-- Modal content here -->
                                                    <div class=" flex justify-between">
                                                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Edit Group</h2>
                                                        <button class="modal-close" type="button">
                                                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                                        </button>
                                                    </div>
                                                    <!-- task details -->
                                                    <div class=" grid grid-cols-2 gap-2">
                                                        <div class=" my-2">
                                                            <label for="group_name">Group Name:</label>
                                                            <input type="text" name="group_name" id="group_name" value="{{$group->group_name}}" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                        </div>
                                                        <!-- <div class="my-2">
                            <label for="total_items">Total Items:</label>
                            <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div> -->
                                                        <div class=" my-2">
                                                            <label for="group_type">Group Type:</label>
                                                            <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                                <option value="{{$group->group_type}}">{{ucfirst($group->group_type)}}</option>
                                                                <option>type</option>
                                                                <option value="labour">Labor</option>
                                                                <option value="material">Material</option>
                                                                <option value="assemblies">Assemblies</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-span-2">
                                                            <div class="flex justify-around my-2">
                                                                <div>
                                                                    <input type="checkbox" name="show_unit_price" id="show_unit_price{{$group->group_id}}" value="1" {{ $group->show_unit_price == 1 ? 'checked' : '' }}>
                                                                    <label for="show_unit_price{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" name="show_quantity" id="show_quantity{{$group->group_id}}" value="1" {{ $group->show_quantity == 1 ? 'checked' : '' }}>
                                                                    <label for="show_quantity{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Quantities</label>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" name="show_total" id="show_total{{$group->group_id}}" value="1" {{ $group->show_total == 1 ? 'checked' : '' }}>
                                                                    <label for="show_total{{$group->group_id}}" class="text-gray-500 text-xs">Show Line Item Totals</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class=" text-left col-span-2">
                            <h3 class=" font-medium text-lg">Items:</h3>
                            {{-- <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Item name</option>
                                <option>Interior</option>
                                <option>Exterior</option>
                                <option>Labour</option>
                            </select> --}}
                            {{-- ======multiple item inputs===== --}}
                            <div id="muliple_items">
                            </div>

                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="selectItems" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div> -->
                                                        <div class="my-2 col-span-2 relative">
                                                            <label for="group_description">Description:</label>
                                                            <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">{{$group->group_description}}</textarea>
                                                            <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
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
                                <script>
                                    document.getElementById("editGroup{{$group->group_id}}").addEventListener("click", function(e) {
                                        e.preventDefault();
                                        document.getElementById("editGroup-modal{{$group->group_id}}").classList.remove('hidden');
                                    });

                                    document.querySelectorAll(".modal-close").forEach(function(closeBtn) {
                                        closeBtn.addEventListener("click", function(e) {
                                            e.preventDefault();
                                            document.getElementById("editGroup-modal{{$group->group_id}}").classList.add('hidden');
                                            document.getElementById("formData{{$group->group_id}}").reset();
                                        });
                                    });
                                </script>

                                <form class=" inline-block" action="/delete/group/{{ $group->group_id }}" method="post">
                                    @csrf
                                    <button disabled>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
            <form action="/addGroup" method="post" id="formData">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Group</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" grid grid-cols-2 gap-2">
                        <div class=" my-2">
                            <label for="group_name">Group Name:</label>
                            <input type="text" name="group_name" id="group_name" placeholder="Group Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <!-- <div class="my-2">
                            <label for="total_items">Total Items:</label>
                            <input type="text" name="total_items" id="total_items" placeholder="Total Items" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div> -->
                        <div class=" my-2">
                            <label for="group_type">Group Type:</label>
                            <select id="group_type" name="group_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option value="labour">Labor</option>
                                <option value="material">Material</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <div class=" flex justify-around my-2">
                                <div>
                                    <input type="checkbox" name="show_unit_price" id="show_unit_price" value="1">
                                    <label for="show_unit_price" class=" text-gray-500 text-xs">Show Line Item Unit Prices</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="show_quantity" id="show_quantity" value="1">
                                    <label for="show_quantity" class=" text-gray-500 text-xs">Show Line Item Quantities</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="show_total" id="show_total" value="1">
                                    <label for="show_total" class=" text-gray-500 text-xs">Show Line Item Totals</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class=" text-left col-span-2">
                            <h3 class=" font-medium text-lg">Items:</h3>
                            {{-- <select id="customer" name="customer" autocomplete="customer-name" class=" p-2 w-[92%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>Item name</option>
                                <option>Interior</option>
                                <option>Exterior</option>
                                <option>Labour</option>
                            </select> --}}
                            {{-- ======multiple item inputs===== --}}
                            <div id="muliple_items">
                            </div>

                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="selectItems" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div> -->
                        <div class="my-2 col-span-2 relative">
                            <label for="group_description">Description:</label>
                            <textarea name="group_description" id="group_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="group-description-mic" class=" absolute mt-8 right-4" onclick="voice('group-description-mic', 'group_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class="">
                        <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
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
                    <!-- task details -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Select Items</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <div class="overflow-x-auto pt-2">
                        <table id="" class="display universalTable" style="width: 100%;">
                            <thead class="text-xs text-white uppercase bg-[#930027]">
                                <tr>
                                    <th style="width: 30px !important;" class="px-6 py-3">
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
                                @foreach ($items as $i => $values)
                                <tr class="bg-white border-b">
                                    <td style="width: 30px !important;" class="px-6 py-4">
                                        {{ $values['item_name'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $values['item_type'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $values['item_units'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{ $values['item_cost'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        ${{ $values['item_price'] }}
                                    </td>
                                    <td>
                                        <input class="checkboxes" type="checkbox" name="Edit" id="privilegeUserEdit{{ $i }}" data-item-name="{{ $values['item_name'] }}" data-item-price="{{ $values['item_price'] }}" data-item-id="{{ $values['item_id'] }}""
                                                data-item-cost=" {{ $values['item_cost'] }}">
                                        <label for="privilegeUserEdit{{ $i }}" class="text-gray-500 opacity-1"></label>
                                    </td>
                                </tr>
                                @endforeach

                                <script>
                                    let muliple_items = document.querySelector('#muliple_items');
                                    document.addEventListener('DOMContentLoaded', function() {
                                        let checkboxes = document.querySelectorAll('.checkboxes');

                                        checkboxes.forEach(function(checkbox) {
                                            checkbox.addEventListener('change', function() {
                                                if (this.checked) {
                                                    let itemName = this.getAttribute('data-item-name');
                                                    let itemPrice = this.getAttribute('data-item-price');
                                                    let itemCost = this.getAttribute('data-item-cost');
                                                    let itemid = this.getAttribute('data-item-id');

                                                    let newelements = document.createElement('div');
                                                    let id = Math.floor(Math.random() * 999 + 1);
                                                    newelements.id = "eleremove" + id;
                                                    newelements.innerHTML = `<input type="hidden" placeholder="id" name="group_item_ids[]" value="${itemid}">
                                                    <label for="group_items">Item Name:</label>
                                                    <input type="text" id="group_items" name="group_items[]" autocomplete="customer-name" value="${itemName}"
                                                     class=" p-2 w-full outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                                                     placeholder="Item Name">
                                                 <div class="flex flex-1 gap-10 mt-2">
                                                     <div>
                                                     <label for="item_cost">Item Cost:</label>
                                                    <br>
                                                    <input type="text" id="itemprice" name="itemcost"  value="${itemCost}"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                                                 placeholder="Item Cost">
                                                        </div>
                                                    <div>
                                                       <label for="group_price">Item Price:</label>
                                                    <br>
                                                    <input type="text" id="itemcost" name="itemprice"  value="${itemPrice}"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6"
                                                    placeholder="Item Price">
                                                    </div>
                                                     <div class="mt-6">
                                                    <button type="button" onclick="removeelements('#eleremove${id}')"
                                                     class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]"
                                                     aria-expanded="true" aria-haspopup="true">
                                                        <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}"
                                                    alt="icon">
                                                       </button>
                                                 </div>
                                              </div>`
                                                    let updatebtn = document.querySelector('#additems');
                                                    let iid = 0;
                                                    updatebtn.addEventListener('click', () => {
                                                        if (iid == 0) {
                                                            muliple_items.append(newelements);
                                                            iid = 1
                                                        }

                                                    })
                                                }
                                            });
                                        });
                                    });

                                    function removeelements(e) {
                                        let ele = document.querySelector(e);
                                        if (ele) {
                                            ele.remove();
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        <button id="additems" class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 addItemsModal-close ">Save
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
        $("#formData")[0].reset()
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
    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#selectItems-modal").addClass('hidden');
        $("#selectItems-form")[0].reset()
    });
</script>