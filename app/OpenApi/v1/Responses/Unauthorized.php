<?php

namespace app\OpenApi\v1\Responses;

use OpenApi\Attributes as OA;

#[OA\Response( 
    response: "Unauthorized",
    description: "Unauthorized operation",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Unauthorized"
            )
        ]
    )
)]
class Unauthorized {}
