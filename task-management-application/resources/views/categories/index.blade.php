<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Categories') }}
        </h2>
    </x-slot>

    <div class="mt-7 container mx-auto p-5">
        @session('success')
            <div class="bg-green-500 text-white p-4 rounded shadow mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endsession
        @foreach (auth()->user()->categories as $category)
            <div class="bg-white mb-5 rounded p-5">
                <div class="uppercase text-lg font-bold text-gray-900">{{ $category->name }}</div>
                <div class="text-sm text-gray-600">Created On {{ date('Y-m-d', strtotime($category->created_at)) }}</div>
                <div class="mt-3 flex gap-2">
                    <div><button class="bg-blue-700 text-blue-100 rounded px-3 py-1 text-sm">Update</button></div>
                    <div>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="bg-red-700 text-red-100 rounded px-3 py-1 text-sm"
                                type="submit">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
