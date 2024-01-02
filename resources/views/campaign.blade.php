@include('layouts.header')
@php
    $userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Campaign List</h4>
            </div>
            <div>
                @if (session('user_details')['user_role'] == 'admin')
                    <x-add-button :id="'addCampaign'" :title="'+Add Campaign'" :class="''"></x-add-button>
                @elseif(isset($userPrivileges->campaign) && isset($userPrivileges->campaign->add) && $userPrivileges->campaign->add === 'on')
                    <x-add-button :id="'addCampaign'" :title="'+Add Campaign'" :class="''"></x-add-button>
                @endif
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
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
                                <span
                                    class="inline-flex items-center rounded-md bg-[#F5AE5080] px-2 py-1 text-sm font-medium  ring-inset">Automatic</span>
                            </td>
                            <td>
                                <button id="followUp-btn">
                                    <img src="{{ asset('assets/icons/check-icon.svg') }}" alt="btn">
                                </button>
                                @if (session('user_details')['user_role'] == 'admin')
                                    <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->campaign) && isset($userPrivileges->campaign->edit) && $userPrivileges->campaign->edit === 'on')
                                    <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                                @if (session('user_details')['user_role'] == 'admin')
                                    <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->campaign) && isset($userPrivileges->campaign->delete) && $userPrivileges->campaign->delete === 'on')
                                    <button>
                                    <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addCampaign-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="addCampaign-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Start Campaign</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2 flex justify-between gap-2 my-2">
                            <label for="" class=" font-medium">Customer</label>
                            <select id="customer" name="customer" autocomplete="customer-name"
                                class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option>type</option>
                                <option>Services</option>
                                <option>Product</option>
                                <option>Assemblies</option>
                            </select>
                        </div>
                        <div class=" col-span-2 text-left">
                            <input type="radio" name="campaignType" id="manualCampaign"> <label for="manualCampaign"
                                class=" text-justify"><span class=" font-medium">Manual</span> - Use Start Campaign
                                button on the project screen to start this campaign (Recommended)</label>
                        </div>
                        <div class=" col-span-2 text-left">
                            <input type="radio" name="campaignType" id="automaticCampaign"> <label
                                for="automaticCampaign" class=" text-justify"><span
                                    class=" font-medium">Automatic</span> - Campaign automatically starts as soon as a
                                project's state becomes Pending - Pending Acceptance</label>
                        </div>

                        <div id="multiple_inputs" class=" col-span-2">
                            <div class=" text-left grid grid-cols-2 gap-1 my-2" style="width:100%">
                                <div>
                                    <label for="mailNote" class=" font-medium">Send Email</label>
                                    <input type="text" name="mailNote" id="mailNote" placeholder="Note"
                                        autocomplete="given-name"
                                        class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                </div>
                                <div>
                                    <label for="afterDays" class=" font-medium">After # Days</label>
                                    <select id="afterDays" name="afterDays" autocomplete="customer-name"
                                        class=" p-2 w-full outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                        <option>Select Days</option>
                                        <option>2</option>
                                        <option>5</option>
                                        <option>7</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" text-right mt-1 mb-5 mr-1">
                        <button id="addbtn" type="button"
                            class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                            id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                            <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                <div class="">
                    <button id="updateEvent"
                        class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Save
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="followUp-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="" id="followUp-form">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Follow Up</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2 text-left">
                            <input type="radio" name="campaignType" id="manualCampaign"> <label
                                for="manualCampaign" class=" text-justify"><span class=" font-medium">Manual</span> -
                                Use Start Campaign button on the project screen to start this campaign
                                (Recommended)</label>
                        </div>
                        <div class=" col-span-2 text-left">
                            <input type="radio" name="campaignType" id="automaticCampaign"> <label
                                for="automaticCampaign" class=" text-justify"><span
                                    class=" font-medium">Automatic</span> - Campaign automatically starts as soon as a
                                project's state becomes Pending - Pending Acceptance</label>
                        </div>
                        <div class=" col-span-2 text-left grid grid-cols-2 gap-1 my-2">
                            <div>
                                <label for="mailNote" class=" font-medium">Send Email</label>
                                <input type="text" name="mailNote" id="mailNote" placeholder="Note"
                                    autocomplete="given-name"
                                    class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div>
                                <label for="afterDays" class=" font-medium">After # Days</label>
                                <select id="afterDays" name="afterDays" autocomplete="customer-name"
                                    class=" p-2 w-[82%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                    <option>Select Days</option>
                                    <option>2</option>
                                    <option>5</option>
                                    <option>7</option>
                                </select>
                                <button type="button"
                                    class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]"
                                    id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                    <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}"
                                        alt="icon">
                                </button>
                                <div class=" text-right mt-2 mr-1">
                                    <button type="button"
                                        class=" gap-x-1.5 rounded-lg bg-[#930027] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]"
                                        id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
                                        <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="icon">
                                    </button>
                                </div>
                            </div>
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
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addCampaign").click(function(e) {
        e.preventDefault();
        $("#addCampaign-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addCampaign-modal").addClass('hidden');
        $("#addCampaign-form")[0].reset()
    });
    $("#followUp-btn").click(function(e) {
        e.preventDefault();
        $("#followUp-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#followUp-modal").addClass('hidden');
        $("#followUp-form")[0].reset()
    });
    let output = document.getElementById("multiple_inputs");
    let addbtn = document.getElementById("addbtn");

    function removeele(e) {
        let ele = document.querySelector(e);
        if (ele) {
            ele.remove();
        }
    }
    addbtn.addEventListener("click", () => {
        let id = Math.floor(Math.random() * 999 + 1);

        let newele = document.createElement("div");
        newele.id = "eleremove" + id;
        newele.innerHTML = `   <div class=" text-left grid grid-cols-2 gap-1 my-2" style="width:100%">
    <div>
        <label for="mailNote" class=" font-medium">Send Email</label>
        <input type="text" name="mailNote" id="mailNote" placeholder="Note" autocomplete="given-name" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
    </div>
    <div>
        <label for="afterDays" class=" font-medium">After # Days</label>
        <select id="afterDays" name="afterDays" autocomplete="customer-name" class=" p-2 w-[82%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
            <option>Select Days</option>
            <option>2</option>
            <option>5</option>
            <option>7</option>
        </select>
        <button onclick="removeele('#eleremove${id}')" type="button" class="inline-flex justify-center border gap-x-1.5 rounded-lg bg-[#DADADA80] px-2 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#DADADA80]" id="topbar-menubutton" aria-expanded="true" aria-haspopup="true">
            <img class="" src="{{ asset('assets/icons/bin-icon.svg') }}" alt="icon">
        </button>
    </div>
    </div>`;
        output.append(newele);
    });
</script>