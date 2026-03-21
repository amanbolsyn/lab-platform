<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Auth\RegisterUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Auth\Events\Registered;
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

        event(new Registered($user));

        return $this->success("Registred", [
            'token' => $user->createToken('token' . $user->email, ['*'],  now()->plus(minutes: 40))->plainTextToken,
            'includes' =>   new UserResource($user)
        ]);
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Verify if the hash is correct
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification link.'], 403);
        }

        // Mark email as verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json(['message' => 'Email verified successfully!']);
    }

    public function sendVertifiction(Request $request) {

         $user = User::where('email', $request->email)->first();
    
        // if (!$user) {
        //     return response()->json(['message' => 'User not found.'], 404);
        // }
    
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.'], 400);
        }
    
        $user->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link resent!']);
    }
}
