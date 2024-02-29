@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Items List</h4>
            </div>
            <div class=" flex gap-5">
                @if (session('user_details')['user_role'] == 'admin')
                <a href="/items">
                    <x-add-button :id="'all'" :title="'all'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'labour']) }}">
                    <x-add-button :id="'Labor'" :title="'Labor'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'material']) }}">
                    <x-add-button :id="'Material'" :title="'Material'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'assemblies']) }}">
                    <x-add-button :id="'Assembly'" :title="'Assembly'" :class="''"></x-add-button>
                </a>
                <x-add-button :id="'addItem'" :title="'+Add Item'" :class="''"></x-add-button>
                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->add) && $userPrivileges->item->add === 'on')
                <a href="/items">
                    <x-add-button :id="'all'" :title="'all'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'labour']) }}">
                    <x-add-button :id="'Labor'" :title="'Labor'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'material']) }}">
                    <x-add-button :id="'Material'" :title="'Material'" :class="''"></x-add-button>
                </a>
                <a href="{{ route('items', ['type' => 'assemblies']) }}">
                    <x-add-button :id="'Assembly'" :title="'Assembly'" :class="''"></x-add-button>
                </a>
                <x-add-button :id="'addItem'" :title="'+Add Item'" :class="''"></x-add-button>
                @endif
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>Units</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th style="width:300px !important">Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->item_type }}</td>
                            <td>{{ $item->item_units }}</td>
                            <td>{{ $item->item_cost }}</td>
                            <td>{{ $item->item_price }}</td>
                            <td class=" w-[100px]">{{ $item->item_description }}</td>
                            <td>
                                @if (session('user_details')['user_role'] == 'admin')
                                <button id="editItem{{$item->item_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->edit) && $userPrivileges->item->edit === 'on')
                                <button id="editItem{{$item->item_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                                @if (session('user_details')['user_role'] == 'admin')
                                <form action="/delete/item/{{ $item->item_id }}" class=" inline-block" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->delete) && $userPrivileges->item->delete === 'on')
                                <form action="/delete/item/{{ $item->item_id }}" class=" inline-block" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addItem-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addItem" method="post" enctype="multipart/form-data" id="formData">
                @csrf
                <input type="hidden" name="item_id" id="item_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Items</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-3 gap-2">
                        <div class="  col-span-3 my-2">
                            <label for="" class="block text-left mb-1"> Items Type</label>
                            <select id="type" name="item_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option value="labour">labour</option>
                                <option value="material">Material</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class=" my-2 col-span-2">
                            <label for="" class="block  text-left text-sm mb-1"> Item Name</label>
                            <input type="text" name="item_name" id="itemName" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2">
                            <label for="" class="block text-left text-sm mb-1"> Item Unit</label>
                            <input type="text" id="item_units" name="item_units" autocomplete="customer-name" placeholder="Units(Optional)" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                        </div>
                        <div class="my-2 text-left">
                            <label for="" class=" block text-left text-sm mb-1">Price:</label>
                            <input type="number" step="any" name="item_price" id="item_price" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Margin: <span id="price_margin">0.00</span>%</span>
                        </div>
                        <div></div>
                        <div></div>
                        <div class="my-2 text-left">
                            <label for="" class=" block text-left text-sm mb-1">Cost ($/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="item_cost" id="item_cost" readonly placeholder="0.00" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2" id="labourExpense">
                            <label for="" class="block text-left text-sm mb-1"> Labour Cost (min/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="labour_expense" id="labour_expense" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <span class=" m-0 p-0 text-xs float-left text-gray-400">Labour Cost: $23.50/hr</span>
                        </div>
                        <div class="my-2" id="materialExpense">
                            <label for="" class="block text-left text-sm mb-1"> material Cost ($/<span class="unit">unit</span>)</label>
                            <input type="number" step="any" name="material_expense" id="material_expense" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2 col-span-3 hidden" id="multiAdd-items">
                            <div id="mulitple_input">
                                <!-- <label for="" class="block text-left mb-1"> Assembly Name </label>
                                <select name="assembly_name[]" id="" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <option value="">Select Item</option>
                                    @foreach ($itemsForAssemblies as $item)
                                    <option value="{{ $item->item_name }}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}">
                                        {{ $item->item_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class=" grid grid-cols-2 gap-3 mt-2">
                                    <div>
                                        <input type="number" step="any" name="item_unit_by_ass_unit[]" id="item_unit_by_ass_unit" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">unit</span></span>
                                    </div>
                                    <div>
                                        <input type="number" step="any" name="ass_unit_by_item_unit[]" id="ass_unit_by_item_unit" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <span class=" m-0 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">unit</span>/<span class="unit">unit</span></span>
                                    </div>
                                </div> -->
                            </div>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="addbtn" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="my-2 col-span-3 relative">
                            <label for="" class="block text-left mb-1"> Item Description </label>
                            <textarea name="item_description" id="item_description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="items-mic" class=" absolute mt-8 right-4" onclick="voice('items-mic', 'item_description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
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
    $("#addItem").click(function(e) {
        e.preventDefault();
        $("#addItem-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addItem-modal").addClass('hidden');
        $("#formData")[0].reset();

        // Remove appended assembly rows
        $('#mulitple_input').empty();
        $('#item_id').val('');
        $('#formData').attr('action', '/addItem');
    });
    $('#mulitple_input').on('change', 'select[name="assembly_name[]"]', function() {
        // Get the selected option
        var selectedOption = $(this).find(':selected');

        // Get the item_unit from the data-unit attribute
        var itemUnit = selectedOption.data('unit');

        // Update the elements based on the item_unit only within the current row
        var unitLabel = $(this).closest('.grid').find('.addedItemUnit');
        unitLabel.text(itemUnit);

        // You can add more logic here to update other elements based on the item_unit
    });

    let mulitple_input = $('#mulitple_input');
    let button = $('#addbtn');

    button.on('click', function() {
        let id = Math.floor(Math.random() * 999 + 1);
        let newele = $('<div class="mt-5"  id="unid' + id + '"></div>');
        let selectId = 'assembly_id_' + id;
        let itemUnitById = 'item_unit_by_ass_unit_' + id; // Dynamic ID for item_unit_by_ass_unit input
        let assUnitById = 'ass_unit_by_item_unit_' + id; // Dynamic ID for ass_unit_by_item_unit input
        let rembtn = $('<span></span>');

        newele.html(`
        <select name="assembly_name[]" id="${selectId}" placeholder="Item Name" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
            <option value="">Select Item</option>
            @foreach ($itemsForAssemblies as $item)
            <option id="option_id{{$item->item_id}}" value="{{ $item->item_name }}" data-item-price="{{$item->item_price}}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
            @endforeach
        </select>
        <div class="grid grid-cols-2 gap-3 mt-2 inline-block">
            <div>
                <input type="number" step="any" name="item_unit_by_ass_unit[]" id="${itemUnitById}" placeholder="00.0" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                <span class="m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit">unit</span></span>
            </div>
            <div class="d-flex flex-col">
                <div class="d-flex">
                    <input type="number" step="any" name="ass_unit_by_item_unit[]" id="${assUnitById}" placeholder="00.0" autocomplete="given-name" class="w-[70%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                    <button  onclick="remass('#unid${id}')" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                        <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <span class="m-0 ml-4 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit">unit</span>/<span class="unit">unit</span></span>
            </div>
        </div>
    `);

        mulitple_input.append(newele);
        newele.append(rembtn);
    });

    function remass(e) {
        let ele = document.querySelector(e);
        if (ele) {
            ele.remove();
        }
    }

    $(document).on('input', '[id^="item_unit_by_ass_unit_"]', function() {
    // Initialize variables to store total expenses for labour and material items
    var totalLabourExpense = 0;
    var totalMaterialExpense = 0;

    // Iterate over each row
    $('[id^="item_unit_by_ass_unit_"]').each(function() {
        // Get the ID of the item_unit_by_ass_unit input for the current row
        var itemId = $(this).attr('id').replace('item_unit_by_ass_unit_', '');

        // Retrieve the selected option from the corresponding select element for the current row
        var selectedOption = $('#assembly_id_' + itemId + ' option:selected');

        // Retrieve data from the selected option for the current row
        var itemType = selectedOption.data('item-type');
        var labourExpense = selectedOption.data('labour-expense');
        var materialExpense = selectedOption.data('material-expense');
        var itemPrice = selectedOption.data('item-price');

        // Get the value entered in the item_unit_by_ass_unit input for the current row
        var itemUnitValue = parseFloat($(this).val());

        // Perform calculations based on item type for the current row
        if (itemType === 'labour') {
            if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
                var calculatedValue = (itemPrice / labourExpense) / itemUnitValue;

                $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue.toFixed(4));
                // Update total labour expense for the current row
                totalLabourExpense += calculatedValue * 1 * itemPrice;
            }else{
                $('#labour_expense').val('');
                $('#ass_unit_by_item_unit_' + itemId).val('');
            }
        } else if (itemType === 'material') {
            if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
                var calculatedValue = (itemPrice / materialExpense) / itemUnitValue;
                $('#ass_unit_by_item_unit_' + itemId).val(calculatedValue.toFixed(4));
                // Update total material expense for the current row
                totalMaterialExpense += calculatedValue * 1 * itemPrice;
            }else{
                $('#material_expense').val('');
                $('#ass_unit_by_item_unit_' + itemId).val('');
            }
        }
    });

    // Set the total labour and material expenses in their respective inputs
    $('#labour_expense').val(totalLabourExpense.toFixed(2));
    $('#material_expense').val(totalMaterialExpense.toFixed(2));

    // Calculate the sum of labour expense and material expense
    var totalExpense = totalLabourExpense + totalMaterialExpense;

    // Calculate the item cost as half of the total expense
    var itemCost = totalExpense / 2;

    // Set the total expense and item cost in their respective inputs
    $('#item_price').val(totalExpense.toFixed(2));
    $('#item_cost').val(itemCost.toFixed(2));
});

</script>
<script>
    $('[id^="editItem"]').click(function() {
        var itemId = this.id.replace('editItem', '');
        $.ajax({
            url: '/getItemToEdit/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var item = response.data.item;
                    var assemblies = response.data.item.assemblies;
                    // Show modal
                    $('#addItem-modal').removeClass('hidden');

                    // Update modal fields based on item type
                    $('#type').val(item.item_type).trigger('change'); // Trigger change event to update other fields

                    $('#item_id').val(item.item_id);
                    $('#itemName').val(item.item_name);
                    $('#item_units').val(item.item_units);
                    $('#labour_expense').val(item.labour_expense);
                    $('#material_expense').val(item.material_expense);
                    $('#item_cost').val(item.item_cost);
                    $('#item_price').val(item.item_price);
                    $('#item_description').val(item.item_description);
                    $('#formData').attr('action', '/updateItem');

                    // Reset the assemblies container
                    $('#mulitple_input').empty();

                    if (item.item_type === 'labour') {
                        $('#labour_expense').val(item.labour_expense);
                    } else if (item.item_type === 'material') {
                        $('#material_expense').val(item.material_expense);
                    } else if (item.item_type === 'assemblies') {
                        // Populate rows for assemblies
                        $.each(assemblies, function(index, assembly) {
                            var newAssemblyDiv = $('<div class="mt-5"></div>');
                            newAssemblyDiv.html(`
                            <div class="flex justify-between">
                                <select name="assembly_name[]" id="assembly_id_${index}" placeholder="Item Name" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <option value="">Select Item</option>
                                    @foreach ($itemsForAssemblies as $item)
                                    <option value="{{ $item->item_name }}" data-item-price="{{$item->item_price}}" data-item-id="{{$item->item_id}}" data-item-type="{{$item->item_type}}" data-labour-expense="{{$item->labour_expense}}" data-material-expense="{{$item->material_expense}}" data-unit="{{ $item->item_units }}" ${assembly.assembly_name === '{{ $item->item_name }}' ? 'selected' : ''}>{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-2 inline-block">
                                <div>
                                    <input type="number" step="any" name="item_unit_by_ass_unit[]" id="item_unit_by_ass_unit_${index}" placeholder="00.0" autocomplete="given-name" value="${assembly.item_unit_by_ass_unit}" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <span class="m-0 p-0 text-xs float-left text-gray-400"><span class="unit">unit</span>/<span class="addedItemUnit${index}">unit</span></span>
                                </div>
                                <div>
                                    <input type="number" step="any" name="ass_unit_by_item_unit[]" id="ass_unit_by_item_unit_${index}" placeholder="00.0" autocomplete="given-name" value="${assembly.ass_unit_by_item_unit}" class="w-[70%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <button class="delete-row-btn inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                        <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                                    </button>
                                    <span class="m-0 ml-4 p-0 text-xs float-left text-gray-400"><span class="addedItemUnit${index}">unit</span>/<span class="unit">unit</span></span>
                                </div>
                            </div>
                        `);
                            $('#mulitple_input').append(newAssemblyDiv);
                        });

                        // Add event listener for delete button
                        $('.delete-row-btn').on('click', function() {
                            $(this).closest('.mt-5').remove();
                        });
                    }

                    // Apply the input event listener for item_unit_by_ass_unit inputs
                    applyInputEventListenerForAssUnit();
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });

    function applyInputEventListenerForAssUnit() {
    $('[id^="item_unit_by_ass_unit_"]').on('input', function() {
        // Initialize variables to store total expenses for labour and material items
        var totalLabourExpense = 0;
        var totalMaterialExpense = 0;

        // Iterate over each row
        $('[id^="item_unit_by_ass_unit_"]').each(function() {
            // Get the ID of the item_unit_by_ass_unit input for the current row
            var itemId = $(this).attr('id').replace('item_unit_by_ass_unit_', '');

            // Retrieve the selected option from the corresponding select element for the current row
            var selectedOption = $('#assembly_id_' + itemId + ' option:selected');

            // Retrieve data from the selected option for the current row
            var itemType = selectedOption.data('item-type');
            var labourExpense = selectedOption.data('labour-expense');
            var materialExpense = selectedOption.data('material-expense');
            var itemPrice = selectedOption.data('item-price');

            // Get the value entered in the item_unit_by_ass_unit input for the current row
            var itemUnitValue = parseFloat($(this).val());

            // Perform calculations based on item type for the current row
            if (itemType === 'labour') {
                if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
                    var calculatedValue = (itemPrice / labourExpense) / itemUnitValue;

                    // Update total labour expense for the current row
                    totalLabourExpense += calculatedValue * 1 * itemPrice;
                }else{
                $('#labour_expense').val('');
                $('#ass_unit_by_item_unit_' + itemId).val('');
            }
            } else if (itemType === 'material') {
                if (!isNaN(itemUnitValue) && itemUnitValue !== 0) {
                    var calculatedValue = (itemPrice / materialExpense) / itemUnitValue;

                    // Update total material expense for the current row
                    totalMaterialExpense += calculatedValue * 1 * itemPrice;
                }else{
                $('#material_expense').val('');
                $('#ass_unit_by_item_unit_' + itemId).val('');
            }
            }
        });

        // Set the total labour and material expenses in their respective inputs
        $('#labour_expense').val(totalLabourExpense.toFixed(2));
        $('#material_expense').val(totalMaterialExpense.toFixed(2));

        // Calculate the sum of labour expense and material expense
        var totalExpense = totalLabourExpense + totalMaterialExpense;

        // Calculate the item cost as half of the total expense
        var itemCost = totalExpense / 2;

        // Set the total expense and item cost in their respective inputs
        $('#item_price').val(totalExpense.toFixed(2));
        $('#item_cost').val(itemCost.toFixed(2));
    });
}

</script>
<script>
    $(document).ready(function() {
        // Get references to the select element and the relevant divs
        var typeDropdown = $('#type');
        var multiAddItemsDiv = $('#multiAdd-items');
        var labourExpenseDiv = $('#labourExpense');
        var materialExpenseDiv = $('#materialExpense');
        var unitItemInput = $('#item_units');
        var unitLabel = $('.unit');
        var itemCost = $('#item_cost');
        var labourCost = $('#labour_expense');
        var materialCost = $('#material_expense');
        var itemPrice = $('#item_price');
        var priceMargin = $('#price_margin')
        // Initial state on page load
        if (typeDropdown.val() === 'assemblies') {
            multiAddItemsDiv.removeClass('hidden');
            labourExpenseDiv.addClass('hidden');
        }

        // Add change event handler to the select element
        typeDropdown.on('change', function() {
            if (typeDropdown.val() === 'assemblies') {
                multiAddItemsDiv.removeClass('hidden');
                // labourExpenseDiv.addClass('hidden');
                $('#item_price').attr('readonly', true);
                $('#labour_expense').attr('readonly', true);
                $('#material_expense').attr('readonly', true);
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            } else {
                multiAddItemsDiv.addClass('hidden');
                // labourExpenseDiv.removeClass('hidden');
                $('#item_price').attr('readonly', false);
                $('#material_expense').attr('readonly', true);
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            }

            if (typeDropdown.val() === 'material') {
                $('#labour_expense').attr('readonly', true);
                // materialExpenseDiv.removeClass('hidden');
                // labourExpenseDiv.addClass('hidden');
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            } else {
                $('#labour_expense').attr('readonly', false);
                // materialExpenseDiv.addClass('hidden');
                // labourExpenseDiv.removeClass('hidden');
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            }

            if (typeDropdown.val() === 'labour') {
                unitItemInput.val('hour');
                unitLabel.text('hour');
                $('#material_expense').attr('readonly', true);
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            } else {
                unitItemInput.val(null);
                unitLabel.text('unit');
                $('#material_expense').attr('readonly', false);
                $('#labour_expense').val('');
                $('#material_expense').val('');
                $('#item_price').val('');
            }

        });

        unitItemInput.on('input', function() {
            unitLabel.text(unitItemInput.val());
        });

        labourCost.on('input', function() {
            itemCost.val(23.50 / 60 * labourCost.val());
        });

        materialCost.on('input', function() {
            itemCost.val(materialCost.val());
        });


        itemPrice.on('input', function() {
            var priceMinusCost = itemPrice.val() - itemCost.val();
            var priceMinusCostbyitemPrice = priceMinusCost / itemPrice.val();
            var finalMargin = priceMinusCostbyitemPrice * 100;
            priceMargin.text(finalMargin.toFixed(2));
        });
    });
</script>