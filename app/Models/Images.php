<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    protected $fillable = ['path'];

    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
