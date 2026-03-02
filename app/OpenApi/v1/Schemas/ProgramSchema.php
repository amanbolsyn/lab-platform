<?php
namespace app\OpenApi\v1\Schemas;

use OpenApi\Attributes as OA; 

#[OA\Schema(
    schema: "Program",
    type: "object",
    required: ["id", "name", "code"],
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            maxLength: 255, 
            example: "Software Engenineering",
            description: "Program name"
        ),
          new OA\Property(
            property: "code",
            type: "string",
            maxLength: 63, 
            example: "6B06102",
            description: "Program code"
        )
    ]
)]
class ProgramSchema{}
