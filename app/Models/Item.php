<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

   public $timestamps = false;

   use HasFactory;

   protected $fillable = [
        'name',
        'description',
        'quantity',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

}
