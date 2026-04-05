<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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
    public function deleteSafetyRules(User $user, Document $document): bool
    {
        return  $user->isAdmin();
    }
}
