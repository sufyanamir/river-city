@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">User Roles</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Roles List</h4>
            </div>
            <div>
                <x-add-button :title="'+Add Role'"  :id="''" :class="''"></x-add-button>
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="example" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Departement</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm">
                        <tr>
                            <td><img class=" w-18 h-18 rounded-full" src="{{ asset('assets/images/demo-user.svg') }}" alt="image"></td>
                            <td>Client Name</td>
                            <td>John</td>
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