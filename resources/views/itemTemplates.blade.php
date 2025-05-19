@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Item Templates List</h4>
            </div>
            <div class=" flex gap-5">
                @if (session('user_details')['user_role'] == 'admin')
                <x-add-button :id="'addItem'" :title="'+Add Item Template'" :class="''"></x-add-button>
                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->add) && $userPrivileges->item->add === 'on')
                <x-add-button :id="'addItem'" :title="'+Add Item Template'" :class="''"></x-add-button>
                @endif
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Order</th>
                            <th style="width: 90% !important;">Template Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach ($item_templates as $item)
                        <tr>
                            <td><input type="number" name="template_order" id="template_order" oninput="updateTemplateOrder({{$item->item_template_id}}, this.value)" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" value="{{ $item->template_order }}"></td>
                            <td class=" text-justify">
                                <p class=" font-medium">
                                    {{ $item->item_template_name }}
                                </p>
                                <p>Description:</p>
                                {{ $item->description }}
                                <p>Note:</p>
                                {{ $item->note }}
                            </td>
                            <td>
                                @if (session('user_details')['user_role'] == 'admin')
                                <button id="editTemplate{{$item->item_template_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->edit) && $userPrivileges->item->edit === 'on')
                                <button id="editTemplate{{$item->item_template_id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                                @if (session('user_details')['user_role'] == 'admin')
                                <form action="/deleteTemplate/{{$item->item_template_id}}" class=" inline-block" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @elseif(isset($userPrivileges->item) && isset($userPrivileges->item->delete) && $userPrivileges->item->delete === 'on')
                                <form action="/deleteTemplate/{{$item->item_template_id}}" class=" inline-block" method="post">
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
            <form action="/addItemTemplate" method="post" enctype="multipart/form-data" id="formData">
                @csrf
                <input type="hidden" name="template_id" id="template_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Item Templates</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" my-2 col-span-2">
                            <label for="" class="block  text-left mb-1"> Template Name</label>
                            <input type="text" name="item_template_name" id="item_template_name" placeholder="Template Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2 col-span-2" id="multiAdd-items">
                            <!-- <div class="grid grid-cols-2 gap-2" id="singleTemplateItem">
                                <input type="hidden" name="it_item_id" id="it_item_id">
                                <div>
                                    <label for="" class="block text-left mb-1"> Assembly Name </label>
                                    <select name="item_id[]" id="template_item_id" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <option value="">Select Item</option>
                                        @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}" data-unit="{{ $item->item_units }}">
                                            {{ $item->item_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="" class="block text-left mb-1"> Quantity(optional) </label>
                                    <input type="number" step="any" name="item_qty[]" id="item_qty" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                            </div> -->
                            <div id="mulitple_input">
                            </div>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="addbtn" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class=" col-span-2 relative">
                            <label for="" class="block text-left mb-1"> Description </label>
                            <textarea name="description" id="description" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="desc-mic" class=" absolute mt-8 right-4" onclick="voice('desc-mic', 'description')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                        <div class=" col-span-2 relative">
                            <label for="" class="block text-left mb-1"> Note </label>
                            <textarea name="note" id="note" placeholder="Note" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                            <button type="button" id="note-mic" class=" absolute mt-8 right-4" onclick="voice('note-mic', 'note')"><i class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                        </div>
                    </div>
                    <div class="mt-2">
                    <button type="button" class=" modalClose-btn border border-black  font-semibold py-1 px-7 rounded-lg modal-close">Cancel</button>
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

        // Reset form fields
        $('#item_template_name').val('');
        $('#note').val('');
        $('#description').val('');
        $('#mulitple_input').empty(); // Clear dynamically added elements
        $('#template_id').val('');
        $('#singleTemplateItem').removeClass('hidden');
        $('#template_item_id').attr('name', 'item_id[]');
        $('#item_qty').attr('name', 'item_qty[]');
        $('#formData').attr('action', '/addItemTemplate');

        // Reset form to its initial state
        $('#formData')[0].reset();
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
        let newele = $('<div class="mt-5" id="renid' + id + '"></div>');
        let rembtn = $('<span></span>');
        newele.html(`
        <div class="grid grid-cols-2 gap-2">
                                    <div>
                                    <i class="fa-solid fa-sort"></i>
                                    <div class="inline-block w-[90%]">
                                    <label for="" class="block text-left mb-1"> Assembly Name </label>
                                    <select name="item_id[]" id="select2-${id}" placeholder="Item Name"
                                        autocomplete="given-name"
                                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                        <option value="">Select Item</option>
                                        @foreach ($items as $item)
                                    <option value="{{ $item->item_id }}" data-unit="{{ $item->item_units }}">{{ $item->item_name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                    </div>
                                    <div>
                                        <div class=d-flex>
                                            <label for="" class="block text-left mb-1"> Quantity(optional) </label>
                                        <input type="number" step="any" name="item_qty[]" id="item_qty"
                                                placeholder="00.0" autocomplete="given-name"
                                                class=" w-[70%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">.
                                            <button onclick="remitems('#renid${id}')"  type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                                <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
                                                </button>
                                                </div>
                                                </div>
                                                </div>
        `);

        mulitple_input.append(newele);
        newele.append(rembtn);
        $(`#select2-${id}`).select2({
        placeholder: "Select an option",
        allowClear: true
    });

    });

    function remitems(e) {
        let ele = document.querySelector(e);
        if (ele) {
            ele.remove();
        }
    }
