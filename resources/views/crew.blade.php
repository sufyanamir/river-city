@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Crew</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Crew List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Crew'"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Depratement</th>
                            <th></th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td><img class=" w-18 h-18 rounded-full" src="{{ asset('assets/images/demo-user.svg') }}" alt="image"></td>
                            <td>Client Name</td>
                            <td>Labour</td>
                            <td>
                                <label>
                                    <input type="checkbox" class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                                <label>
                                    <input type="checkbox" class="star-checkbox">
                                    <span class="star-label"></span>
                                </label>
                            </td>
                            <td>abcd@gmail.com</td>
                            <td>123 456 789</td>
                            <td>Town, City, Country</td>
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