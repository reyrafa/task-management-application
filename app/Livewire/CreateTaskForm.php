<?php

namespace App\Livewire;

use App\Models\TaskCategory;
use App\Models\Tasks;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTaskForm extends Component
{
    /**
     * task creation
     */
    #[Validate('required|string')]
    public $title;

    #[Validate('required')]
    public $category_id = '';

    public $description;

    public $due_date;

    /**
     * function to add task
     * 
     */
    public function createTask()
    {
        $this->validate();

        /**
         * for adding task
         */
        $task = new Tasks();
        $task->user_id = Auth::user()->id;
        $task->title = $this->title;
        $task->description = $this->description;
        $task->due_date = $this->due_date;
        $task->save();

        /**
         * for adding task-category
         */
        $task_category = new TaskCategory();
        $task_category->task_id = $task->id;
        $task_category->category_id = $this->category_id;
        $task_category->save();

        $this->reset();

        $this->dispatch('success-creation', message: ['success', 'Task created successfully']); 
    }

    public function render()
    {
        $categories = Auth::user()->categories;
        return view('livewire.create-task-form')->with(['categories' => $categories]);
    }
}
