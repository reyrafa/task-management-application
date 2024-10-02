<div wire:poll.2s class="bg-white p-4 rounded">
    <div class="mb-4">
        <div class="d-flex border rounded-5 task-header">
            <div class="p-3 border-end flex-fill">#</div>
            <div class="p-3 border-end flex-fill">Title</div>
            <div class="p-3 border-end flex-fill">Description</div>
            <div class="p-3 border-end flex-fill">Category</div>
            <div class="p-3 border-end flex-fill">Due Date</div>
            <div class="p-3 border-end flex-fill">Priority</div>
            <div class="p-3 border-end flex-fill">Status</div>
            <div class="p-3 flex-fill">Action</div>
        </div>
    </div>
    @foreach($task_categories as $task_category)
        <div class="mb-4">
            <div class="d-flex border rounded-5 task-header">
                <div class="p-3 border-end flex-fill">#</div>
                <div class="p-3 border-end flex-fill">Title</div>
                <div class="p-3 border-end flex-fill">Description</div>
                <div class="p-3 border-end flex-fill">Category</div>
                <div class="p-3 border-end flex-fill">Due Date</div>
                <div class="p-3 border-end flex-fill">Priority</div>
                <div class="p-3 border-end flex-fill">Status</div>
                <div class="p-3 flex-fill">Action</div>
            </div>
    @endforeach
    <table class="table table-bordered">
        <thead class=" table-secondary">
        <th class="p-3">#</th>
        <th class="p-3">Title</th>
        <th class="p-3">Description</th>
        <th class="p-3">Category</th>
        <th class="p-3">Due Date</th>
        <th class="p-3">Priority</th>
        <th class="p-3">Status</th>
        <th class="p-3">Action</th>
        </thead>
        <tbody>
        @foreach ($task_categories as $task_category)
            <tr>
                <td class="p-3">{{ $task_category->task->id }}</td>
                <td class="p-3">
                    @if($editId == $task_category->id)
                        <input type="text" wire:model="title" class="form-control">
                    @else
                        {{ $task_category->task->title }}
                    @endif
                </td>
                <td class="p-3">{{ $task_category->task->description }}</td>
                <td class="p-3">{{ $task_category->category->name }}</td>
                <td class="p-3">{{ $task_category->task->due_date }}</td>
                <td class="p-3">
                    @if($editId == $task_category->id)
                        <select class="form-select" wire:model="priority">

                            @foreach(\App\TaskPriority::cases() as $priority)
                                <option
                                    value="{{ $priority->value }}">
                                    {{ ucwords($priority->name) }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div
                            class="{{ ($task_category->task->priority->value == 'low')
                                    ? 'text-primary bg-info-subtle border border-primary-subtle'
                                    : ($task_category->task->priority->value == 'medium' ?
                                    'text-success bg-success-subtle border border-success-subtle'
                                    : 'text-danger bg-danger-subtle border border-danger-subtle')  }}
                                    p-1 text-center rounded-5">


                            {{ ucwords($task_category->task->priority->value) }}
                        </div>
                    @endif

                </td>
                <td class="p-3">
                    @if($editId == $task_category->id)
                        <select class="form-select" wire:model="status">
                            @foreach(\App\Status::cases() as $status)
                                <option
                                    value="{{ str_replace('_', ' ', $status->value) }}">
                                    {{ ucwords(str_replace('_', ' ', $status->name)) }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        {{ $task_category->task->status }}
                    @endif
                </td>
                <td class="p-3">
                    <div class="d-flex gap-2">

                        @if($editId == $task_category->id)
                            <button class="btn btn-secondary" wire:click="cancelEdit"><i class="fa-solid fa-ban"></i>
                            </button>
                            <button class="btn btn-success" wire:click="updateTask"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        @else
                            <button wire:click="editButtonClicked({{ $task_category->id }})" class="btn btn-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $task_categories->links() }}
</div>

@push('styles')
    <style>
        .task-header {
            background: #4d5365;
            color: white;

        }
    </style>
@endpush
