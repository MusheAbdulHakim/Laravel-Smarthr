<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'percentage' => $this->faker->numberBetween(0,100),
            'status' => $this->faker->randomElement(['active','inactive'])
        ];
    }
}
