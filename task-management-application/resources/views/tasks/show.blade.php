<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Task') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        @if (auth()->user()->id === $task->user_id)
            <div class="bg-white p-5 rounded">
                <div>{{ $task->title }}</div>
            </div>
        @endif
    </div>
</x-app-layout>
