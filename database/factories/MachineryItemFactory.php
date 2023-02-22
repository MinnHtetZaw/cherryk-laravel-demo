<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MachineryItem>
 */
class MachineryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'=>$this->faker->city,
            'name'=>$this->faker->name,
            'description'=> $this->faker->text(50),
            'brand_id'=>rand(1,50),
            'per_unit_qty'=> 1,
            'selling_price'=>rand(15000, 45000),
        ];
    }
}
