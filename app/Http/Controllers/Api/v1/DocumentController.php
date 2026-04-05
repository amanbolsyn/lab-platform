<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Document\StoreSafetyRules;
use App\Http\Resources\Api\v1\DocumentResource;
use App\Models\Document;
use App\Services\FileStorageService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class DocumentController
{

    use ApiResponses;

    public function getSafetyRules()
    {

        $document = Document::where('document', 'safety-rules')->first();
        if (!$document) {
            return response()->json([
                'message' => "Safety rules document doesn't exists"
            ], 404);
        }

        return new DocumentResource($document);
    }

    public function storeSafetyRules(StoreSafetyRules $request, FileStorageService $fileService)
    {
        if (Document::where('document', 'safety-rules')->exists()) {
            return response()->json([
                'message' => 'Safety rules is already uploaded'
            ], 422);
        }

        $model = collect($request->input('data.attributes'))->toArray();
        $document = Document::create($model);

        $fileService->uploadAll('documents', $request->file('relationships.file'), $document);

        return new DocumentResource($document);
    }

    public function deleteSafetyRules(FileStorageService $fileService)
    {
        $document = Document::where('document', 'safety-rules')->first();
        $fileService->delete($document->files()->get('path'));

        $document->delete();


        return $this->success("Safety rules deleted successfully");
    }
}
