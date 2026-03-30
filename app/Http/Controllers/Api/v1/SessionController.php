<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponses;
use App\Http\Requests\Api\v1\Auth\StoreSessionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    use ApiResponses;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionRequest $request)
    {

        $user = User::firstWhere('email', $request["data.attributes.email"]);

        if(!Hash::check($request['data.attributes.password'], $user->password)){
             return response()->json([
                "message" => "Invalid credentials"
             ], 401);
        }

        return $this->success("Authenticated", [
            'token' => $user->createToken('token' . $user->email, ['*'],  now()->plus(minutes: 40))->plainTextToken,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success("Logged out");
    }
}
