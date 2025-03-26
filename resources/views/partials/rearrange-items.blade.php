@include('layouts.header')
<div class="my-4">
    <div class="bg-white w-full rounded-lg shadow-lg">
        <div class="rounded-t-lg bg-[#930027] grid sm:grid-cols-12">
            <div class="col-span-6 flex justify-between p-4">
                <h2 class="my-auto pr-3 font-medium text-white">Rearrange Items</h2>
            </div>
        </div>
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="w-10 px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Item name</th>
                            <th scope="col" class="px-6 py-3">Group Name</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-container">
                        @php $previousGroup = null; @endphp

                        @foreach ($estimateItems as $item)
                        @if ($previousGroup !== null && $previousGroup !== $item->group->group_name)
                        <tr>
                            <td colspan="4" class="border-t-2 border-gray-300"></td>
                        </tr>
                        @endif

                        <tr class="sortable-item" data-id="{{ $item->estimate_item_id }}">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white cursor-move">
                                <i class="fa-solid fa-sort"></i>
                            </th>
                            <td class="px-6 py-4">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 font-bold">{{ $item->group->group_name }}</td>
                            <td class="px-6 py-4">{{ $item->item_price }}</td>
                        </tr>

                        @php $previousGroup = $item->group->group_name; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 text-right">
                <button id="save-order" class="px-4 py-2 bg-[#930027] text-white rounded-lg">Save Order</button>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<!-- Include SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize SortableJS
        let sortable = new Sortable(document.getElementById("sortable-container"), {
            animation: 150,
            ghostClass: "bg-gray-200",
            handle: ".fa-sort", // Drag handle
        });

        // Save Order Button Click Event
        $("#save-order").click(function() {
            let order = [];
            $(".sortable-item").each(function(index) {
                order.push({
                    id: $(this).data("id"),
                    position: index + 1
                });
            });

            console.log(order);

            // AJAX request to save new order
            $.ajax({
                url: "/saveRearrangeItems",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    estimate_id: "{{ $estimate->estimate_id }}",
                    items: order
                },
                success: function(response) {
                    window.location.assign('/viewEstimate/{{ $estimate->estimate_id }}');
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Failed to save the order. Try again.");
                }
            });
        });
    });
</script>