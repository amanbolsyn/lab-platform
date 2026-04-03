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

        $users = [
            [
                'fullname' => "user user",
                'email' => 'user@astanait.edu.kz',
                'password' => 'User123.',
                'role' => [
                    'user'
                ],
            ],
            [
                'fullname' => "admin admin",
                'email' => 'admin@astanait.edu.kz',
                'password' => 'Admin123.',
                'role' => [
                    'user',
                    'admin'
                ],
            ],
            [
                'fullname' => "root",
                'email' => 'root@astanait.edu.kz',
                'password' => 'Root123.',
                'role' => [
                    'user',
                    'admin',
                    'root'
                ],
            ]
        ];

        foreach ($users as $user) {
            $newUser = User::factory()->create([
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
            
            
            foreach($user['role'] as $role){ 
                $newUser->roles()->attach(Role::where('role', $role)->first()); 
            }
        }
    }
}
