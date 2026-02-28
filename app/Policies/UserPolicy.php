<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;


class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateWithAttributes(User $user, array $attributes):bool
    {
        // if (!$user->isAdmin()) {
        //     return false;
        // }

        
        //  dd(array_key_exists('data.attributes.role', $attributes));
        // if ($user->isAdmin() && array_key_exists('role', $attributes)) {
        //     return false;
        // }

        return true;
    }
}
