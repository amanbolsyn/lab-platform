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
                'quantity' => $this->quantity,
                $this->mergeWhen(
                    $request->routeIs("item.show"),
                    [
                        'description' => $this->description,
                        'project_links' => $this->project_links,
                        'comment' => $this->when(
                            auth('sanctum')->user()?->isAdmin(),
                            $this->comment
                        )
                    ]
                )
            ],
            'included' => [$this->when(
                $request->routeIs("item.show", "item.index"),
                CategoryResource::collection($this->categories)
            )],
            'links' => [
                'self' => route("item.show", ['item' => $this->id])
            ]
        ];
    }
}
