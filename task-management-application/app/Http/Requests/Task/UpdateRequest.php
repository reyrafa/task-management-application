<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = $this->getTask($this->route()->parameter('task'));
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
            'user_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
                'lowercase',
            ],
            'description' => [
                'required',
                'string',
                'max:500',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'due_date' => [
                'required',
                'date',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * get the task
     */
    protected function getTask($uuid)
    {
        $task_model = new Task();
        return $task_model->getTask($uuid);
    }
}
