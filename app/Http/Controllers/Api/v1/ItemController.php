<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Filters\Api\V1\ItemFilter;
use App\Http\Requests\Api\v1\Item\StoreItemRequest;
use App\Http\Requests\Api\v1\Item\UpdateItemRequest;
use App\Http\Resources\Api\v1\ItemResource;
use App\Models\Item;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(ItemFilter $filters)
    {
        return ItemResource::collection(Item::with('categories')->filter($filters)->paginate(15));
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
            'comment' => $request->input("data.attributes.comment"),
            'projects' => $request->input("data.attributes.projects"), 
        ];

        $item = Item::create($model);

        $item->categories()->attach($request->input("data.attributes.categories"));

        return new ItemResource($item);
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
    public function update(UpdateItemRequest $request, Item $item) {

          $model = [
            "name" => $request->input("data.attributes.name"),
            "description" => $request->input("data.attributes.description"),
            "quantity" => $request->input("data.attributes.quantity"),
            'comment' => $request->input("data.attributes.comment"),
            'projects' => $request->input("data.attributes.projects"), 
        ];

        $item->update($model);
        $item->categories()->sync($request->input("data.attributes.categories"));

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return $this->success("Item deleted successfully");
    }
}
