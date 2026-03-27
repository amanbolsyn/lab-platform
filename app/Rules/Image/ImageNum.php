<?php

namespace App\Rules\Image;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageNum implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($attribute); 
    }
}
