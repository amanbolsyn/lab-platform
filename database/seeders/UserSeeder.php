<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rootUser = User::factory()->create([
            'fullname' => env('APP_ROOT_USER'),
            'email' => env('APP_ROOT_EMAIL'),
            'password' => env('APP_ROOT_PW'),
        ]);

        if (empty($rootUser['fullname']) || empty($rootUser['email']) || empty($rootUser['password'])) {
            throw new \InvalidArgumentException('Missing required root user credentials.');
        }
        $roleIds = Role::whereIn('role', ['user', 'admin', 'root'])->pluck('id');
        $rootUser->roles()->attach($roleIds);
    }
}
