<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with('roles')->paginate(15));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return new UserResource($user->load('carts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) {}
}
