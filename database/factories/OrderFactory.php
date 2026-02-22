<?php

namespace Database\Factories;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
            'user_Id' => User::factory(),
            'number' => fake()->unique()->numerify('ORD-########'),
            'status' => fake()->randomElement(OrderStatusEnum::cases())->value,
            'total_price' => fake()->randomFloat(2, 20, 2000),
            'shipping_price' => fake()->optional()->randomFloat(2, 0, 200),
            'nots' => fake()->sentence(12),
        ];
    }
}
