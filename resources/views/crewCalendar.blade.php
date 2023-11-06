@include('layouts.header')
<link rel="stylesheet" href="{{ asset('assets/employeeCalendar/css/mobiscroll.javascript.min.css') }}">
<div class=" my-4">
    <h1 class=" text-2xl font-semibold mb-3">Crew Calendar</h1>
    <div class=" bg-white w-full rounded-lg shadow-lg">
        <div class=" h-screen">
            <div id="demo-month-view"></div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="{{ asset('assets/employeeCalendar/js/mobiscroll.javascript.min.js') }}"></script>
<script>
    mobiscroll.setOptions({
        theme: 'ios',
        themeVariant: 'light'
    });

    mobiscroll.eventcalendar('#demo-month-view', {
        view: {
            timeline: {
                type: 'month'
            }
        },
        data: [{
            start: '2023-11-02T00:00',
            end: '2023-11-05T00:00',
            title: 'Event 1',
            resource: 1
        }, {
            start: '2023-11-10T09:00',
            end: '2023-11-15T15:00',
            title: 'Event 2',
            resource: 3
        }],

        resources: [{
            id: 1,
            name: 'Resource A',
            color: '#e20000',
            description: 'Description for Resource A'
        }, {
            id: 2,
            name: 'Resource B',
            color: '#76e083',
            description: 'Description for Resource B'
        }, {
            id: 3,
            name: 'Resource C',
            color: '#4981d6',
            description: 'Description for Resource C'
        }]
    });
</script>