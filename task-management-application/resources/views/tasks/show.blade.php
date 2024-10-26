<x-app-layout>
    <x-slot name="title">{{ __('Show Task') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Task') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        @session('error')
            <div class="bg-red-700 text-red-100 p-4 rounded shadow mb-2 flex items-center justify-between" role="alert">
                <div>
                    {{ session('error') }}
                </div>
                <div class="">
                    <button type="button" onclick="this.parentElement.parentElement.remove()"
                        class="text-2xl text-red-100 hover:text-red-200 font-bold">
                        &times;
                    </button>
                </div>

            </div>
        @endsession
        @session('success')
            <div class="bg-green-700 text-green-100 p-4 rounded shadow mb-2 flex items-center justify-between"
                role="alert">
                <div>
                    {{ session('success') }}
                </div>
                <div class="">
                    <button type="button" onclick="this.parentElement.parentElement.remove()"
                        class="text-2xl text-green-100 hover:text-green-200 font-bold">
                        &times;
                    </button>
                </div>

            </div>
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
                <div class="mt-3">
                    <div class="text-stone-600 font-bold">{{ __('Notes') }}</div>
                    <div>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($task->notes as $note)
                                <li class="indent-5">{{ $note->note }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="mt-10">
                    <div>
                        <form action="{{ route('tasks.store_note', $task->uuid) }}" method="post">
                            @csrf
                            <textarea class="w-full rounded" rows="5" name="note" name="" id=""
                                placeholder="Write down notes.."></textarea>
                            <button type="submit"
                                class="py-2 px-4 bg-green-700 rounded mt-2 shadow text-green-50">{{ __('Submit Note') }}</button>
                        </form>

                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-4">

                    <div class="flex gap-5">
                        <a href="{{ route('tasks.edit', $task->uuid) }}"
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
