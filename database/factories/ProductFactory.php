<?php

namespace Database\Factories;

use App\Enum\ProductStatusEnum;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'price' => fake()->randomFloat(2, 10, 2000),
            'description' => fake()->optional()->text(100),
            'status' => fake()->randomElement(ProductStatusEnum::cases())->value,
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'sku' => fake()->unique()->bothify('SKU-#####'),
            'slug' => fake()->unique()->slug(),
            'quantity' => fake()->numberBetween(0, 100),
            'image' => fake()->imageUrl(),
            'is_visible' => fake()->boolean(70),
            'is_featured' => fake()->boolean(20),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
