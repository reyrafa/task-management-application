<?php

namespace App\Rules\Category;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Hash::check($value, auth()->user()->password)) {
            $fail("Password do not match. Please try again.");
        }
    }
}
