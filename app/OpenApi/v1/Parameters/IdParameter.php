<?php

namespace app\OpenApi\v1\Parameters;

use OpenApi\Attributes as OA;

#[
    OA\Parameter(
        parameter: "IdParameter", 
        name: "id",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"), 
        description: "Resource id parameter"
    )
]

class IdParameter{}