<?php

namespace App\Http\Resources\Api\v1;

use App\Http\Resources\Api\v1\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Null_;

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
                'stock' => $this->stock,
                'images' => FileResource::collection($this->images),
                $this->mergeWhen(
                    $request->routeIs("item.show", 'item.update', 'item.store'),
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
                $request->routeIs("item.show", "item.index", "item.store", "item.update"),
                CategoryResource::collection($this->categories)
            )],
            'links' => [
                'self' => route("item.show", ['item' => $this->id])
            ]
        ];
    }
}
