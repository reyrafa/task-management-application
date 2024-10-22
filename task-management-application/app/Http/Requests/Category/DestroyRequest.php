<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return auth()->user()->id === $this->category->user_id;
    }

}
