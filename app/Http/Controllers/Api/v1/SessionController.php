<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponses;
use App\Http\Requests\Api\v1\Auth\CreateSessionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    use ApiResponses;

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSessionRequest $request)
    {
        
        if(! Auth::attempt($request->only('email', 'password'))){
            return $this->error('Invalid credentials', 401); 
        }

        $user = User::firstWhere('email', $request->email);

        return $this->success("Authenticated", [
            'token' => $user->createToken('token' . $user->email , ['*'],  now()->plus(minutes:40))->plainTextToken,
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
