<?php

namespace app\OpenApi\v1\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProgramRequest",
    required: ["name", "code"],
    properties: [
        new OA\Property( property: "data", properties: [
            new OA\Property(property: "attributes", type: "object", ref: "#/components/schemas/Program")
        ])
    ]
)]
class ProgramRequest {}