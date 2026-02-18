<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(7),
            'quantity' => fake()->randomDigit(10),
            'external_links' => fake()->sentence(10),
            'comment' => fake()->sentence(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($item) {

            $categories = Category::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id');

            $item->categories()->attach($categories);
        });
    }
}
