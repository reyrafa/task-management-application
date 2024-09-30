<?php

namespace App\Livewire;

use App\Models\TaskCategory;
use Livewire\Component;

/**
 *
 */
class DisplayTasks extends Component
{


    /**
     *
     */
    public $editId = null;
    public $title;
    public $description;
    public $due_date;
    public $priority;
    public $status;

    /**
     * Handle the event when the edit button is clicked
     *
     * @param int $editId The identifier of the item to be edited
     */
    public function editButtonClicked($editId)
    {
        $this->editId = $editId;
        $task_category = TaskCategory::with('task')->find($editId);
        $this->title = $task_category->task->title;
        $this->description = $task_category->task->description;
        $this->due_date = $task_category->task->due_date;
        $this->priority = $task_category->task->priority;
        $this->status = $task_category->task->status;
    }

    /**
     *
     */
    public function cancelEdit()
    {
        $this->editId = null;
    }

    /**
     *
     */
    public function updateTask()
    {
        $task_category = TaskCategory::with('task')->find($this->editId);
        $task_category->task->title = $this->title ?? $task_category->task->title;
        $task_category->task->description = $this->description ?? $task_category->task->description;
        $task_category->task->due_date = $this->due_date ?? $task_category->task->due_date;
        $task_category->task->priority = $this->priority ?? $task_category->task->priority;
        $task_category->task->status = $this->status ?? $task_category->task->status;
        $task_category->task->save();
        $this->editId = null;

        $this->dispatch('success-creation', ['success', 'Task updated successfully.']);
    }

    public function render()
    {
        $task_categories = TaskCategory::with(['task', 'category'])
            ->paginate(5);

        return view('livewire.display-tasks', [
            'task_categories' => $task_categories
        ]);
    }
}
