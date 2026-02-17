<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Item\StoreItemRequest;
use App\Http\Requests\Api\v1\Item\UpdateItemRequest;
use App\Http\Resources\Api\v1\ItemResource;
use App\Models\Item;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    use ApiResponses; 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ItemResource::collection(Item::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $model = [
            "name" => $request->input("data.attributes.name"),
            "description" => $request->input("data.attributes.description"),
            "quantity" => $request->input("data.attributes.quantity"),
        ];

        return new ItemResource(Item::create($model));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return $this->success("Item deleted successfully");
    }
}
