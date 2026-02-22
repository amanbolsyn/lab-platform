<?php

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255); 
            $table->timestamps();
        });


        Schema::create('category_item', function(Blueprint $table){
            $table->foreignIdFor(Item::class, 'item_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class, 'category_id')->constrained()->cascadeOnDelete();
            $table->primary(['item_id', 'category_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
