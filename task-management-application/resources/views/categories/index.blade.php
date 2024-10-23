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
        <div class="flex justify-end mb-3">
            <a href="{{ route('categories.create') }}"
                class="py-1 px-5 bg-blue-800 text-white rounded uppercase tracking-wider">Add Category</a>
        </div>
        @forelse (auth()->user()->categories as $category)
            <div class="bg-white mb-5 rounded p-5">
                <div class="uppercase text-lg font-bold text-gray-900">{{ $category->name }}</div>
                <div class="text-sm text-gray-600">Created On {{ date('Y-m-d', strtotime($category->created_at)) }}
                </div>
                <div class="mt-3 flex gap-2">
                    <div><button
                            class="bg-blue-700 text-blue-100 rounded px-3 py-1 text-sm">{{ __('Update') }}</button>
                    </div>
                    <div x-data>

                        <button class="bg-red-700 text-red-100 rounded px-3 py-1 text-sm"
                            x-on:click="$dispatch('open-modal', { name: 'confirm-category-deletion', category_id: {{ $category->id }} })">{{ __('Delete') }}</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-sm text-gray-800">No Categories Yet.</div>
        @endforelse

    </div>
    <x-modal name="confirm-category-deletion" :show="$errors->has('password')">
        <div x-data="{ category_id: '{{ old('category_id') }}' }" class="p-6"
            x-on:open-modal.window="
                if($event.detail.name === 'confirm-category-deletion'){
                    category_id = $event.detail.category_id
                }">

            <form method="post" :action="`{{ route('categories.destroy', '') }}/${category_id}`">
                @csrf
                @method('delete')

                <h2 class=" text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete this category?') }}</h2>

                <input type="hidden" name="category_id" :value="category_id">


                <p class="mt-1 text-gray-600">
                    {{ __('Please enter your password to confirm you would like to permanently delete your category.') }}
                </p>
                <div class="mt-3">
                    <input type="password" placeholder="Password" name="password"
                        class="w-3/4 rounded-md border-slate-300 focus:border-slate-500 focus:ring-slate-600 shadow">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5 flex justify-end gap-3">

                    <button x-on:click="$dispatch('close')" type="button"
                        class="px-5 py-1 uppercase text-sm tracking-wider hover:bg-slate-100 bg-white border border-slate-300 rounded">{{ __('Close') }}</button>
                    <button
                        class="px-5 py-1 uppercase text-sm rounded tracking-wider bg-red-600 text-white hover:bg-red-500"
                        type="submit">{{ __('Delete') }}</button>
                </div>
            </form>
        </div>

    </x-modal>


</x-app-layout>
