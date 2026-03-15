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
    public function index(Request $request): JsonResponse
    {

        $dates = $request->only(['start_date', 'end_date']);

        if (!isset($dates['end_date']) || !strtotime($dates['end_date'])) {
            $dates['end_date'] = now()->toDateString();
        }

        if (!isset($dates['start_date']) || !strtotime($dates['start_date'])) {
            $dates['start_date'] = now()->subYear()->toDateString();
        }

        return response()->json([
            "data" =>  [
                "total_carts" => Cart::totalCarts($dates['start_date'], $dates['end_date']),
                "carts_by_month" => Cart::byMonth($dates['start_date'], $dates['end_date']),
                "carts_by_status" => Cart::byStatus($dates['start_date'], $dates['end_date']),
            ]
        ]);
    }
}
