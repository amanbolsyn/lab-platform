<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Auth\RegisterUserRequest;
use App\Http\Resources\Api\v1\UserResource;
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
        $attributes = collect($request->input('data.attributes'));

        $model = $attributes->only([
            'fullname',
            'email',
            'password',
            'group',
            'read_safety_precautions',
            'program_id'

        ])->toArray();

        $user = User::create($model);

        return $this->success("Registred", [
            'token' => $user->createToken('token' . $user->email, ['*'],  now()->plus(minutes: 40))->plainTextToken,
            'includes' =>   new UserResource($user)
        ]);
    }
}
