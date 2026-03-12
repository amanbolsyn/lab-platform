<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    public const STATUS_LEVELS = ['pending', 'approved', 'rejected', 'returned'];

    public $fillable = [
        'due_date',
        'purpose',
        'comment',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    public static function today(): int
    {
        return Cart::whereDate('created_at', Carbon::today())->count();
    }

    public static function yesterday(): int
    {
        return Cart::whereDate('created_at', Carbon::yesterday())->count();
    }

    public static function byMonth()
    {
        return Cart::selectRaw('YEAR(created_at) as year, MONTHNAME(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }

    public static function byStatus($status):int{
        return Cart::where("status", $status)->count(); 
    }
}
