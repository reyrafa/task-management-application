<form wire:submit.prevent='createTask'>
    <div class="mt-3">
        <label class="mb-2">Title <span class="text-danger">(REQUIRED *)</span></label>
        <input type="text" wire:model.live='title' class="form-control shadow-none" placeholder="Enter Title">
        @error('title')
            <span class="text-danger mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mt-3">
        <label class="mb-2">Category <span class="text-danger">(REQUIRED *)</span></label>
        <select class="form-control shadow-none" wire:model.live='category_id'>
            <option value="" selected disabled>--Select category--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="text-danger mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mt-3">
        <label class="mb-2">Description</label>
        <textarea placeholder="Enter Description" wire:model.live='description' class="form-control shadow-none" cols="30"
            rows="10"></textarea>
        @error('description')
            <span class="text-danger mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mt-3">
        <label class="mb-2">Target Date</label>
        <input class="form-control shadow-none" wire:model.live='due_date' type="datetime-local">
        @error('due_date')
            <span class="text-danger mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mt-3"><button class="btn btn-primary">Create Task</button></div>
</form>
