<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        @session('success')
            <div class="bg-green-200 text-green-700  rounded shadow-lg p-5 mb-3">{{ session('success') }}</div>
        @endsession
        <div class="flex justify-end">
            <a href="{{ route('tasks.create') }}"
                class="bg-green-800 rounded shadow-lg text-green-200 px-5 py-2 hover:bg-green-500 hover:text-green-800">{{ __('Create Task') }}</a>

        </div>
        <div class="mt-5">
            <div class="bg-white p-10 rounded shadow">
                <div id="calendar"></div>
            </div>

        </div>

    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events),
                    headerToolbar: {
                        left: 'prev next',
                        center: 'title',
                        right: 'dayGridMonth multiMonthYear'
                    },
                    height: 650,
                    contentHeight: 600,

                    selectable: true,
                    eventClick: function(info) {
                        alert('Event: ' + info.event.title);
                    },
                    eventDidMount: function(info) {
                        info.el.style.padding = '10px';
            
                   
                        if (info.event.extendedProps.status === 'done') {

                            // Change background color of row
                            info.el.style.backgroundColor = 'green';

                          
                        }
                    }


                });
                calendar.render();
            })
        </script>
    @endpush
</x-app-layout>
