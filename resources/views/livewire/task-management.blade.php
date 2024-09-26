<div class="mt-4">
    <div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="fs-4">
            <button class="btn {{ $add_category_btn_color }}"
                wire:click="toggleAddCategoryButton">{{ $add_category_btn_text }}</button>
        </div>

        <div class="col-4 mt-4 {{ $add_category_form_display }}">
            @livewire('create-category-form')
        </div>
        <div class="fs-4 mt-2">
            <button class="btn {{ $add_task_btn_color }}"
                wire:click='toggleAddTaskButton'>{{ $add_task_btn_text }}</button>
        </div>
        <div class="{{ $add_task_form_display }}">
            @livewire('create-task-form')
        </div>
        <div class="mt-4">
            @livewire('display-tasks')
        </div>
    </div>
</div>
