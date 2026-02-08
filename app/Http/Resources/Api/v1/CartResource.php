<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => "cart",
            'id' => $this->id,
            'attributes' => [
                'status' => $this->status,
                'dueDate' => $this->due_date,
                'purpose' => $this->when(
                    $request->routeIs("cart.show"),
                    $this->purpose,
                ),
            ],
            'includes'=> $this->when(
                $request->routeIs('cart.show'),
                [
                    OrderResource::collection($this->whenLoaded('orders')),
                ],
            ),
            'links' => [
                'self' => route("cart.show", ['cart' => $this->id])
            ]
        ];
    }
}
