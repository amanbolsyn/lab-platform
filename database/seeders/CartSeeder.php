<?php

namespace Database\Seeders;

use App\Models\Cart as ModelsCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsCart::factory(10)->create(); 
    }
}
