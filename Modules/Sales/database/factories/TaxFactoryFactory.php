<?php

namespace Modules\Sales\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Sales\Models\Tax::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'percentage' => $this->faker->numberBetween(0,100),
            'active' => $this->faker->randomElement(1, 0)
        ];
    }
}

