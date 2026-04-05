<?php

namespace App\Services;

use App\Http\Resources\Api\v1\DocumentResource;
use Dom\Document;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileStorageService
{

    public function upload(string $folder = 'uploads', UploadedFile $file): string
    {
        return Storage::disk('s3')->put($folder, $file);
    }

    public function delete(string $path): bool
    {
        return Storage::disk('s3')->delete($path);
    }

    public function uploadAll(string $folder = 'uploads', array $files, $model)
    {
        
        foreach ($files as $file) {
            $path = $this->upload($folder, $file);
            $model->files()->create(['path' => $path]);
        }

    }

    public function deleteAll(array $paths)
    {
        foreach ($paths as $path) {
            $this->delete($path['path']); 
        }
    }
}
