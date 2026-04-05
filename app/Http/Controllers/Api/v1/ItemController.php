<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Filters\Api\V1\ItemFilter;
use App\Http\Requests\Api\v1\Item\StoreItemRequest;
use App\Http\Requests\Api\v1\Item\UpdateItemRequest;
use App\Http\Resources\Api\v1\ItemResource;
use App\Models\File;
use App\Models\Images;
use App\Models\Item;
use App\Services\FileStorageService;
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
        return ItemResource::collection(Item::with(['categories', 'images'])->filter($filters)->paginate(15));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request, FileStorageService $fileService)
    {

        $model = [
            "name" => $request->input("data.attributes.name"),
            "description" => $request->input("data.attributes.description"),
            "stock" => (int)$request->input("data.attributes.stock"),
            'comment' => $request->input("data.attributes.comment"),
            'projects' => $request->input("data.attributes.projects"),
        ];

        $item = Item::create($model);
        $categoryIds = array_map('intval', $request->input("relationships.categories"));
        $item->categories()->attach($categoryIds);

        if ($request->hasFile('relationships.images')) {
            $fileService->uploadAll('images', $request->file('relationships.images'), $item);
        }

        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item, FileStorageService $fileService)
    {
        $model = [
            "name" => $request->input("data.attributes.name"),
            "description" => $request->input("data.attributes.description"),
            "stock" => $request->input("data.attributes.stock"),
            'comment' => $request->input("data.attributes.comment"),
            'projects' => $request->input("data.attributes.projects"),
        ];

        $item->update($model);
        $categoryIds = array_map('intval', $request->input("relationships.categories"));
        $item->categories()->sync($categoryIds);

        $currentImages = $item->files()->pluck('id')->toArray();
        $keptImages = $request->input('relationships.images.old');
        $imagesToDelete = array_diff($currentImages, $keptImages);

        if ($imagesToDelete) {
            $images = $item->files()->whereIn('id', $imagesToDelete)->get()->toArray();
            $fileService->deleteAll($images);
            File::destroy($imagesToDelete); 
        }

        if ($request->hasFile('relationships.images.new')) {
            $fileService->uploadAll('images',  $request->file('relationships.images.new'), $item);
        }

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item, FileStorageService $fileService)
    {

        $fileService->deleteAll($item->files()->get('path')->toArray());
        $item->delete();

        return $this->success("Item deleted successfully");
    }
}
