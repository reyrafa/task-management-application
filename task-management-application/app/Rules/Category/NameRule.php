<?php

namespace App\Rules\Category;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $exists = Category::where('name', $value)->exists();
        if ($exists) {
            $fail('Name Should be unique');
        }

    }
}
