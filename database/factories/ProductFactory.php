<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => fake()->userName(),
            'description' => fake()->text(),
            'image' => "image location",
            'price' => fake()->numberBetween(1, 1000),
            'rating' => fake()->numberBetween(1, 5)
        ];
    }
}