<form wire:submit.prevent='createCategory'>
    <div class="mb-2">
        <label for="category_name" class="mb-2">Category Name <span class="text-danger">(REQUIRED*)</span></label>
        <input type="text" id="category_name"
            class="form-control shadow-none {{ $errors->has('category_name') ? 'border border-danger' : '' }}"
            placeholder="Enter category name.." wire:model.live='category_name'>
        <div>
            @error('category_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>
