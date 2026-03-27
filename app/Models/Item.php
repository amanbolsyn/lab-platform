<?php

namespace App\Models;

use App\Http\Filters\Api\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'comment',
        'projects'
    ];

    protected $casts = [
        'projects' => 'array',
    ];


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    public static function decreaseStock($itemId, $orderQuantity): void
    {
        Item::where('id', $itemId)
            ->decrement('stock', $orderQuantity);
    }

    public static function incrementStock($itemId, $orderQuantity): void
    {
        Item::where('id', $itemId)
            ->increment('stock', $orderQuantity);
    }
}
