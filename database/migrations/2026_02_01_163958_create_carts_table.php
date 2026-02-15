<?php

use App\Models\Cart;
use App\Models\User;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
              $table->foreignIdFor(User::class, 'user_id'); 
              $table->string('purpose');
              $table->enum('status', Cart::STATUS_LEVELS)->default('pending');
              $table->date('due_date'); 
              $table->string('comment'); 
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
