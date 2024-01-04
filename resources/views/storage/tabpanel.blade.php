<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>
        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-screen-md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content here -->
                <div class=" text-right">
                    <button class="modal-close" type="button">
                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                    </button>
                </div>
                <div class="">
                    <div class=" " id="">
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="items-tab"
                                data-tabs-toggle="#items-tab-content" role="tablist">
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="all-tab" data-tabs-target="#all" type="button" role="tab"
                                        aria-controls="all" aria-selected="false">all</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="labour-tab" data-tabs-target="#labour" type="button" role="tab"
                                        aria-controls="labour" aria-selected="false">labour</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="material-tab" data-tabs-target="#material" type="button"
                                        role="tab" aria-controls="material"
                                        aria-selected="false">material</button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="assemblies-tab" data-tabs-target="#assemblies" type="button"
                                        role="tab" aria-controls="assemblies"
                                        aria-selected="false">assemblies</button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#930027] hover:border-[#930027] dark:hover:text-[#930027]"
                                        id="addItem-tab" data-tabs-target="#addItem" type="button"
                                        role="tab" aria-controls="addItem" aria-selected="false">Add
                                        Item</button>
                                </li>
                            </ul>
                        </div>
                        <div id="items-tab-content">
                            {{-- <div class=" my-2">
                                <input type="text" name="search" id="search" placeholder="Search"
                                    autocomplete="given-name"
                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div> --}}
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="all"
                                role="tabpanel" aria-labelledby="all-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="labour"
                                role="tabpanel" aria-labelledby="labour-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($labour_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="material"
                                role="tabpanel" aria-labelledby="material-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($material_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="assemblies"
                                role="tabpanel" aria-labelledby="assemblies-tab">
                                <div class="relative overflow-x-auto w-full h-60 overflow-y-auto my-2">
                                    @csrf
                                    <input type="hidden" value="{{ $estimate->estimate_id }}"
                                        name="estimate_id" id="estimate_id">
                                    <table class="w-full text-sm text-left universalTable">
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
                                                <th scope="col" class="px-6 py-3">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assembly_items as $item)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $item->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_type }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->item_units }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_cost }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        ${{ $item->item_price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <input type="checkbox" name="selected_items[]"
                                                            id="selected_items{{ $item->item_id }}"
                                                            value="{{ $item->item_id }}">
                                                        <label for="selected_items{{ $item->item_id }}"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="addItem"
                                role="tabpanel" aria-labelledby="addItem-tab">
                                <form action="/addItemInEstimateAndItems" method="post"
                                    enctype="multipart/form-data" id="">
                                    @csrf
                                    <input type="hidden" name="estimate_id"
                                        value="{{ $estimate->estimate_id }}">
                                    <div class="">
                                        <!-- Modal content here -->
                                        <div class=" flex justify-between">
                                            <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Items</h2>
                                        </div>
                                        <!-- task details -->
                                        <div class=" text-center grid grid-cols-2 gap-2">
                                            <div class="  col-span-2 my-2">
                                                <label for="" class="block text-left mb-1"> Items
                                                    Type</label>
                                                <select id="type" name="item_type"
                                                    autocomplete="customer-name"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                    <option>type</option>
                                                    <option value="labour">labour</option>
                                                    <option value="material">Material</option>
                                                </select>
                                            </div>
                                            <div class=" my-2">
                                                <label for="" class="block  text-left mb-1"> Item
                                                    Name</label>
                                                <input type="text" name="item_name" id="itemName"
                                                    placeholder="Item Name" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2">
                                                <label for="" class="block text-left mb-1"> Item
                                                    Unit</label>
                                                <select id="item_units" name="item_units"
                                                    autocomplete="customer-name"
                                                    class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                                    <option>Units</option>
                                                    <option value="hour">Hour</option>
                                                    <option value="gal">Gal</option>
                                                </select>
                                            </div>
                                            <div class="my-2 text-left">
                                                <label for="" class=" block text-left mb-1">Cost:</label>
                                                <input type="number" name="item_cost" id="item_cost"
                                                    placeholder="00.0" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2 text-left">
                                                <label for="" class=" block text-left mb-1">Price:</label>
                                                <input type="number" name="item_price" id="item_price"
                                                    placeholder="00.0" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class="my-2 col-span-2" id="labourExpense">
                                                <label for="" class="block text-left mb-1"> Labour
                                                    Expense</label>
                                                <input type="number" name="labour_expense" id="labourExpense"
                                                    placeholder="Labour Expense" autocomplete="given-name"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                            </div>
                                            <div class=" my-2 col-span-2 hidden" id="multiAdd-items">
                                                <div id="mulitple_input">
                                                    <label for="" class="block text-left mb-1"> Assembly
                                                        Name </label>
                                                    <select name="assembly_name[]" id=""
                                                        placeholder="Item Name" autocomplete="given-name"
                                                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                                        <option value="">Select Item</option>

                                                    </select>
                                                </div>
                                                <div class=" text-right mt-2">
                                                    <button type="button"
                                                        class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                                                        id="addbtn" aria-expanded="true" aria-haspopup="true">
                                                        <img src="{{ asset('assets/icons/plus-icon.svg') }}"
                                                            alt="icon">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="my-2 col-span-2 relative">
                                                <label for="" class="block text-left mb-1"> Item Description
                                                </label>
                                                <textarea name="item_description" id="item_description" placeholder="Description"
                                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                                                <button type="button" id="items-mic"
                                                    class=" absolute mt-8 right-4"
                                                    onclick="voice('items-mic', 'item_description')"><i
                                                        class="speak-icon fa-solid fa-microphone text-gray-400"></i></button>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button id="updateEvent"
                                                class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <form action="/addEstimateItems" method="post" id="formData">
                                    @csrf
                                    <input type="hidden" name="estimate_id"
                                        value="{{ $estimate->estimate_id }}">
                                    <div id="selectedItemsContainer" class="mt-4">
                                        <!-- Badges will be dynamically added here -->

                                    </div>
                                    <div class=" flex justify-between pt-2 border-t">
                                        <button type="button" class=" mb-2 py-1 px-7 rounded-md border ">Cancel
                                        </button>
                                        <button
                                            class=" mb-2 bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Function to create a badge element
        function createBadge(item) {
            var badge = $('<span/>', {
                id: 'badge-' + item.item_id,
                class: 'inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-gray-800 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-300',
                text: item.item_name
            });

            // Add hidden input for item ID
            var hiddenInput = $('<input/>', {
                type: 'hidden',
                name: 'selected_items[]',
                value: item.item_id
            });

            badge.append(hiddenInput);

            // Add the cross button to remove the badge
            var closeButton = $('<button/>', {
                type: 'button',
                class: 'inline-flex items-center p-1 ms-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300',
                'data-dismiss-target': 'badge-' + item.item_id,
                'aria-label': 'Remove'
            });

            // Replace the SVG code with the img tag
            var closeIcon = $('<img/>', {
                src: '{{ asset('assets/icons/close-icon.svg') }}',
                alt: 'Remove badge',
                class: 'w-2 h-2'
            });

            // Append elements to the badge and add to the container
            closeButton.append(closeIcon);
            badge.append(closeButton);
            $('#selectedItemsContainer').append(badge);

            // Add event listener to the cross button for badge removal
            closeButton.on('click', function() {
                var badgeId = closeButton.attr('data-dismiss-target');
                var checkboxId = badgeId.replace('badge-', 'selected_items');
                var checkbox = $('#' + checkboxId);

                // Uncheck the corresponding checkbox
                if (checkbox.length) {
                    checkbox.prop('checked', false);
                }

                // Remove the badge
                badge.remove();
            });
        }

        // Function to update the selected items badges
        function updateSelectedItems() {
            $('#selectedItemsContainer').empty(); // Clear previous badges

            $('input[name="selected_items[]"]:checked').each(function() {
                var checkboxValue = $(this).val();
                var item = {};

                // Find the corresponding table row and extract data
                var tableRow = $(this).closest('tr');
                item.item_id = checkboxValue;
                item.item_name = tableRow.find('td:eq(0)')
            .text(); // Assuming the item name is in the first column

                if (item.item_name.trim() !== '') {
                    createBadge(item);
                }
            });
        }

        // Get all checkboxes
        var checkboxes = $('input[name="selected_items[]"]');

        // Add event listener to each checkbox
        checkboxes.on('change', function() {
            updateSelectedItems();
        });

        // Sample data for items (replace with your actual items data)
        var items = [{
                item_id: 1,
                item_name: 'Construction Material A'
            },
            {
                item_id: 2,
                item_name: 'Labor Service B'
            },
            {
                item_id: 3,
                item_name: 'Assembly C'
            },
            {
                item_id: 4,
                item_name: 'Equipment D'
            },
            // Add more items as needed
        ];

        // Initial badge rendering
        updateSelectedItems();
    });
</script>
<script>
    $(document).ready(function() {
        // Initially hide the form

        $("button[role='tab']").click(function() {
            // Check if the clicked tab is not the "Add Item" tab
            if ($(this).attr("id") !== "addItem-tab") {
                // Show the form
                $("#formData").show();
            } else {
                // Hide the form
                $("#formData").hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Set the "all" tab as the default tab
        let activeTab = $("#all");
        activeTab.removeClass("hidden").addClass("active");

        // Add click event listeners to tab buttons
        $("[role='tab']").click(function() {
            // Hide all tab contents
            $("[role='tabpanel']").addClass("hidden");

            // Remove the 'active' class from all tab buttons
            $("[role='tab']").removeClass("active");

            // Get the target tab content and display it
            const targetId = $(this).attr("aria-controls");
            activeTab = $("#" + targetId);
            activeTab.removeClass("hidden").addClass("active");

            // Set the 'active' class for the clicked tab button
            $(this).addClass("active");
        });
    });
</script>