<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tagTitles = [
            'New Arrival',
            'Sale',
            'Popular',
            'Trending',
            'Exclusive',
            'Limited Edition',
            'Bestseller',
            'Featured',
            'Eco-Friendly',
            'Top Rated'
        ];
        return [
            'name' => fake()->unique()->randomElement($tagTitles)
        ];
    }
}
