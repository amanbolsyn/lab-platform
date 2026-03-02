<?php

namespace App\OpenApi\v1\Endpoints;

use OpenApi\Attributes as OA;

class ProgramEndpoints
{
    #[OA\Get(
        path: "/api/v1/programs",
        summary: "Get programs list",
        tags: ["Programs"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Program")
                )
            )
        ]
    )]
    public function index() {}

    #[OA\Post(
        path: "/api/v1/programs",
        summary: "Create program",
        tags: ["Programs"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/ProgramRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Program")
                )
            )
        ]
    )]
    public function store() {}


    #[OA\Put(
        path: "/api/v1/programs/{id}",
        summary: "Edit a program",
        tags: ["Programs"],
        parameters: [
            new OA\Parameter(
                ref: "#/components/parameters/IdParameter"
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/ProgramRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Program")
                )
            ),
            new OA\Response(response: 401, ref: "#/components/responses/Unauthenticated"),
            new OA\Response(response: 403, ref: "#/components/responses/Unauthorized"),
            new OA\Response(response: 404, ref: "#/components/responses/ResourceNotFound"),
        ]
    )]
    public function update() {}


    #[OA\Delete(
        path: "/api/v1/programs/{id}",
        summary: "Delete a program",
        tags: ["Programs"],
        parameters: [
            new OA\Parameter(
                ref: "#/components/parameters/IdParameter"
            )
        ],
        responses: [
            new OA\Response(response: 200, ref: "#/components/responses/SuccessDelete"),
            new OA\Response(response: 401, ref: "#/components/responses/Unauthenticated"),
            new OA\Response(response: 403, ref: "#/components/responses/Unauthorized"),
            new OA\Response(response: 404, ref: "#/components/responses/ResourceNotFound"),
        ]
    )]
    public function destroy() {}
}
