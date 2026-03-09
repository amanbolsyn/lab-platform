<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Cart\StoreCartRequest;
use App\Http\Requests\Api\v1\Cart\UpdateCartRequest;
use App\Http\Resources\Api\v1\CartResource;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartResource::collection(Cart::with('user')->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {

        $cart = DB::transaction(function () use ($request) {

            $cartModel =  [
                "purpose" => $request->input("data.attributes.purpose"),
                "due_date" => $request->input("data.attributes.dueDate")
            ];

            $cart = request()->user()->carts()->create($cartModel);

            //////////////////////////////////////////////////


            foreach ($request->input("included") as $order) {

                $orderModel = [
                    'item_id' => $order['attributes']['id'],
                    "quantity" => $order['attributes']['quantity'],
                ];

                $cart->orders()->create($orderModel);
                
                //////////////////////////////////////////////////

                Item::where('id', $orderModel['item_id'])
                    ->decrement('quantity', $orderModel['quantity']);
            }


            return Cart::with('orders.item')->findOrFail($cart->id);
        });

        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        $cart = Cart::with('orders.item')->findOrFail($cart->id);
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
