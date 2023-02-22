<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'=> $this->faker->city,
            'name'=> $this->faker->company,
            'category_id'=>rand(1,5),
            'sub_category_id'=>rand(1,35),
            'description'=> $this->faker->address,
        ];
    }
}
