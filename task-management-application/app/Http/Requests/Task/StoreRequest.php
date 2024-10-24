<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Validation rule for storing a task.
 */
class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
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
                'exists:users,id',

            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
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
                'lowercase',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'due_date' => [
                'required',
                'date',
            ],
            'note' => [
                'string',
                'nullable',
            ],
        ];
    }

    /**
     * Merge the user id title and description
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
            'title' => strtolower($this->title),
            'description' => strtolower($this->description),
        ]);
    }
}
