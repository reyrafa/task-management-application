<div wire:poll.2s class="bg-white p-4 rounded">
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
                <td class="p-3">{{ $task_category->task->title }}</td>
                <td class="p-3">{{ $task_category->task->description }}</td>
                <td class="p-3">{{ $task_category->category->name }}</td>
                <td class="p-3">{{ $task_category->task->due_date }}</td>
                <td class="p-3">
                    @if($editId == $task_category->id)
                        <select class="form-select">

                            @foreach(\App\TaskPriority::cases() as $priority)
                                <option
                                    value="{{ $priority->value }}"
                                    {{ old('priority', $task_category->task->priority) == $priority->value ? 'selected' :'' }}>
                                    {{ ucwords($priority->name) }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div
                            class="text-primary bg-info-subtle border border-primary-subtle p-1 text-center rounded-5">


                            {{ ucwords($task_category->task->priority->value) }}
                        </div>
                    @endif

                </td>
                <td class="p-3">
                    @if($editId == $task_category->id)
                        <select class="form-select">
                            @foreach(\App\Status::cases() as $status)
                                <option
                                    value="{{ $status->value }}" {{ old('status', $task_category->task->status) == $status->value ? 'selected' : '' }}>
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
                            <button class="btn btn-success" wire:click="updateTask"><i class="fa-solid fa-floppy-disk"></i></button>
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
