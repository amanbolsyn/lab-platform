<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'cart_id' => Cart::inRandomOrder()->value('id'),
            'item_id' => Item::inRandomOrder()->value('id'),
            'quantity' => fake()->randomDigit(4),
        ];
    }
}
