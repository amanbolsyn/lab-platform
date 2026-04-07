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
                'due_date' => $this->due_date,
                $this->mergeWhen(
                    $request->routeIs("cart.show", "cart.store", "cart.update"),
                    [
                        "purpose" => $this->purpose,
                        "comment" => $this->comment,
                    ]
                ),

            ],
            'included' => [
                $this->when(
                    $request->routeIs('cart.index', 'cart.show', 'cart.store', 'cart.update'),
                    new UserResource($this->user)
                ),
                $this->when(
                    $request->routeIs('cart.show', "cart.store", "cart.update", "user.carts"),
                    OrderResource::collection($this->whenLoaded('orders')),
                )
            ],
            'links' => [
                'self' => route("cart.show", ['cart' => $this->id])
            ]
        ];
    }
}
