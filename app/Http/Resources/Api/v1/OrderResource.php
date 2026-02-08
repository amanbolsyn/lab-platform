<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => "order",
            'id' => $this->id,
            'attributes' => [
                'quantity' => $this->quantity
            ],
            'includes' => [
                 new ItemResource($this->item),
            ],
        ];
    }
}
