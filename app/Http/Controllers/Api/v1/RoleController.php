<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::withCount('users')->get());
    }
}
