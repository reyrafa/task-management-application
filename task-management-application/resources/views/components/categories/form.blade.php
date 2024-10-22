@props(['method', 'action'])

<form method="{{ $method }}" action="{{ $action }}">
    @csrf
    <div class="mt-3 w-3/4 mx-auto">
        <label for="name" class="block font-medium antialiased">Name</label>
        <input type="text" name="name"
            class="block w-full rounded border-black focus:border-blue-500 focus:outline-none focus:ring-0"
            placeholder="Enter Name.." />
        @error('name')
            <div class="text-red-400 mt-1">{{ $message }}</div>
        @enderror

    </div>
    <div class="mt-3 w-3/4 mx-auto">
        <button class="p-2 text-white w-full bg-blue-700 rounded shadow">Create</button>
    </div>
</form>
