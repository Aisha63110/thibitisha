<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaSpaces implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regex: only letters (A–Z, a–z) and spaces allowed
        if (!preg_match('/^[A-Za-z\s]+$/', $value)) {
            $fail("The {$attribute} may only contain letters and spaces.");
        }
    }
}
