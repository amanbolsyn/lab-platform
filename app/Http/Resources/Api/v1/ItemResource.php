<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => "item", 
            'id' => $this->id, 
            'attributes' => [
                'name' => $this->name, 
                'description' => $this->when(
                    $request->routeIs("item.show"),
                    $this->description
                ), 
                'quantity' => $this->quantity, 
                'external_links' => $this->external_links, 
                'comment' => $this->comment, 
            ],
            'includes' => [
                CategoryResource::collection($this->categories), //subject to change
            ] ,
            'links' => [
                'self' => route("item.show", ['item' => $this->id])
            ]
        ];
    }
}
