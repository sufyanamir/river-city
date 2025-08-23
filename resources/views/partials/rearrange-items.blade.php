@include('layouts.header')
<div class="my-4 space-y-4" id="group-sortable-container">
    @php
        $groupedItems = [];
        foreach ($estimateItems as $item) {
            // Get group name from either estimate group or global group
            $groupName = '';
            
            if ($item->estimate_group_id && $item->estimateGroup) {
                $groupName = $item->estimateGroup->group_name ?? '';
            } elseif ($item->group_id && $item->globalGroup) {
                $groupName = $item->globalGroup->group_name ?? '';
            }
            
            $groupedItems[$groupName][] = $item;
        }
    @endphp

    @foreach ($groupedItems as $groupName => $items)
        <div class="group-card bg-white rounded-lg shadow-lg" data-group="{{ $groupName }}">
            <!-- Group Name Header -->
            <div class="rounded-t-lg bg-[#930027] p-4 cursor-move">
                <h2 class="text-lg font-medium text-white">{{ $groupName }}</h2>
            </div>

            <!-- Table for Items in This Group -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-b-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="w-10 px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Item Name</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                        </tr>
                    </thead>
                    <tbody class="sortable-group">
                        @foreach ($items as $item)
                            <tr class="sortable-item border-b-2" data-id="{{ $item->estimate_item_id }}">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white cursor-move">
                                    <i class="fa-solid fa-sort"></i>
                                </th>
                                <td class="px-6 py-4">{{ $item->item_name }}</td>
                                <td class="px-6 py-4">{{ $item->item_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <div class="text-right">
        <button id="save-order" class="px-4 py-2 bg-[#930027] text-white rounded-lg">Save Order</button>
    </div>
</div>
@include('layouts.footer')

<!-- Include SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    $(document).ready(function () {
        // Sort items within each group
        $(".sortable-group").each(function () {
            new Sortable(this, {
                animation: 150,
                ghostClass: "bg-gray-200",
                handle: ".fa-sort"
            });
        });

        // Sort entire groups
        let groupSortable = new Sortable(document.getElementById("group-sortable-container"), {
            animation: 150,
            ghostClass: "bg-red-100",
            handle: ".cursor-move", // allows dragging by group header
        });

        // Save Order Button Click Event
        $("#save-order").click(function () {
            let order = [];
            let currentPosition = 1;

            // Go through each group in the order they appear
            $(".group-card").each(function () {
                // Get all item rows in this group
                $(this).find(".sortable-item").each(function () {
                    order.push({
                        id: $(this).data("id"),
                        position: currentPosition++
                    });
                });
            });

            console.log("Final Order:", order);

            // Send to server
            $.ajax({
                url: "/saveRearrangeItems",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    estimate_id: "{{ $estimate->estimate_id }}",
                    items: order
                },
                success: function (response) {
                    window.location.assign('/viewEstimate/{{ $estimate->estimate_id }}');
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Failed to save the order. Try again.");
                }
            });
        });
    });
</script>
