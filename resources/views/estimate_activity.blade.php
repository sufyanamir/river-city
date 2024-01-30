@include('layouts.header')

<div class="my-4">
    <div class="bg-white w-full rounded-2xl shadow-lg">
        <div class="flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class="text-xl font-semibold">
                <h4>Estimate Activity</h4>
            </div>
        </div>
        
        @if(count($activities) > 0)
            @foreach ($activities as $activity)
                <div class="py-1">
                    <div class="bg-[#F5F5F5] rounded-lg p-3 m-2">
                        <div class=" flex justify-between">
                            <div>
                                <h1 class="font-semibold text-lg">{{ $activity->activity_title }}<span class=" text-sm">({{$activity->user->name}})</span>:</h1>
                                <p>{{ $activity->activity_description }}</p>
                            </div>
                            <div>
                                {{$activity->created_at}}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        @else
            <div class="py-1 text-center">
                <div class="bg-[#F5F5F5] rounded-lg p-3 m-2">
                    <h1>No Activity Right Now!</h1>
                </div>
            </div>
        @endif

    </div>
</div>

@include('layouts.footer')
