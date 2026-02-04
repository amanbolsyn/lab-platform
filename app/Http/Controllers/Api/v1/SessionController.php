<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\CreateSessionRequest;
use Illuminate\Http\Request;

class SessionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSessionRequest $request)
    {

       return response()->json([
            "message" =>  $request->get('email'), 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