</script>
<script>
    $('[id^="editTemplate"]').click(function() {
        var itemId = this.id.replace('editTemplate', '');
        $.ajax({
            url: '/getTemplateToEdit/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var itemTemplate = response.data.itemTemplate;
                    var itemTemplateItems = response.data.itemTemplate.template_items;
                    var itemsData = response.data.itemsData;

                    // Populate template name, note, and description fields
                    $('#item_template_name').val(itemTemplate.item_template_name);
                    $('#note').val(itemTemplate.note);
                    $('#description').val(itemTemplate.description);

                    // Populate template items
                    $('#mulitple_input').empty(); // Clear existing items
                    $.each(itemTemplateItems, function(index, item) {
                        var newItemDiv = $('<div class="mt-5"></div>');
                        newItemDiv.html(`
                        <div class="grid grid-cols-2 gap-2">
                            <input type="hidden" name="it_item_id[]" value="${item.it_item_id}">
                            <div>
                            <i class="fa-solid fa-sort"></i>
                            <div class="inline-block w-[90%]">
                            <label for="" class="block text-left mb-1"> Assembly Name </label>
                            <select name="item_id[]" id="" placeholder="Item Name" autocomplete="given-name" class="w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></select>
                            </div>
                            </div>
                            <div>
                                <div class=d-flex>
                                    <label for="" class="block text-left mb-1"> Quantity(optional) </label>
                                    <input type="number" step="any" name="item_qty[]" placeholder="00.0" autocomplete="given-name" class="w-[70%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                    <button onclick="remitems(this)" type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" aria-expanded="true" aria-haspopup="true">
    <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
</button>
                                </div>
                            </div>
                        </div>
                    `
                        );

                        // Initialize select2
                        newItemDiv.find('select').select2({
                            placeholder: "Select an option",
                            // allowClear: true
                            width: '100%',
                        }
                );

                        // Populate select options
                        var select = newItemDiv.find('select');
                        $.each(itemsData, function(index, data) {
                            var option = $('<option></option>').attr('value', data.item_id).text(data.item_name);
                            select.append(option);
                        });

                        // Set selected option
                        select.val(item.item_id);

                        // Populate quantity input
                        newItemDiv.find('input[name="item_qty[]"]').val(item.item_qty); // Ensure 'quantity' property exists in item object
                        $('#mulitple_input').append(newItemDiv);
                    });

                    // Set action attribute of form
                    $('#formData').attr('action', '/updateItemTemplate');

                    // Set template_id value
                    $('#template_id').val(itemTemplate.item_template_id);

                    // Hide singleTemplateItem if needed
                    $('#singleTemplateItem').addClass('hidden');
                    $('#template_item_id').attr('name', '');
                    $('#item_qty').attr('name', '');


                    // Show modal
                    $('#addItem-modal').removeClass('hidden');
                }
            },

            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });

    function remitems(button) {
        $(button).closest('.mt-5').remove(); // Remove the closest parent div with class mt-5
    }
</script>
<script>
    $(document).ready(function() {
        // Initialize sortable on the container of dynamically added rows
        $("#mulitple_input").sortable({
            // Set the axis option to 'y' to restrict dragging to the vertical axis only
            axis: 'y',
            // Set the cursor option to 'move' to indicate dragging
            cursor: 'move',
            // Update the order when a row is dragged and dropped
            update: function(event, ui) {
                // Get the new order of the rows
                var newOrder = $(this).sortable("toArray");

                // You can now perform further actions with the new order if needed
                console.log(newOrder);
            }
        });
    });
    
    function updateTemplateOrder(templateId, newOrder) {
        $.ajax({
            url: '/updateTemplateOrder',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                template_id: templateId,
                template_order: newOrder
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    }
</script>