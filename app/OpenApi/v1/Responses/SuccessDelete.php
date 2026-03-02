<?php

namespace app\OpenApi\v1\Responses;

use OpenApi\Attributes as OA;

#[OA\Response( 
    response: "SuccessDelete",
    description: "Resource deleted successfully",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Resource deleted successfully"
            )
        ]
    )
)]
class SuccessDelete {}
