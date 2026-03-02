<?php 

namespace app\OpenApi\v1\Responses; 

use OpenApi\Attributes as OA; 

#[OA\Response( 
    response: "Unauthenticated",
    description: "Unauthenticated operation",
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: "message",
                type: "string",
                example: "Unauthenticated"
            )
        ]
    )
)]
class Unauthenticated {}