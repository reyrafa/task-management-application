@props(['action', 'update' => false, 'task' => null])

<div class="bg-white p-10 w-3/4 rounded mx-auto shadow-lg">
    <form action="{{ $action }}" method="POST">
        @csrf
        @if ($update)
            @method('put')
        @endif
        <div class="block md:grid md:grid-cols-3 gap-5">
            <div class="sm:col-span-12 md:col-span-1">
                <label for="title" class="">{{ __('Title') }} <span
                        class="text-red-600 ms-1 text-sm">{{ __('(REQUIRED)') }}</span></label>
                <input type="text" id="title" name="title"
                    class="w-full block rounded mt-1 focus:shadow-none focus:ring-0 text-gray-600"
                    placeholder="Input Title" value="{{ $task->title ?? old('title') }}">
                @error('title')
                    <div class="mt-2 text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <label for="start_date" class="">{{ __('Start Date') }} <span
                        class="text-red-600 ms-1 text-sm">{{ __('(REQUIRED)') }}</span></label>
                <input type="date" id="start_date" name="start_date"
                    class="w-full block rounded mt-1 focus:shadow-none focus:ring-0 text-gray-600"
                    value="{{ $task->start_date ?? old('start_date') }}">
                @error('start_date')
                    <div class="mt-2 text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <label for="due_date" class="">{{ __('Due Date') }} <span
                        class="text-red-600 ms-1 text-sm">{{ __('(REQUIRED)') }}</span></label>
                <input type="date" id="due_date" name="due_date"
                    class="w-full block rounded mt-1 focus:shadow-none focus:ring-0 text-gray-600"
                    value="{{ $task->due_date ?? old('due_date') }}">
                @error('due_date')
                    <div class="mt-2 text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-full">
                <label for="description" class="">{{ __('Description') }} <span
                        class="text-red-600 ms-1 text-sm">{{ __('(REQUIRED)') }}</span></label>
                <textarea id="description" name="description"
                    class="w-full block rounded mt-1 focus:shadow-none focus:ring-0 text-gray-600" rows="5"
                    placeholder="Write down your description..">{{ $task->description ?? old('description') }}</textarea>
                @error('description')
                    <div class="mt-2 text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-2">
                <label for="category" class="">{{ __('Category') }} <span
                        class="text-red-600 ms-1 text-sm">{{ __('(REQUIRED)') }}</span></label>
                @php
                    $empty = count(auth()->user()->categories) === 0 ? true : false;
                @endphp

                <select name="category_id" id="category" @class([
                    'w-full block rounded mt-1 focus:shadow-none focus:ring-0',
                    'text-stone-400' => $empty,
                    'text-gray-600 uppercase' => !$empty,
                ])>
                    <option value="" selected disabled>Select a category</option>
                    @forelse (auth()->user()->categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id || ($task->category_id ?? null) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @empty
                        <option value="" selected disabled class="text-white">
                            {{ __('No Category Available. Please create a category') }}</option>
                    @endforelse

                </select>
                @error('category_id')
                    <div class="mt-2 text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end col-span-full">
                <button type="submit"
                    class="me-4 px-5 py-2 bg-blue-800 text-blue-200 rounded shadow">{{ $update ? __('Update') : __('Create') }}</button>
            </div>
        </div>

    </form>
</div>
