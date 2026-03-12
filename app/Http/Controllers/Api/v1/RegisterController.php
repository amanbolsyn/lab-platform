<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Auth\RegisterUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponses;

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request)
    {
        $userAttributes = collect($request->input('data.attributes'));
        $programId = ['program_id' => $request->input('relationships.program.id')]; 

        $user = User::create(array_merge($userAttributes->toArray(), $programId));

        $role = Role::where('role', 'user')->first();
        $user->roles()->attach($role->id);


        return $this->success("Registred", [
            'token' => $user->createToken('token' . $user->email, ['*'],  now()->plus(minutes: 40))->plainTextToken,
            'includes' =>   new UserResource($user)
        ]);
    }
}
