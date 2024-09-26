<?php

namespace App\Livewire;

use App\Models\TaskCategory;
use Livewire\Component;

class DisplayTasks extends Component
{

    public $editId = null;

    /**
     * edit button clicked
     */
    public function editButtonClicked($editId)
    {
        $this->editId = $editId;
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
