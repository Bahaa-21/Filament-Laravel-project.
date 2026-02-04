<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2,true),
            'url' => fake()->optional()->url(),
            'primary_hax' => fake()->optional()->hexColor(),
            'is_visible' => fake()->boolean(5),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
