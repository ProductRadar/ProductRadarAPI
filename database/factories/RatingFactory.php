<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::pluck('id')->toArray();
        $product = \App\Models\Product::pluck('id')->toArray();
        return [
            'rating' => fake()->randomFloat(2,1, 5),
            'user_id' => $this->faker->randomElement($user),
            'product_id' => $this->faker->randomElement($product)
        ];
    }
}
