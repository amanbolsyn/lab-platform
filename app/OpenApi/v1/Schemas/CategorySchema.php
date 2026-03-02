<?php
namespace app\OpenApi\v1\Schemas;

use OpenApi\Attributes as OA; 

#[OA\Schema(
    schema: "Category",
    type: "object",
    required: ["id", "name"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: "1", 
            description: "Cateogory ID"
        ),
        new OA\Property(
            property: "name",
            type: "string",
            maxLength: 255, 
            example: "Motors",
            description: "Category name"
        )
    ]
)]
class CategorySchema{}
