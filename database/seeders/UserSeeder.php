<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('role', 'user')->first();
        $adminRole = Role::where('role', 'admin')->first();
       
        // Create normal users
        User::factory(10)->create()->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole->id);
        });

        // Create one admin
        $admin = User::factory()->create([
            'fullname' => "admin admin",
            'email' => 'admin@astanait.edu.kz',
            'password' => 'admin123', 
        ]);

        $admin->roles()->attach($adminRole->id);

    }
}
