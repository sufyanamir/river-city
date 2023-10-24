@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Campaign</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Campaign List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Campaign'"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>No. emails</th>
                            <th>Campaign</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td>Sep 23, 2023</td>
                            <td>Email Name</td>
                            <td>Town, City, CountryTown, City, Country</td>
                            <td>Plain Text</td>
                            <td>5</td>
                            <td>
                            <span class="inline-flex items-center rounded-md bg-[#F5AE50] px-2 py-1 text-sm font-medium  ring-inset">Automatic</span>
                            </td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <img src="{{ asset('assets/icons/view-icon.svg') }}" alt="btn">
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