<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Task') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        @session('success')
            <div class="bg-green-500 text-green-100 p-4 rounded shadow mb-2" role="alert">{{ session('success') }}</div>
        @endsession
        @if (auth()->user()->id === $task->user_id)
            <div class="bg-white p-5 rounded">
                <div class="flex justify-between">
                    <div>
                        <div class="font-bold tracking-wider text-stone-700 uppercase text-lg">{{ $task->title }}
                            <span @class([
                                'text-base',
                                'text-orange-500' => $task->status === 'pending',
                                'text-blue-500' => $task->status === 'ongoing',
                                'text-green-500' => $task->status === 'done',
                            ])>{{ __('(') . $task->status . __(')') }}</span>
                        </div>
                        <div class="text-stone-600 tracking-wide">{{ ucwords($task->category->name) }}</div>
                        <div class="text-stone-600 text-sm tracking-wide">
                            {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }} -
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</div>
                        <div class="mt-3 text-stone-600 font-bold">{{ __('Details') }}</div>
                        <div class="indent-10 tracking-wide text-stone-700">{{ ucwords($task->description) }}</div>
                    </div>
                    <div>
                        <div @class([
                            'text-red-700' => $task->priority === 'high',
                            'text-stone-700' => $task->priority === 'low',
                            'tracking-widest uppercase p-2 rounded',
                        ])>{{ $task->priority }}</div>
                    </div>
                </div>
                <div class="mt-3 text-stone-600 font-bold">
                    <div>{{ __('Notes') }}</div>
                    <div>
                        <ul class="list-inside">
                            <li>{{ $task->note }}</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-10">
                    <div>
                        <textarea class="w-full rounded" name="note" name="" id="" placeholder="Write down notes.."></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-4">
                    
                    <div class="flex gap-5">
                        <a href="#"
                            class="bg-blue-700 py-2 px-4 rounded text-blue-100 text-sm hover:bg-blue-500">{{ __('Update') }}</a>
                        @if ($task->status !== 'done')
                            <form action="{{ route('tasks.update_task_status', $task->uuid) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit"
                                    class="bg-green-700 py-2 px-4 rounded text-green-100 text-sm hover:bg-green-500">{{ $task->status === 'pending' ? __('Do') : __('Done') }}</button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>
        @endif
    </div>
</x-app-layout>
