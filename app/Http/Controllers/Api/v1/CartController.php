<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Cart\StoreCartRequest;
use App\Http\Requests\Api\v1\Cart\UpdateCartRequest;
use App\Http\Resources\Api\v1\CartResource;
use App\Mail\OrderCreated;
use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CartResource::collection(Cart::with('user')->paginate($request->per_page ?? 15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $cart = DB::transaction(function () use ($request) {

            //cart creation 
            $cartAttributes = collect($request->input('data.attributes'));
            $cart = $request->user()->carts()->create(
                $cartAttributes->toArray()
            );

            //order creation 
            $ordersAttributes = collect($request->input('included'))->map(fn($order) => [
                "item_id" => data_get($order, 'attributes.id'),
                "quantity" => data_get($order, 'attributes.quantity'),
            ]);
            $cart->orders()->createMany($ordersAttributes->toArray());


            $ordersAttributes->map(
                fn($order) => Item::decreaseStock($order['item_id'], $order['quantity'])
            );

            Mail::to([$request->user()])->send(new OrderCreated($cart));

            $admins = User::whereHas('roles', function ($query) {
                $query->where('role', 'admin');
            })->get();
            foreach ($admins as $admin) {
                Mail::to($admin)->send(new OrderCreated($cart));
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
        $cart = DB::transaction(function () use ($request, $cart) {

            $cart->update(collect($request->input('data.attributes'))->toArray());

            $ordersAttributes = collect($request->input('included'))->map(fn($order) => [
                "item_id" => data_get($order, 'attributes.id'),
                "quantity" => data_get($order, 'attributes.quantity'),
            ]);

            //update orders
            foreach ($ordersAttributes as $attribute) {
                $cart->orders()
                    ->where('item_id', $attribute['item_id'])
                    ->update($attribute);
            }


            //update items
            if ($cart['status'] === "rejected" || $cart['status'] === 'returned') {
                foreach ($ordersAttributes as $order) {
                    Item::incrementStock($order['item_id'], $order['quantity']);
                }
            }

            return Cart::with('orders.item')->findOrFail($cart->id);
        });

        return new CartResource($cart);
    }
}
