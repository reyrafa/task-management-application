<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $uuid = $this->route()->parameter('task');
        $task_model = new Task();
        $task = $task_model->getTask($uuid);
        if (!$task) {
            return false;
        }
        return auth()->user()->id === $task->user_id;
    }

}
