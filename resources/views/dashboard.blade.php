@include('layouts.header')
<div class="my-2">
    <div class=" flex gap-4">
        <h1 class=" text-2xl font-semibold">
            Hello! {{ $user_details['name'] }} <span class="text-xs">({{$user_details['user_role']}})</span>
        </h1>
        @if(session('user_details')['user_role'] == 'admin')
        <div class="w-[10%]">
            <select id="userSelect" name="" autocomplete="customer-name" class="p-2 w-[100%] outline-none rounded-md border-0 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0095E5] sm:text-sm sm:leading-6">
                <option value="">Users</option>
                @foreach($admins as $user)
                <option value="{{$user->id}}" {{$user->id == request()->route('user') ? 'selected' : ''}}>{{$user->name}} {{$user->last_name}}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <div class=" flex justify-start gap-2 my-5">
        <div class="pt-3"><img src="{{ asset('assets/icons/borderbar.svg') }}" alt="img"></div>
        <div class=" text-gray-400">
            <p>Today</p>
        </div>
        <div class="font-semibold">
            <p>{{ date('d, F Y') }}</p>
        </div>
    </div>
    <div class="mb-4">
        @if (session('user_details')['user_role'] == 'crew' || $user_details['user_role'] == 'crew')
        <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-6">
            <x-dashboard-cards :title="'Today Jobs'" :value="$todayJobsCount" :img="'dashboard-graphs.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Pending Jobs'" :value="$pendingJobsCount" :img="'dashboard-users.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Complete Jobs'" :value="$completeJobsCount" :img="'dashboard-orders.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Total Jobs'" :value="$totalJobsCount" :img="'dashboard-dollar.svg'"></x-dashboard-cards>
        </div>
        @elseif(session('user_details')['user_role'] == 'admin' || $user_details['user_role'] == 'admin')
        <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-6">
            <x-dashboard-cards :title="'Total Customers'" :value="count($customers)" :img="'dashboard-graphs.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Total Staff'" :value="count($staff)" :img="'dashboard-users.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Confirm Orders'" :value="count($confirm_orders)" :img="'dashboard-orders.svg'"></x-dashboard-cards>
            <x-dashboard-cards :title="'Total Revenue'" :value="number_format($revenue, 2)" :img="'dashboard-dollar.svg'"></x-dashboard-cards>
        </div>
        @endif
    </div>
    @if (session('user_details')['user_role'] == 'crew' || $user_details['user_role'] == 'crew')
    @elseif(session('user_details')['user_role'] == 'admin' || $user_details['user_role'] == 'admin')
    <div class=" lg:flex lg:justify-between xl:flex xl:justify-between sm:grid sm:grid-cols-1 md:grid md:grid-cols-1 gap-4">
        <!-- order summary & schedules -->

        <div class=" bg-white my-2 w-full rounded-xl shadow-med xl:w-[80%]">
            <div class=" p-2 border-b-2 bg-[#930027] rounded-t-xl">
                <h3 class=" text-xl font-semibold text-white ">Orders Summary</h3>
            </div>
            <div class=" lg:flex lg:justify-evenly xl:flex xl:justify-evenly md:grid md:grid-cols-1 sm:grid sm:grid-cols-1">
                <div class=" p-2 text-center sm:mx-auto md:mx-auto lg:mx-0 xl:mx-0">
                    <canvas id="myDoughnutChart1"></canvas>
                </div>
                <div class=" p-2 my-auto text-center">
                    <div class=" my-2">
                        <h2 class=" text-2xl font-semibold">${{ number_format($revenue, 2) }}</h2>
                    </div>
                    <div class=" my-2">
                        <p class=" text-sm text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed
                            do</p>
                    </div>
                    <div class=" mt-7">
                        <a href="/estimates">
                            <button class=" text-[#930027a8] bg-[#FFE0AE] p-4 font-semibold rounded-full">See More</button>
                        </a>
                    </div>
                </div>
                <div class=" p-2 my-full">
                    <div class=" border  my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">{{ $completeEstimates }}</h3>
                        <p class=" text-[#930027] font-semibold text-sm">Complete</p>
                    </div>
                    <div class=" border my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">{{ $pendingEstimates }}</h3>
                        <p class=" text-[#930027] font-semibold text-sm">Pending</p>
                    </div>
                    <div class=" border my-2 py-3 px-7 text-center rounded-xl">
                        <h3 class=" text-lg font-medium">{{ $cancelEstimates }}</h3>
                        <p class=" text-[#930027] font-semibold text-sm">Cancel</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- order summary & schedules -->
        <!-- orders chart & to do list -->
        <div class="bg-white  my-2 rounded-2xl w-auto xl:w-[20%]">
            <div class="bg-[#930027] rounded-t-2xl border-b-2 p-2 text-white">
                <h3 class=" text-lg font-semibold">Orders</h3>
            </div>
            <div class=" my-2 text-white text-center mx-auto">
                <canvas id="myDoughnutChart"></canvas>
            </div>
        </div>
        <!-- orders chart & to do list -->
    </div>
    @endif
    <div class=" lg:flex lg:justify-between gap-2 xl:flex xl:justify-between sm:grid sm:grid-cols-1 md:grid md:grid-cols-1 my-2">
        @if (session('user_details')['user_role'] == 'crew' || $user_details['user_role'] == 'crew')
        <div class=" bg-white w-full rounded-xl">
            <div class="bg-[#930027] p-2 text-white rounded-t-xl">
                <div class=" flex justify-between gap-10">
                    <h3 class=" text-lg font-medium">Schedules</h3>
                </div>
            </div>
            <div class=" p-2">
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
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class=" text-center">
                            @foreach ($schedule_estimates_with_estimates as $item)
                            <tr>
                                <td>{{ isset($item['estimate']->created_at) ? date('d, F Y', strtotime($item['estimate']->created_at)) : '' }}</td>
                                <td>
                                    <h3 class="text-lg font-medium">
                                        <a href="">
                                            {{ $item['estimate']->customer_name }}
                                            {{ $item['estimate']->customer_last_name }}
                                        </a>
                                    </h3>
                                </td>
                                <td>
                                    <a href="https://maps.google.com/?q={{ $item['estimate']->customer_address }}">
                                        <p class="text-[#323C47]">{{ $item['estimate']->customer_address }}</p>
                                    </a>
                                </td>
                                <td class=" pl-8">
                                    <a href="/viewEstimateMaterials/{{ $item['schedule_estimate']->estimate_id }}" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M21 11C21 15.714 21 18.0711 19.5355 19.5355C18.0711 21 15.714 21 11 21C6.28595 21 3.92893 21 2.46447 19.5355C1 18.0711 1 15.714 1 11C1 6.28595 1 3.92893 2.46447 2.46447C3.92893 1 6.28595 1 11 1C15.714 1 18.0711 1 19.5355 2.46447C20.5093 3.43821 20.8356 4.80655 20.9449 7" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M5.12119 16.6922C5.12523 16.6922 5.13007 16.6922 5.13492 16.6917C5.33925 16.6847 5.46807 16.5233 5.48543 16.3158C5.49916 16.163 5.90137 12.4665 11.5585 12.4706L11.5714 14.834C11.5714 14.9934 11.6614 15.1384 11.8028 15.2063C11.9425 15.2747 12.1113 15.2537 12.2312 15.152L17.4679 10.7278C17.562 10.6492 17.6157 10.5322 17.6153 10.4091C17.6149 10.2859 17.5604 10.1686 17.4667 10.0903L12.2304 5.70734C12.1097 5.60686 11.9429 5.5875 11.802 5.65463C11.661 5.72299 11.571 5.86795 11.571 6.0265L11.5581 8.33844C9.21147 8.41422 7.39388 9.1839 6.21594 10.5898C4.29861 12.8779 4.72666 16.2029 4.74644 16.3413C4.77633 16.5431 4.9213 16.6913 5.12038 16.6913L5.12119 16.6922ZM11.9752 11.6408H11.9744C7.93338 11.6433 6.38918 13.0348 5.50724 14.2641C5.63646 13.2798 6.01282 12.0926 6.83217 11.1236C7.92167 9.8354 9.67707 9.15631 11.9752 9.15631C12.1981 9.15631 12.379 8.97223 12.379 8.7445V6.8942L16.5743 10.4119L12.379 13.9626V12.053C12.379 11.9439 12.3366 11.8389 12.2603 11.7615C12.1848 11.6845 12.0822 11.6408 11.9752 11.6408Z" fill="black" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- orders chart & to do list -->
        <div class=" my-2 rounded-2xl w-full">
            <!-- <div class=" bg-[#930027] rounded-2xl">
                    <div class=" border-b-2 p-2 text-white">
                        <h3 class=" text-lg font-medium">Orders</h3>
                    </div>
                    <div class=" my-2 text-white text-center mx-auto">
                        <canvas id="myDoughnutChart"></canvas>
                    </div>
                </div> -->
            <div class=" bg-white w-full rounded-xl">
                <div class=" border-b-2 p-2 bg-[#930027] rounded-t-xl">
                    <h3 class=" text-lg font-medium text-white">To do List</h3>
                </div>
                <div>
                    <div class=" py-4 px-2 my-2">
                        <form action="/addUserToDo" method="post">
                            @csrf
                            <div class=" flex justify-between">
                                <input type="text" name="to_do_title" id="to_do_title" placeholder="Add New" autocomplete="given-name" class=" inline-block mb-2 w-full rounded-md border-0 text-gray-400 p-2 ring-0 border-b-2 focus:border-0 border-[#f5f5f5] placeholder:text-gray-400 outline-none focus:ring-0 focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                                <button class=" rounded-lg bg-[#930027] px-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]">
                                    <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="">
                                </button>
                            </div>
                        </form>
                        @foreach ($Todos as $todo)
                        <div class=" flex justify-between px-3">
                                <div class=" inline-block">
                                    <form action="/completeUserToDo/{{ $todo->to_do_id }}" method="post">
                                        @csrf
                                        <button>
                                            <input type="checkbox" name="completed" id="completedToDo_{{ $todo->to_do_id }}" value="completed" {{ $todo->to_do_status == 'completed' ? 'checked' : '' }}>
                                            <label for="completedToDo_{{ $todo->to_do_id }}" class=" text-gray-500"></label>
                                        </button>
                                    </form>
                                </div>
                                <div class=" inline-block font-semibold" style="width: 90%;">
                                <p>{{ $todo->to_do_title }} <span class=" text-xs">Start date:({{date('d, F Y', strtotime($todo->start_date))}}) - End date:({{date('d, F Y', strtotime($todo->end_date))}}), (Added by: {{ isset($todo->assigned_by) ? $todo->assigned_by->name . ' ' . $todo->assigned_by->last_name : 'Unknown' }})</span>
                                        <br>
                                        <span class=" text-sm">
                                            Note:
                                            <br>
                                            {{$todo->note}}
                                        </span>
                                    </p>
                                </div>
                            <div>
                                <form action="/deleteUserToDo/{{ $todo->to_do_id }}" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        @foreach ($estimateToDos as $todo)
                        <div class=" flex  px-3">
                            <div class=" inline-block">
                                <form action="/completeToDo{{ $todo->to_do_id }}" method="post">
                                    @csrf
                                    <button>
                                        <input type="checkbox" name="completed" id="completedToDo_{{ $todo->to_do_id }}" value="completed" {{ $todo->to_do_status == 'completed' ? 'checked' : '' }}>
                                        <label for="completedToDo_{{ $todo->to_do_id }}" class=" text-gray-500"></label>
                                    </button>
                                </form>
                            </div>
                            <div>
                                <div class=" inline-block font-semibold">
                                    <p>{{ $todo->to_do_title }} <span class=" text-xs">Start date:({{date('d, F Y', strtotime($todo->start_date))}}) - End date:({{date('d, F Y', strtotime($todo->end_date))}}), (Added by: {{ isset($todo->assigned_by) ? $todo->assigned_by->name . ' ' . $todo->assigned_by->last_name : 'Unknown' }})</span>
                                        <br>
                                        <span class=" text-sm">
                                            Note:
                                            <br>
                                            {{$todo->note}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div style="width: 89px;">
                                <form class="text-right" action="/deleteToDo{{ $todo->to_do_id }}" method="post">
                                    @csrf
                                    <button>
                                        <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- orders chart & to do list -->
        @else
        <div class=" bg-white w-full rounded-xl">
            <div class="bg-[#930027] p-2 text-white rounded-t-xl">
                <div class=" flex justify-between gap-10">
                    <h3 class=" text-lg font-semibold">Schedules</h3>
                </div>
            </div>
            <div class=" p-2">
                <div class="relative overflow-x-auto h-60 overflow-y-auto my-2">
                    <table class="w-full text-sm text-left ">
                        <thead class="text-xs text-white uppercase bg-[#930027]">
                            <tr>
                                @if (session('user_details')['user_role'] == 'scheduler')
                                <th scope="col" class="px-6 py-3">
                                    Start Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    End Date
                                </th>
                                @else
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                @endif
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
                            @if (count($schedules[0]) > 0)
                            @foreach ($schedules[0] as $index => $schedule)
                            @php
                            $estimate = $schedules[1][$index];
                            $scheduler = \App\Models\User::find($schedule->estimate_complete_assigned_to);
                            @endphp

                            @if (session('user_details')['user_role'] == 'scheduler' || $user_details['user_role'] == 'scheduler')
                            @if ($estimate->estimate_schedule_assigned_to == session('user_details')['id'] || $estimate->estimate_schedule_assigned_to == $user_details['id'])
                            <tr>
                                <td>{{ date('d, F Y', strtotime($estimate->scheduled_start_date)) }}
                                </td>
                                <td>{{ date('d, F Y', strtotime($estimate->scheduled_end_date)) }}
                                </td>
                                <td>
                                    <h3 class="text-lg font-medium">
                                        <a href="/viewEstimate/{{$estimate->estimate_id}}">
                                            {{ $estimate->customer_name }}
                                            {{ $estimate->customer_last_name }}
                                        </a>
                                    </h3>
                                </td>
                                <td>
                                    <a href="https://maps.google.com/?q={{ $estimate->customer_address }}" target="_blank" class="pl-3">
                                        <p class="text-[#323C47] hover:border-b">
                                            {{ $estimate->customer_address }}
                                        </p>
                                    </a>
                                </td>
                                <td>
                                    <h3 class="text-lg font-medium">{{ $scheduler->name }}</h3>
                                    <p class="text-[#198CF6]">{{ $scheduler->phone }}</p>
                                </td>
                            </tr>
                            @endif
                            @else
                            <tr>
                                <td>
                                    {{ isset($estimate->created_at) ? date('d, F Y', strtotime($estimate->created_at)) : '' }}
                                </td>
                                <td>
                                    <h3 class="text-lg font-medium">
                                        <a href="{{ isset($estimate->estimate_id) ? '/viewEstimate/' . $estimate->estimate_id : '' }}">
                                            {{ isset($estimate->customer_name) ? $estimate->customer_name : '' }}
                                            {{ isset($estimate->customer_last_name) ? $estimate->customer_last_name : '' }}
                                        </a>
                                    </h3>
                                </td>
                                <td>
                                    <a href="{{ isset($estimate->customer_address) ? 'https://maps.google.com/?q=' . $estimate->customer_address : '' }}" target="_blank" class="pl-3">
                                        <p class="text-[#323C47] hover:border-b">
                                            {{ isset($estimate->customer_address) ? $estimate->customer_address : '' }}
                                        </p>
                                    </a>
                                </td>
                                <td>
                                    <h3 class="text-lg font-medium">{{ isset($scheduler->name) ? $scheduler->name : '' }}</h3>
                                    <p class="text-[#198CF6]">{{ isset($scheduler->phone) ? $scheduler->phone : '' }}</p>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="pt-4 border-b-2">No Schedules </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class=" bg-white w-full rounded-xl">
            <div class=" border-b-2 p-2 bg-[#930027] rounded-t-xl">
                <h3 class=" text-lg font-semibold text-white ">To do List</h3>
            </div>
            <div>
                <div class=" py-4 px-2 my-2 h-64 overflow-scroll">
                    <form action="/addUserToDo" method="post">
                        @csrf
                        <div class=" flex justify-between">
                            <input type="text" name="to_do_title" id="to_do_title" placeholder="Add New" autocomplete="given-name" class=" inline-block mb-2 w-full rounded-md border-0 text-gray-400 p-2 ring-0 border-b-2 focus:border-0 border-[#f5f5f5] placeholder:text-gray-400 outline-none focus:ring-1  focus:ring-inset focus:ring-[#0095E5] sm:text-sm">
                            <button class="rounded-lg h-10 flex justify-center items-center w-10 bg-[#930027] px-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-[#930017]">
                                <img src="{{ asset('assets/icons/plus-icon.svg') }}" alt="">
                            </button>
                        </div>
                    </form>
                    @foreach ($Todos as $todo)
                    <div class=" flex justify-between px-3">
                            <div class=" inline-block">
                                <form action="/completeUserToDo/{{ $todo->to_do_id }}" method="post">
                                    @csrf
                                    <button>
                                        <input type="checkbox" name="completed" id="completedToDo_{{ $todo->to_do_id }}" value="completed" {{ $todo->to_do_status == 'completed' ? 'checked' : '' }}>
                                        <label for="completedToDo_{{ $todo->to_do_id }}" class=" text-gray-500"></label>
                                    </button>
                                </form>
                            </div>
                            <div class=" inline-block font-semibold" style="width: 90%;">
                                <p>{{ $todo->to_do_title }} <span class=" text-xs">Start date:({{date('d, F Y', strtotime($todo->start_date))}}) - End date:({{date('d, F Y', strtotime($todo->end_date))}}), (Added by: {{ isset($todo->assigned_by) ? $todo->assigned_by->name . ' ' . $todo->assigned_by->last_name : 'Unknown' }})</span>
                                    <br>
                                    <span class=" text-sm">
                                        Note:
                                        <br>
                                        {{$todo->note}}
                                    </span>
                                </p>
                            </div>
                        <div>
                            <form action="/deleteUserToDo/{{ $todo->to_do_id }}" method="post">
                                @csrf
                                <button>
                                    <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @foreach ($estimateToDos as $todo)
                    <div class=" flex  px-3">
                        <div class=" inline-block">
                            <form action="/completeToDo{{ $todo->to_do_id }}" method="post">
                                @csrf
                                <button>
                                    <input type="checkbox" name="completed" id="completedToDo_{{ $todo->to_do_id }}" value="completed" {{ $todo->to_do_status == 'completed' ? 'checked' : '' }}>
                                    <label for="completedToDo_{{ $todo->to_do_id }}" class=" text-gray-500"></label>
                                </button>
                            </form>
                        </div>
                        <div>
                            <div class=" inline-block font-semibold">
                                <p>{{ $todo->to_do_title }} <span class=" text-xs">Start date:({{date('d, F Y', strtotime($todo->start_date))}}) - End date:({{date('d, F Y', strtotime($todo->end_date))}}), (Added by: {{ isset($todo->assigned_by) ? $todo->assigned_by->name . ' ' . $todo->assigned_by->last_name : 'Unknown' }})</span>
                                    <br>
                                    <span class=" text-sm">
                                        Note:
                                        <br>
                                        {{$todo->note}}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="width: 35%;">
                            <form class="text-right" action="/deleteToDo{{ $todo->to_do_id }}" method="post">
                                @csrf
                                <button>
                                    <img src="{{ asset('assets/icons/close-icon.svg') }}" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if (session('user_details')['user_role'] == 'crew' || $user_details['user_role'] == 'crew')
@else
<script>
    const orders = @json($confirm_orders);

    const pendingEstimates = orders.filter(order => order.estimate_status === 'pending').length;
    const CompletedEstimates = orders.filter(order => order.estimate_status === 'complete').length;
    // Get a reference to the canvas element
    const ctx1 = document.getElementById('myDoughnutChart1').getContext('2d');
    var val = CompletedEstimates;
    var newVal = pendingEstimates - val;
    // Define your data
    const data1 = {
        // labels: ['#2ED47A', '#FFB946', '#F7685B'],
        datasets: [{
            data: [newVal, val],
            backgroundColor: ['#930027', '#edf2f7'],
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
            cutout: '60%',
            circumference: 180,
            rotation: 270
        }
    });
</script>
@endif
@if (session('user_details')['user_role'] == 'crew' || $user_details['user_role'] == 'crew')
@else
<script>
    // Get a reference to the canvas element
    const ctx = document.getElementById('myDoughnutChart').getContext('2d');

    // Extract status information from PHP variable
    const confirmedOrders = @json($confirm_orders);

    // Log the data for troubleshooting
    console.log(confirmedOrders);

    // Extract the counts for each status
    const pendingCount = confirmedOrders.filter(order => order.estimate_status === 'pending').length;
    const completeCount = confirmedOrders.filter(order => order.estimate_status === 'complete').length;
    const cancelCount = confirmedOrders.filter(order => order.estimate_status === 'cancel').length;

    // Log the counts for troubleshooting
    console.log({
        pendingCount,
        completeCount,
        cancelCount
    });

    // Define your data
    const data = {
        labels: ['pending', 'complete', 'cancel'],
        datasets: [{
            data: [pendingCount, completeCount, cancelCount],
            backgroundColor: ['#FFB946', '#2ED47A', '#F7685B']
        }]
    };

    // Log the final data for troubleshooting
    // console.log(data);

    // Create the doughnut chart
    const myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            title: {
                display: true,
                text: 'Confirm Orders Status'
            },
            cutout: '90%',
        }
    });
</script>
@endif
@include('layouts.footer')
<script>
    $(document).ready(function() {
        $('#userSelect').change(function() {
            var userId = $(this).val();
            if (userId) {
                window.location.href = '/dashboard/' + userId;
            }
        });
    });
</script>