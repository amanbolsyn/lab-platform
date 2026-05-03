<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => "user",
            'id' => $this->id,
            'attributes' => [
                'fullname' => $this->fullname,
                'email' => $this->when(
                    $request->routeIs("user.show", "update.user", 'session'),
                    $this->email
                ),
                $this->mergeWhen(
                    $request->routeIs("user.show", "user.index", "update.user", 'session'),
                    [
                        'program' => $this->program->program ?? null,
                        'group' => $this->group ?? null,
                    ]
                )
            ],
            'included' => [
                $this->when(
                    $request->routeIs("user.show", "user.index", "update.user", 'session'),
                    RoleResource::collection($this->roles)
                )
            ],

            'links' => [
                'self' => route("user.show", ['user' => $this->id])
            ],
        ];
    }
}
