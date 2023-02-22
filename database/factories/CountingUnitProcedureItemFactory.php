<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CountingUnitProcedureItem>
 */
class CountingUnitProcedureItemFactory extends Factory
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
            'current_qty'=>1,
            'reorder_qty'=>1,
            'selling_price'=>rand(10000,45000),
            'purchase_price'=>rand(5000,30000),
            'selling_percent'=>rand(10,30),
            'per_unit_qty'=> rand(5,50),
            'to_unit'=>rand(20,70),
            'from_unit'=>rand(5,10),
            'procedure_item_id'=>rand(1,30),
            'description'=> $this->faker->text(30),
        ];
    }
}
