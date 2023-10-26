@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Items</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Items List</h4>
            </div>
            <div>
                <x-add-button :title="'All'" :class="' bg-orange-500 px-6'"></x-add-button>
                <x-add-button :title="'Product'" :class="''"></x-add-button>
                <x-add-button :title="'Labour'" :class="''"></x-add-button>
                <x-add-button :title="'Assemblies'" :class="''"></x-add-button>
                <x-add-button :title="'Groups'" :class="''"></x-add-button>
                <x-add-button :title="'+Add Item'" :class="''"></x-add-button>
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
                        <tr>
                            <td>Living room</td>
                            <td>Interior</td>
                            <td>gal</td>
                            <td>10</td>
                            <td>25</td>
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