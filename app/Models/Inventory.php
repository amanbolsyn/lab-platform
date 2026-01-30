<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

   protected $table = 'inventory';
   public $timestamps = false;

   use HasFactory;

   protected $fillable = [
        'name',
        'description',
        'quantity',
    ];


    public function orders(){
        return $this->hasMay(Order::class);
    }
}
