<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="mt-7 container mx-auto p-5">
        @if (auth()->user()->id === $category->user_id)
            <div class="bg-white py-10 rounded shadow-md w-1/2 mx-auto">

                <x-categories.form action="{{ route('categories.update', $category->id) }}" method="post" button="Update"
                    name="{{ $category->name }}" update="update" />

            </div>
        @endif

    </div>


</x-app-layout>
