<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Images</title>
    <!-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <script src="{{ asset('assets/js/fontawesome.js') }}" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}" />
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>

<div class="bg-white shadow-md p-4 flex flex-col items-center text-center sm:flex-row sm:justify-between sm:items-center sm:text-left gap-2">
    <div class="flex items-center justify-center gap-2">
        <img src="{{ asset('assets/icons/projectLogo.svg') }}" alt="Logo" class="">
    </div>
    <div>
        <span class="text-lg font-semibold text-gray-700">River City Painting shared a gallery with you</span>
    </div>
    <a href="/download-images/{{$estimate_id}}" class="text-blue-600 hover:underline text-sm font-medium">
        <i class="fas fa-download mr-1"></i> Download All Photos
    </a>
</div>



    <div class="container mx-auto mt-5 p-3">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 xl:grid-cols-6 gap-4 mt-6">
            @foreach ($images as $index => $image)
            <div class="relative group rounded overflow-hidden shadow-sm border border-gray-200">
                <a data-fancybox="gallery" href="{{ $image->estimate_image }}">
                    <img src="{{ $image->estimate_image }}"
                        alt="Image"
                        class="w-full aspect-[4/3] object-cover transition-transform duration-300 group-hover:scale-105" />
                </a>
                <div class="absolute top-1 left-1 bg-white text-sm text-gray-700 px-2 py-1 rounded shadow">
                    {{ $index + 1 }}
                </div>
            </div>
            @endforeach
        </div>
        <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800" id="footer">
            <div class="w-full mx-auto max-w-screen-xl p-4 text-center">
                <span class="text-sm text-[#930027] sm:text-center dark:text-gray-400"><a target="_blank" href="https://thewebconcept.com/" class="hover:underline">Powered by : The Web Concept™.</a>
                </span>
            </div>
        </footer>
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
