<?php

namespace App\Http\Requests\Note;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Note Request Validation
 */
class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = $this->getTask();
        if (!$task) {
            return false;
        }

        return auth()->user()->id === $task->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'note' => [
                'required',
                'string',
                'max:500',
            ],
            'task_id' => [
                'required',
                'integer',
            ],
        ];
    }

    /**
     * Inject the task id before validation
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'task_id' => $this->getTask()->id,
        ]);
    }

    /**
     * Get the task for reusability
     * @return mixed
     */
    protected function getTask()
    {
        $task_model = new Task();
        $task = $task_model->getTask($this->route()->parameter('task'));
        return $task;
    }
}
