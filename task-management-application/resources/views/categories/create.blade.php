<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="mt-7 container mx-auto p-5">
        @session('success')
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-200 " role="alert">
                {{ session('success') }}
            </div>
        @endsession
        <div class="flex">
            <div
                class="bg-white w-full md:w-1/2 mx-auto p-1 sm:p-5 md:p-10 rounded-lg shadow-lg border-solid border border-indigo-300">
                <h1 class="text-center font-bold text-xl uppercase">Add Category</h1>
                <x-categories.form method="POST" action="{{ route('categories.store') }}" />
            </div>

        </div>

    </div>
</x-app-layout>
