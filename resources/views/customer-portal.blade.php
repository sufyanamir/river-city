<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
</head>

<body class="bg-slate-300">
    <div class=" flex justify-center items-center h-[100vh]  p-3">
        <div class=" bg-white rounded-lg  w-[70%] p-4">
            <div class="flex justify-between">
                <div>
                    <div class="projectLogo ">
                        <img class="w-[288px] h-[73px]" src="{{ asset('assets/icons/tproject-logo.svg') }}" alt="">
                    </div>
                </div>
                <div class="">
                    <p class="text-[22px]/[25.78px] font-bold text-[#323C47]">River City Painting, Inc</p>
                    <p class=" mt-2 font-medium text-[17px]/[19.92px] text-[#858585]">
                        4425 W Walker St<br>
                        Wichita Kansas 67209 <br>
                        info@paintwichita.com <br>
                        (316) 262-3289
                    </p>
                </div>
            </div>
            <div class="mt-10 mb-10 text-center text-slate-400">
                Active Proposal & Change Orders
            </div>
            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $proposal)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ date('m/d/y H:i:s', strtotime($proposal->created_at)) }}
                                </th>
                                <td class="px-6 py-4">
                                    @if($proposal->proposal_type === 'estimate')
                                    Estimate
                                    @else
                                    Change Order
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $proposal->proposal_total }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $proposal->proposal_status }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(!empty($proposal->proposal_data))
                                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ $proposal->proposal_status === 'pending' 
                                        ? '/viewProposal?estimateId=' . $proposal->estimate_proposal_id 
                                        : '/viewProposal?proposalId=' . $proposal->estimate_proposal_id }}{{ $proposal->group_id ? '&group_id=' . $proposal->group_id : '' }}">
                                        <button class="px-2 py-2 bg-blue-500 text-white rounded-md">
                                            view
                                        </button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" mt-3 text-center">
                <a target="_blank" href="https://thewebconcept.com/" class="text-[#930027] hover:underline">
                    <span class="text-sm text-[#930027] sm:text-center my-auto dark:text-gray-400">Powered by : The Web Concept™.
                    </span>
                </a>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/topbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>