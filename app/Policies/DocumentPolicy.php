<?php

namespace App\Policies;

use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function storeSafetyRules(User $user): bool
    {
        return  $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function deleteSafetyRules(User $user): bool
    {
        return  $user->isAdmin();
    }
}
