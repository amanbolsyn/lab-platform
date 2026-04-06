<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fullname = $request->input('fullname');

        return UserResource::collection(User::where('fullname', 'like', "%$fullname%")->with('roles')->paginate($request->per_page ?? 15));
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
    public function update(UpdateUserRequest $request, User $user)
    {

        $userAttributes = collect($request->input("data.attributes"))->toArray();

        $user->update($userAttributes);

        if (Auth::user()->isRoot()) {
            $user->roles()->sync($request->input("relationships.roles")); 
        }

        return new UserResource($user->load('carts')); 
        
    }
}
