<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // $statusStats = []; 
        // foreach(Cart::STATUS_LEVELS as $status){ 
        //      $statusStats = Cart::byStatus($status); 
        // }


        return response()->json([
            "data" =>  [
                "total" => Cart::get()->count(),
                "today" => Cart::today(),
                "yesterday" => Cart::yesterday(),
                "by_month" => Cart::byMonth(),
                "pending" => Cart::byStatus("pending"),
                "approved" => Cart::byStatus("approved"),
                "rejected" => Cart::byStatus("rejected"),
                "returned" => Cart::byStatus("returned"),
            ]
        ]);
    }
}
