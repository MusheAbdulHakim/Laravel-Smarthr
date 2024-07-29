<?php

namespace Modules\Accounting\Database\Factories;

use Modules\Accounting\Models\Budget;
use Modules\Accounting\Models\BudgetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseBudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Accounting\Models\ExpenseBudget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'budget_id' => Budget::factory(),
            'budget_category_id' => BudgetCategory::factory(),
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
            'amount' => $this->faker->numberBetween(10,100),
            'note' => $this->faker->paragraph()
        ];
    }
}

