<?php

namespace App\Rules\Image;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ItemImageRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $images, Closure $fail): void
    {
        $totalImage = count($images['old']) + count($images['new']);
        if ($totalImage > 10) {
            $fail("The number of images exceeded allowed amount.");
        }
    }
}
