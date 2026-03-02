<?php

namespace app\OpenApi\v1\Responses;

use OpenApi\Attributes as OA;

#[OA\Response( 
    response: "ResourceNotFound",
    description: "Resource doesn't exists",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Resource not found"
            )
        ]
    )
)]
class ResourceNotFound {}
