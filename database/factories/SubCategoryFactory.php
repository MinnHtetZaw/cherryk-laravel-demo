<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'=> $this->faker->colorName,
            'name'=> $this->faker->name,
            'category_id'=> rand(1,5),
            'description'=> $this->faker->text(50),
        ];
    }
}
