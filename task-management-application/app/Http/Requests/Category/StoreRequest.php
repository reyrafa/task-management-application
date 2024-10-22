<?php

namespace App\Http\Requests\Category;

use App\Rules\Category\NameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'name' => [
                'required',
                'string',
                'lowercase',
                'max:255',
                new NameRule(),
            ],
            'user_id' => [
                'required',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strtolower($this->name),
            'user_id' => Auth::user()->id,
        ]);
    }
}
