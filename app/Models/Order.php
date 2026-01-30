<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

   use HasFactory;

    public const STATUS_LEVELS = ['pending', 'approved', 'rejected', 'returned'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function item()
    {
        return $this->hasOne(Inventory::class);
    }
}
