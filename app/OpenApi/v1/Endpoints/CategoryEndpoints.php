<?php 
namespace App\OpenApi\v1\Endpoints;

use OpenApi\Attributes as OA; 


class CategoryEndpoints {


 #[OA\Get(
        path: "/api/v1/categories",
        summary: "Get categories list",
        tags: ["Categories"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                type: "array",
                items: new OA\Items(ref: "#/components/schemas/Category")
            )
            )
        ]
    )]

public function index(){}
public function store(){}
public function update(){}
public function destory(){}

}