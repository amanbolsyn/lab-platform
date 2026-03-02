<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Program\StoreProgramRequest;
use App\Http\Requests\Api\v1\Program\UpdateProgramRequest;
use App\Http\Resources\Api\v1\ProgramResource;
use App\Traits\ApiResponses;
use App\Models\Program;
use OpenApi\Attributes as OA;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ProgramController
{

    use ApiResponses;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return ProgramResource::collection(Program::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {
        $model = [
            "name" => $request->input("data.attributes.name"),
            "code" => $request->input("data.attributes.code"),
        ];


        return new ProgramResource(Program::create($model));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $model = [
            "name" => $request->input("data.attributes.name"),
            "code" => $request->input("data.attributes.code"),
        ];

        $program->update($model);

        return new ProgramResource($program);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return $this->success("Resource deleted successfully");
    }
}
