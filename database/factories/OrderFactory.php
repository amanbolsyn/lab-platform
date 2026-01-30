<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\User;
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
            'user_id' => User::inRandomOrder()->value('id'),
            'item_id' => Inventory::inRandomOrder()->value('id'),
            'quantity' => fake()->randomDigit(4),
            'purpose' => fake()->sentence(10),
            'status' => fake()->randomElement(Order::STATUS_LEVELS),
            'due_date' => fake()->dateTimeBetween('now', '+5 days')
        ];
    }
}
