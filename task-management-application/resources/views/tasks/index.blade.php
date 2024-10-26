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
            @empty($events)
                <h2>No tasks yet.</h2>
            @else
                <div class="block md:flex gap-5">
                    <div class="bg-white p-10 rounded shadow md:w-3/4 mb-4">
                        <div class="mb-5 flex justify-end">
                            <div>
                                <h2 class="text-stone-800 font-bold tracking-wide text-end">Legend</h2>
                                <div class="flex gap-5 mt-1">
                                    <div class="flex gap-2 items-center">
                                        <label for="low_priority" class="text-stone-500">{{ __('Low Priority') }}</label>
                                        <div class="px-2 h-2 bg-stone-500 w-5" id="low_priority"></div>

                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <label for="high_priority" class="text-red-600">{{ __('High Priority') }}</label>
                                        <div class="px-2 h-2 bg-red-600 w-5" id="high_priority"></div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="calendar"></div>
                    </div>
                    <div class="grow">
                        <div class="bg-white p-5 shadow-lg rounded mb-5">
                            <div>
                                <h2 class="tracking-wider font-bold text-red-500 mb-2 uppercase">Urgent Tasks</h2>
                                <ul class="list-disc list-inside">
                                    @foreach ($priorities as $urgent)
                                        <li class="mb-2 text-sm"><a href="{{ route('tasks.show', $urgent->uuid) }}"
                                                class="hover:text-red-400">
                                                {{ $urgent->title . __(' (Due on ') . $urgent->due_date . __(')') }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="bg-white p-5 shadow-lg rounded">
                            <div>
                                <h2 class="tracking-wider font-bold text-stone-700 mb-2 uppercase">Latest Completed Tasks
                                </h2>
                                <ul class="list-disc list-inside">
                                    @foreach ($done_tasks as $done_task)
                                        <li class="mb-2 text-sm"><a href="{{ route('tasks.show', $done_task->uuid) }}"
                                                class="hover:text-green-400">
                                                {{ $done_task->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
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
                        window.location.href =
                            `{{ route('tasks.show', '') }}/${info.event.extendedProps.task}`;
                    },
                    eventDidMount: function(info) {
                        info.el.style.padding = '10px';
                        info.el.style.cursor = 'pointer';

                        info.el.addEventListener('mouseover', () => {

                            info.el.style.backgroundColor = info.event.extendedProps.priority ===
                                'low' ? '#999999' : '#ff3232';

                        });
                        info.el.addEventListener('mouseout', () => {
                            info.el.style.backgroundColor = info.event.backgroundColor;
                        });


                    }


                });
                calendar.render();
            })
        </script>
    @endpush


</x-app-layout>
