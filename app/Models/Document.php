<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Document extends Model
{
    protected $fillable = ['document'];

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
