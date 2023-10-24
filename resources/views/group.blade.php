@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Groups</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Group List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Group'"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Item Name</th>
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

@include('layouts.footer')