@include('layouts.header')
<div class="my-2">
    <h1 class=" text-2xl font-semibold">Dashboard</h1>
    <div class=" flex justify-start gap-2 my-5">
        <div class="pt-3"><img src="{{ asset('assets/icons/borderbar.svg') }}" alt="img"></div>
        <div class=" text-gray-400"><p>Today</p></div>
        <div class="font-semibold"><p> 23, December 2023</p></div>
    </div>
    <div>
        <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-3">
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
            <x-dashboard-cards :title="''" :value="''" :img="''"></x-dashboard-cards>
        </div>
    </div>
</div>
@include('layouts.footer')