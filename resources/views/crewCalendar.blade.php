@include('layouts.header')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.skedTape.css') }}">
<div class=" my-4">
    <div class=" bg-white w-full rounded-2xl shadow-lg">
        <div class=" flex justify-between p-3 bg-[#930027] text-white rounded-t-2xl">
            <div class=" text-xl font-semibold">
                <h4>Crew Calendar</h4>
            </div>
            <div>
                <!-- <x-add-button :title="'+Add Customer'" :class="''" :id="'addCustomer'"></x-add-button> -->
            </div>
        </div>
        <div class=" my-2">
            <div id="sked2"></div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="{{asset('assets/js/jquery.skedTape.js')}}"></script>
<script type="text/javascript">
    // --------------------------- Data --------------------------------
    var estimateEvents = {!! json_encode($estimates) !!};
    // console.log({!! json_encode($estimates) !!});

    var locations = estimateEvents.map(function(estimate){
        return {
            id: String(estimate.assignedUserName),
            name: String(estimate.assignedUserName),
            tzOffset: 7 * 60,
        }
    });

    var events = estimateEvents.map(function (estimate) {
    return {
        name: String(estimate.customerName), // Convert to string if necessary
        location: String(estimate.assignedUserName),
        start: new Date(estimate.start_date),
        end: new Date(estimate.end_date)
    };
});
    // -------------------------- Helpers ------------------------------
    function today(hours, minutes) {
        var date = new Date();
        date.setHours(hours, minutes, 0, 0);
        return date;
    }

    function yesterday(hours, minutes) {
        var date = today(hours, minutes);
        date.setTime(date.getTime() - 24 * 60 * 60 * 1000);
        return date;
    }

    function tomorrow(hours, minutes) {
        var date = today(hours, minutes);
        date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
        return date;
    }
    // --------------------------- Example 2 ---------------------------
    var sked2Config = {
        caption: 'Crew',
        start: yesterday(23, 0),
        end: tomorrow(0, 0),
        showEventTime: true,
        showEventDuration: true,
        locations: locations.map(function(location) {
            var newLocation = $.extend({}, location);
            delete newLocation.tzOffset;
            return newLocation;
        }),
        events: events.slice(),
        tzOffset: 0,
        sorting: true,
        orderBy: 'name',
    };
    var $sked2 = $.skedTape(sked2Config);
    $sked2.appendTo('#sked2').skedTape('render');
    //$sked2.skedTape('destroy');
    $sked2.skedTape(sked2Config);
</script>