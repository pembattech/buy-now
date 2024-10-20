<?php

namespace Database\Factories;

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
        $categories = [
            'Mobile Phones',
            'Laptops',
            'Tablets',
            'Televisions',
            'Cameras',
            'Headphones',
            'Smart Watches',
            'Speakers',
            'Gaming Consoles',
            'Accessories'
        ];
        

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category' => $this->faker->randomElement($categories),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
