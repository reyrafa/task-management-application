<div wire:poll.2s class="bg-white p-4 rounded">
    <table class="table table-bordered">
        <thead class=" table-secondary">
            <th class="p-3">Task #</th>
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
                    <td class="p-3">{{ $task_category->task->priority }}</td>
                    <td class="p-3">{{ $task_category->task->status }}</td>
                    <td class="p-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $task_categories->links() }}
</div>
