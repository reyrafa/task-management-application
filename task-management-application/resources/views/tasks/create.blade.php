<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="mt-7 container mx-auto p-5">
        <div>
            <x-tasks.form action="{{ route('tasks.store') }}" />
        </div>

    </div>
</x-app-layout>
