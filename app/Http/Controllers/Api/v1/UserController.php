<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Http\Resources\Api\v1\CartResource;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\Cart;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fullname = $request->input('fullname');

        $users = User::where('fullname', 'like', "%$fullname%")
            ->with('roles')
            ->paginate($request->per_page ?? 15);

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
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

    public function destroy(User $user)
    {
        $user->delete();

        return $this->success("User deleted successfully");
    }

    public function getUserCarts(Request $request, User $user)
    {

        $carts = Cart::where('user_id', $user->id)
            ->with('orders.item')
            ->paginate($request->per_page ?? 10);

        return CartResource::collection($carts);
    }
}
