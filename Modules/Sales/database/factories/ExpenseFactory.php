<?php

namespace Modules\Sales\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Sales\Models\Expense::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->word(),
            'purchased_from' => $this->faker->company,
            'purchase_date' => $this->faker->date(),
            'amount' => $this->faker->numberBetween(10,500),
            'status' => $this->faker->randomElement([1,0]),
            'paid_by' => $this->faker->randomElement([1,2,3]),
            'created_by' => auth()->user()->id
        ];
    }
}

