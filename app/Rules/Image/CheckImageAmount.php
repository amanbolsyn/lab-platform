<?php

namespace App\Rules\Image;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckImageAmount implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $images, Closure $fail): void
    {
        $totalImages = 0;

        if(key_exists('new', $images)){
            $totalImages =+ count($images['new']);
        }

        if(key_exists('old', $images)){
            $totalImages =+ count($images['old']);
        }

        if ($totalImages > 10) {
            $fail("The number of images exceeded allowed amount.");
        }
    }
}
