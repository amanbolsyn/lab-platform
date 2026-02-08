<?php

use App\Models\Role;
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
        Schema::create('roles', function(Blueprint $table){
              $table->id();
              $table->enum('role', Role::ROLES)->unique();
              $table->timestamps();
        });


        Schema::create('user_roles', function(Blueprint $table){
                $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
                $table->foreignIdFor(Role::class, 'role_id')->constrained()->cascadeOnDelete();
                $table->primary('user_id', 'role_id');
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
