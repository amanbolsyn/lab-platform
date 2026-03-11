<?php

namespace App\Policies;

use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpFoundation\Request;

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
    public function update(User $user): bool
    {
        return $user->isAdmin(); 
    }
}
