<?php

namespace App\Http\Controllers\Api\v1;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Lab Platform API endpoints",
    description: "API Documentation for the University Lab Inventory Management System (IMS)",
    contact: new OA\Contact(
        name: "Aman Nurgozhiyev", 
        email: "anurgozhiyev@gmail.com"
    ),
    license: new OA\License(
        name: "Apache 2.0",
        url: "https://www.apache.org/licenses/LICENSE-2.0.html"
    )
)]
abstract class Controller
{
    //
}
