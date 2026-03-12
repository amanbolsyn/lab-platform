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
                    $request->routeIs("user.show", "update.user"),
                    $this->email
                ),
                $this->mergeWhen(
                    $request->routeIs("user.show", "user.index", "update.user"),
                    [
                        'program' => $this->program->program,
                        'group' => $this->group,
                    ]
                )
            ],
            'included' => [
                $this->when(
                    $request->routeIs("user.show", "user.index", "update.user"),
                    RoleResource::collection($this->roles)
                ),
                $this->when(
                    $request->routeIs("user.show", "update.user"),
                    CartResource::collection($this->whenLoaded('carts')),
                )
            ],

            'links' => [
                'self' => route("user.show", ['user' => $this->id])
            ],
        ];
    }
}
