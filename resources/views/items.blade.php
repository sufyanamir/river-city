@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Items</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Items List</h4>
            </div>
            <div class=" flex gap-5">
                <x-add-button :id="''" :title="'All'" :class="' bg-[#E02B20] px-6'"></x-add-button>
                <x-add-button :id="''" :title="'Product'" :class="''"></x-add-button>
                <x-add-button :id="''" :title="'Labour'" :class="''"></x-add-button>
                <x-add-button :id="''" :title="'Assemblies'" :class="''"></x-add-button>
                <x-add-button :id="''" :title="'Groups'" :class="''"></x-add-button>
                <x-add-button :id="'addItem'" :title="'+Add Item'" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>Units</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->item_type }}</td>
                            <td>{{ $item->item_units }}</td>
                            <td>{{ $item->item_cost }}</td>
                            <td>{{ $item->item_price }}</td>
                            <td>{{ $item->item_address }}</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <a href="/delete/item/{{ $item->item_id }}">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </a>
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
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addItem-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addItem" method="post" enctype="multipart/form-data" id="addItem-form">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Items</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2 my-2">
                            <input type="text" name="item_name" id="itemName" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2">
                            <select id="type" name="item_type" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option disabled>type</option>
                                <option value="services">Services</option>
                                <option value="product">Product</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class="my-2">
                            <select id="item_units" name="item_units" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option disabled>Units</option>
                                <option value="hour">Hour</option>
                                <option value="gal">Gal</option>
                                <option value="assemblies">Assemblies</option>
                            </select>
                        </div>
                        <div class="my-2 text-left">
                            <label for="" class=" block">Cost:</label>
                            <input type="number" name="item_cost" id="item_cost" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2 text-left">
                            <label for="" class=" block">Price:</label>
                            <input type="number" name="item_price" id="item_price" placeholder="00.0" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class="my-2 col-span-2" id="labourExpense">
                            <input type="number" name="labour_expense" id="labourExpense" placeholder="Labour Expense" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                        </div>
                        <div class=" my-2 col-span-2 hidden" id="multiAdd-items">
                            <div id="mulitple_input">
                                <input type="text" name="assembly_name[]" id="itemName" placeholder="Item Name" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div class=" text-right mt-2">
                                <button type="button" class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]" id="addbtn" aria-expanded="true" aria-haspopup="true">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="my-2 col-span-2">
                            <textarea name="item_description" id="" placeholder="Description" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
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
<script></script>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        // Get references to the select element and the relevant divs
        var typeDropdown = $('#type');
        var multiAddItemsDiv = $('#multiAdd-items');
        var labourExpenseDiv = $('#labourExpense');

        // Initial state on page load
        if (typeDropdown.val() === 'assemblies') {
            multiAddItemsDiv.removeClass('hidden');
            labourExpenseDiv.addClass('hidden');
        }

        // Add change event handler to the select element
        typeDropdown.on('change', function() {
            if (typeDropdown.val() === 'assemblies') {
                multiAddItemsDiv.removeClass('hidden');
                labourExpenseDiv.addClass('hidden');
            } else {
                multiAddItemsDiv.addClass('hidden');
                labourExpenseDiv.removeClass('hidden');
            }
        });
    });
</script>
<script>
    $("#addItem").click(function(e) {
        e.preventDefault();
        $("#addItem-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addItem-modal").addClass('hidden');
        $("#addItem-form")[0].reset()
    });

    let mulitple_input = document.getElementById('mulitple_input');
    let button = document.getElementById('addbtn');
    button.addEventListener('click', () => {
        let newele = document.createElement('div');
        let rembtn = document.createElement('span');
        newele.classList.add('mt-5')
        newele.innerHTML =
            `<input type="text" name="items_name[]" id="itemName" placeholder="Item Name"
autocomplete="given-name"
class=" w-[92%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">`
        rembtn.innerHTML = `<button type="button"
class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] ml-1 px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]"
id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
<img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
</button>`
        mulitple_input.append(newele);
        newele.append(rembtn);
        rembtn.addEventListener('click', () => {
            newele.remove();
        })

    })
</script>