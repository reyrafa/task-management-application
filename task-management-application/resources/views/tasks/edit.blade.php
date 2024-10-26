<x-app-layout>
    <x-slot name="title">
        {{ __('Task - Edit Task') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        @session('success')
            <div class="bg-green-500 text-green-100 p-4 rounded shadow mb-2" role="alert">{{ session('success') }}</div>
        @endsession
        @if (auth()->user()->id === $task->user_id)
            <x-tasks.form action="{{ route('tasks.update', $task->uuid) }}" :task="$task" update="true" />
        @endif
    </div>
</x-app-layout>
