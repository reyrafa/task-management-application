<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-6 gap-10">
                <div class="bg-white p-5 rounded shadow-lg">
                    {{ auth()->user()->categories()->count() }}
                </div>
                <div class="bg-white">
                    {{ auth()->user()->tasks()->count() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
