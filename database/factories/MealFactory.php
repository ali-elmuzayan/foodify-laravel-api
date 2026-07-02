<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends Factory<Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'carb' => $this->faker->randomFloat(2, 0, 100),
            'protein' => $this->faker->randomFloat(2, 0, 100),
            'fat' => $this->faker->randomFloat(2, 0, 100),
            'calories' => $this->faker->randomFloat(2, 0, 100),
            'ingredients' => $this->faker->sentence(),
            'kcal' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'category_id' => $this->faker->randomElement($categories),
        ];
    }
}
