<?php

namespace App\Rules;

use App\Models\Roles;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckRoles implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $roleIds, Closure $fail): void
    {
        if(!in_array(1, $roleIds, true) || in_array(3, $roleIds, true)){
            $fail("Invalid roles");
        }
    }
}
