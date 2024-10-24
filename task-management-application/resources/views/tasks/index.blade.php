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
                class="bg-green-800 rounded shadow-lg text-green-200 px-5 py-2 hover:bg-green-500 hover:text-green-800">Create
                Task</a>

        </div>

    </div>
</x-app-layout>
