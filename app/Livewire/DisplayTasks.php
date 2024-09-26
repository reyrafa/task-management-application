<?php

namespace App\Livewire;

use App\Models\TaskCategory;
use App\Models\Tasks;
use Livewire\Component;

class DisplayTasks extends Component
{
    /**
     * for updating priority 
     */
    public function priorityTDClicked() {
        dump(5);
    }

    /**
     * Summary of render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $task_categories = TaskCategory::with(['task', 'category'])
            ->paginate(5);

        return view('livewire.display-tasks', [
            'task_categories' => $task_categories
        ]);
    }
}
