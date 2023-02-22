<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Symfony\Component\Translation\t;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id'=> 'CI00'.rand(1,100),
            'name'=>$this->faker->name,
            'age'=>rand(17,50),
            'gender'=>$this->faker->randomElement(['male','female']),
            'date_of_birth'=>$this->faker->date,
            'occupation'=>$this->faker->jobTitle,
            'phone'=>$this->faker->phoneNumber,
            'photo'=>'user-default.png',
            'drug_allergy'=>$this->faker->city,
            'address'=>$this->faker->address,
        ];
    }
}
