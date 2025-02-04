@include('layouts.header')
@php
$userPrivileges = session('user_details')['user_privileges'];
@endphp
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Crew List</h4>
            </div>
            <div>
                @if (session('user_details')['user_role'] == 'admin')
                <x-add-button :id="'addCrew'" :title="'+Add Crew'" :class="''"></x-add-button>
                @elseif(isset($userPrivileges->crew) && isset($userPrivileges->crew->add) && $userPrivileges->crew->add === 'on')
                <x-add-button :id="'addCrew'" :title="'+Add Crew'" :class="''"></x-add-button>
                @endif
            </div>
        </div>
        <div class="py-4">
            <div class=" overflow-x-auto">
                <table id="universalTable" class="display" style="width:100%">
                    <thead class="bg-[#930027] text-white text-sm">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Department</th>
                            <th></th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="universalTableBody" class=" text-sm">
                        @foreach($crew as $item)
                        <tr>
                            <td><img class=" w-10 h-10 rounded-full" style="object-fit: cover;" src="{{ (isset($item->user_image) && asset_exists($item->user_image)) ? asset($item->user_image) : asset('assets/images/demo-user.svg') }}" alt="image"></td>
                            <td>{{ $item->name }} {{ $item->last_name }}</td>
                            <td>{{ $item->departement }}</td>
                            <td>
                            @php
                            $rating = $item->rating;
                            @endphp
                            <div class="rate">
                            @for ($i = 1; $i <= $rating; $i++)
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" style="color: #930027" title="1 star">1 star</label>
                            @endfor
                            </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            @if($item->sts == 'active')
                            <td>
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                            </td>
                            @elseif($item->sts == 'deleted')
                            <td>
                                <span class="bg-red-100 text-red-800 inline-flex items-center text-sm font-medium px-2 py-1 rounded-md ring-1 ring-inset ring-red-600/20 ">Deleted</span>
                            </td>
                            @endif
                            <td>
                                @if (session('user_details')['user_role'] == 'admin')
                                <button id="editCrew{{$item->id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @elseif(isset($userPrivileges->crew) && isset($userPrivileges->crew->edit) && $userPrivileges->crew->edit === 'on')
                                <button id="editCrew{{$item->id}}">
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                @endif
                                @if (session('user_details')['user_role'] == 'admin')
                                <form action="/delete/crew/{{ $item->id }}" class=" inline-block" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @elseif(isset($userPrivileges->crew) && isset($userPrivileges->crew->delete) && $userPrivileges->crew->delete === 'on')
                                <form action="/delete/crew/{{ $item->id }}" class=" inline-block" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addCrew-modal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-80"></div>
        </div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/addCrew" id="formData" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="crewId" id="crewId" value="">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content here -->
                    <div class=" flex justify-between border-b-2">
                        <h2 class=" text-xl font-semibold mb-2 " id="modal-title">Add Crew</h2>
                        <button class="modal-close" type="button">
                            <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                        </button>
                    </div>
                    <!-- task details -->
                    <div class=" text-center grid grid-cols-2 gap-2">
                        <div class=" col-span-2">
                            <h3 class=" text-lg font-medium text-left">Details</h3>
                        </div>
                        <div>
                            <label for="" class="text-gray-700 block text-left mb-1 "> First Name</label>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <label for="" class="text-gray-700 block text-left mb-1 "> Last Name</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <label for="" class="text-gray-700 block text-left mb-1 "> Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <label for="" class="text-gray-700 block text-left mb-1 "> Phone No</label>
                            <input type="tel" name="phone" id="phone" placeholder="XXX-XXX-XXXX/XXXXXXXXXX" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" title="Phone number must be in the format XXX-XXX-XXXX" required>

                            <label for="" class="text-gray-700 block text-left mb-1 "> Department</label>
                            <select id="departement" name="departement" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">Department</option>
                                @foreach($departements as $item)
                                <option value="{{ $item->departement }}">{{ $item->departement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div id="dropzone" class="dropzone" style=" width: 145px !important; height: 145px !important; padding: 0 !important;">
                                <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}" style="width: 145px; height: 100%; border-radius: 50%; object-fit: cover;" alt="text">
                                <div class="file-input-container">
                                    <input class="file-input" type="file" name="upload_image" id="fileInput1">
                                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11" alt="icon">
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="5 stars">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="4 stars">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="3 stars">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="2 stars">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="1 star">1 star</label>
                            </div>
                            <div class="mt-3">
                                <label for="" class="text-gray-700 block text-left mb-1 "> Team No</label>
                                <input type="tel" name="teamNumber" id="teamNumber" placeholder="Team No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                            <div class=" mt-2">
                                <label for="" class="text-gray-700 block text-left mb-1 ">Select Color</label>
                                <input type="color" name="user_color" id="color" value="#000000" class=" p-4 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="" class="text-gray-700 block text-left mb-1 "> Address</label>
                            <textarea name="address" id="address" placeholder="Address" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <button class=" save-btn mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">
                            <div class=" text-center hidden spinner" id="spinner">
                                <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-[#930027]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </div>
                            <div class="text" id="text">
                                Add
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $("#addCrew").click(function(e) {
        e.preventDefault();
        $("#addCrew-modal").removeClass('hidden');
    });

    $(".modal-close").click(function(e) {
        e.preventDefault();
        $("#addCrew-modal").addClass('hidden');
        $("#formData")[0].reset()
    });

    $('[id^="editCrew"]').click(function() {
        var itemId = this.id.replace('editCrew', ''); // Extract item ID from button ID

        // Make an AJAX request to get item details
        $.ajax({
            url: '/getCrewOnAction/' + itemId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    // Populate the modal with the retrieved data
                    var crewDetail = response.crew;
                    console.log(crewDetail);
                    // Update modal content with item details
                    $('#firstName').val(crewDetail.name);
                    $('#lastName').val(crewDetail.last_name);
                    $('#email').val(crewDetail.email);
                    $('input[name="rate"][value="' + crewDetail.rating + '"]').prop('checked', true);
                    $('#phone').val(crewDetail.phone);
                    $('#departement').val(crewDetail.departement);
                    $('#teamNumber').val(crewDetail.team_number);
                    $('#color').val(crewDetail.user_color);
                    $('#address').val(crewDetail.address);
                    // $('#description').val(crewDetail.expense_description);
                    // Add other fields as needed
                    // Display user image if it exists, otherwise display default image
                    if (crewDetail.user_image) {
                        $('#profileImage').attr('src', crewDetail.user_image);
                    } else {
                        $('#profileImage').attr('src', '{{ asset("assets/images/demo-user.svg") }}');
                    }

                    // Set the item ID in the hidden input field
                    $('#crewId').val(crewDetail.id);
                    var formUrl = $('#formData').attr('action', '/updateCrew');
                    // Open the modal
                    $('#addCrew-modal').removeClass('hidden');
                } else {
                    // Handle error response
                    console.error('Error fetching item details.');
                }
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
    });
</script>