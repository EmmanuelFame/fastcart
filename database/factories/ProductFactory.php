<?php

namespace Database\Factories;

use App\Models\Product; // ← Add this
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class; // ← Add this

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(12),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'image' => 'https://picsum.photos/400/300?random=' . uniqid(),

        ];
    }
}
