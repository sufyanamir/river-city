@include('layouts.header')
<div class="my-2">
    <h1 class=" text-2xl font-semibold">Dashboard</h1>
    <div class=" flex justify-start gap-2 my-5">
        <div class="pt-3"><img src="{{ asset('assets/icons/borderbar.svg') }}" alt="img"></div>
        <div class=" text-gray-400">
            <p>Today</p>
        </div>
        <div class="font-semibold">
            <p> 23, December 2023</p>
        </div>
    </div>
    <div>
        <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-3">
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
        </div>
    </div>
    <div class=" flex justify-between">
        <!-- order summary & schedules -->

        <div class=" bg-white w-full m-3 rounded-xl">
            <div class=" p-2 border-b-2">
                <h3 class=" text-xl font-smibold">Orders Summary</h3>
            </div>
            <div class=" flex justify-evenly">
                <div class=" p-2">
                    <canvas id="myDoughnutChart1"></canvas>
                </div>
                <div class=" p-2 my-auto text-center">
                    <div class=" my-2">
                        <h2 class=" text-2xl font-semibold">$456,005.56</h2>
                        <p class=" text-sm text-gray-300">from $500,000.00</p>
                    </div>
                    <div class=" my-2">
                        <p class=" text-sm text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                    </div>
                    <div class=" mt-7">
                        <button class=" text-[#FF8356] bg-[#FFE0AE] p-4 rounded-full">See More</button>
                    </div>
                </div>
                <div class=" p-2 my-full">
                    <div class=" border my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">25</h3>
                        <p class=" text-[#2A2B43] text-sm">Approved</p>
                    </div>
                    <div class=" border my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">25</h3>
                        <p class=" text-[#2A2B43] text-sm">Approved</p>
                    </div>
                    <div class=" border my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">25</h3>
                        <p class=" text-[#2A2B43] text-sm">Approved</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- order summary & schedules -->
        <!-- orders chart & to do list -->
        <div class=" bg-[#930027] m-3 rounded-2xl w-auto">
            <div class=" border-b-2 p-2 text-white">
                <h3 class=" text-lg font-medium">Orders</h3>
            </div>
            <div class=" m-2 text-white">
                <canvas id="myDoughnutChart"></canvas>
            </div>
        </div>
        <!-- orders chart & to do list -->
    </div>
    <div class=" flex justify-between">
        <div class=" bg-white w-full m-3 rounded-xl">
            <div class=" p-2">
                <div class=" flex justify-between gap-10">
                    <h3 class=" text-lg font-medium">Schedules</h3>
                    <input type="text" name="search" id="search" placeholder="Search" autocomplete="given-name" class=" mb-2 w-[100%] outline-none rounded-md border-0 text-gray-400 p-2 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                </div>
                <div class="relative overflow-x-auto h-60 overflow-y-auto my-2">
                    <table class="w-full text-sm text-left ">
                        <thead class="text-xs text-white uppercase bg-[#930027]">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Name/Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Schedular/Number
                                </th>
                            </tr>
                        </thead>
                        <tbody class=" text-center">
                            <tr>
                                <td>09- 07- 2023</td>
                                <td>
                                    <h3 class=" text-lg font-medium">Coyne Development</h3>
                                    <p class=" text-[#198CF6]">+922131231123</p>
                                </td>
                                <td>
                                    <p class=" text-[#323C47]">65 Water St, Newburyport, MA, 01950</p>
                                </td>
                                <td>
                                    <h3 class=" text-lg font-medium">Scheduler name</h3>
                                    <p class=" text-[#198CF6]">+922131231123</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class=" bg-white w-full m-3 rounded-xl">
            <div class=" border-b-2 p-2">
                <h3 class=" text-lg font-medium">To do List</h3>
            </div>
            <div>
                <div class=" p-2">
                    <form action="">
                        <div class=" flex justify-between">
                            <input type="text" name="add_new" id="add_new" placeholder="Add New" autocomplete="given-name" class=" inline-block mb-2 w-full rounded-md border-0 text-gray-400 p-2 ring-0 border-b-2 focus:border-0 border-[#f5f5f5] placeholder:text-gray-400 focus:ring-0 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <x-quick-add-btn :icon="'plus-icon.svg'"></x-quick-add-btn>
                        </div>
                    </form>
                    <div class=" flex justify-between px-3">
                        <div>
                            <div class=" inline-block">
                                <input type="checkbox" name="Edit" id="privilegeUserEdit">
                                <label for="privilegeUserEdit" class=" text-gray-500"></label>
                            </div>
                            <div class=" inline-block font-semibold">
                                <p>feature for the app</p>
                            </div>
                        </div>
                        <div>
                            <button>
                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                    </div>
                    <div class=" flex justify-between px-3">
                        <div>
                            <div class=" inline-block">
                                <input type="checkbox" name="Edit" id="privilegeUserEdit">
                                <label for="privilegeUserEdit" class=" text-gray-500"></label>
                            </div>
                            <div class=" inline-block font-semibold">
                                <p>feature for the app</p>
                            </div>
                        </div>
                        <div>
                            <button>
                                <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get a reference to the canvas element
    const ctx1 = document.getElementById('myDoughnutChart1').getContext('2d');
    var val = 75;
    var newVal = 100 - val;
    // Define your data
    const data1 = {
        // labels: ['#2ED47A', '#FFB946', '#F7685B'],
        datasets: [{
            data: [val, newVal],
            backgroundColor: ['#FF8356', '#edf2f7'],
            borderColor: '#fff'
        }]
    };

    // Create the doughnut chart
    const myDoughnutChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: data1,
        options: {
            title: {
                display: true,
                text: 'My Doughnut Chart'
            },
            cutout: 100,
            circumference: 180,
            rotation: 270
        }
    });
</script>
<script>
    // Get a reference to the canvas element
    const ctx = document.getElementById('myDoughnutChart').getContext('2d');

    // Define your data
    const data = {
        labels: ['#2ED47A', '#FFB946', '#F7685B'],
        datasets: [{
            data: [75, 15, 10],
            backgroundColor: ['#2ED47A', '#FFB946', '#F7685B'],
            borderColor: '#930027'
        }]
    };

    // Create the doughnut chart
    const myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            title: {
                display: true,
                text: 'My Doughnut Chart'
            },
            cutout: 110,
        }
    });
</script>
@include('layouts.footer')