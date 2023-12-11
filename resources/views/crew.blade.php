@include('layouts.header')
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Crew</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" flex justify-between p-3">
            <div class=" text-xl font-semibold">
                <h4>Crew List</h4>
            </div>
            <div>
                <x-add-button :id="'addCrew'" :title="'+Add Crew'" :class="''"></x-add-button>
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
                        @foreach($crew as $item)
                        <tr>
                            <td><img class=" w-10 h-10 rounded-full" style="object-fit: cover;" src="{{ (isset($item->user_image)) ? asset($item->user_image) : 'assets/images/demo-user.svg'}}" alt="image"></td>
                            <td>{{ $item->name }} {{ $item->last_name }}</td>
                            <td>{{ $item->departement }}</td>
                            <td>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <button>
                                    <img src="{{ asset('assets/icons/edit-icon.svg') }}" alt="btn">
                                </button>
                                <button>
                                    <a href="/delete/crew/{{ $item->id }}">
                                        <img src="{{ asset('assets/icons/del-icon.svg') }}" alt="btn">
                                    </a>
                                </button>
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
            <form action="/addCrew" id="addCrew-form" method="post" enctype="multipart/form-data">
                @csrf
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
                            <input type="tel" name="phone" id="phone" placeholder="Phone No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">

                            <label for="" class="text-gray-700 block text-left mb-1 "> Departement</label>
                            <select id="departement" name="departement" autocomplete="customer-name" class=" p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                                <option value="">Departement</option>
                                @foreach($departements as $item)
                                <option value="{{ $item->departement }}">{{ $item->departement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div id="dropzone" class="dropzone" style=" width: 145px !important; height: 145px !important;">
                                <img id="profileImage" src="{{ asset('assets/images/demo-user.svg') }}" style="width: 145px; height: 145px; border-radius: 50%; object-fit: cover;" alt="text">
                                <div class="file-input-container">
                                    <input class="file-input" type="file" name="upload_image" id="fileInput1">
                                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                                        <img src="{{ asset('assets/icons/edit-icon.svg') }}" class=" w-11" alt="icon">
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                            <div>
                                <br>
                            <label for="" class="text-gray-700 block text-left mb-1 "> Team No</label>
                                <input type="tel" name="teamNumber" id="teamNumber" placeholder="Team No." autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            </div>
                        </div>
                        <div class=" col-span-2 my-2">
                            <label for="" class="text-gray-700 block text-left mb-1 "> Address</label>
                            <textarea name="address" id="address" placeholder="Address" class=" w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <button id="updateEvent" class=" mb-2 float-right bg-[#930027] text-white py-1 px-7 rounded-md hover:bg-red-900 ">Add
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
        $("#addCrew-form")[0].reset()
    });
</script>
