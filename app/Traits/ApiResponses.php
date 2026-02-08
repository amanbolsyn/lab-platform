<?php

namespace App\Traits; 


trait ApiResponses
{

    protected function success($message, $data = [],  $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'statusCode' => $statusCode
        ], $statusCode);
    }


    protected function error($message, $statusCode)
    {
        return response()->json([
            'message' => $message
        ], $statusCode);
    }
}
