<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->call([
                RoleSeeder::class,
                ProgramSeeder::class,
                UserSeeder::class,
                CategorySeeder::class,
                // ItemSeeder::class,
                // CartSeeder::class,
                // OrderSeeder::class,
            ]);
        });
    }
}
