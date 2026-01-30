<?php

use App\Models\User;
use App\Models\Inventory; 
use App\Models\Order;
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
          Schema::create('orders', function(Blueprint $table){
              $table->id();
              $table->foreignIdFor(User::class, 'user_id');
              $table->foreignIdFor(Inventory::class, 'item_id'); 
              $table->integer('quantity');
              $table->string('purpose');
              $table->enum('status', Order::STATUS_LEVELS)->default('pending');
              $table->date('due_date'); 
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
