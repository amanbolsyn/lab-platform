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

    public static function totalCarts($start_date, $end_date): int{
        return Cart::get()->whereBetween('created_at', [$start_date, $end_date])->count();
    }

    public static function byMonth($start_date, $end_date)
    {
        return Cart::selectRaw('YEAR(created_at) as year, MONTHNAME(created_at) as month, COUNT(*) as total')
            ->whereBetween('created_at', [$start_date, $end_date ])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }

    public static function byStatus($start_date, $end_date)
    {
        return Cart::select('status')
            ->selectRaw('COUNT(*) as total')
            ->whereBetween('created_at', [$start_date, $end_date ])
            ->groupBy('status')
            ->get();
    }
}
