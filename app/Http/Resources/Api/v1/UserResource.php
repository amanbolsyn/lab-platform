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
                    $request->routeIs("user.show"),
                    $this->email
                ),
                'group' => $this->group,
            ],
            'includes' => $this->when(
                $request->routeIs("user.show"),
                [
                    CartResource::collection($this->whenLoaded('carts')),
                ]
            ),
            'links' => [
                'self' => route("user.show", ['user' => $this->id])
            ],
        ];
    }
}
