<?php

namespace Modules\Accounting\Database\Factories;

use Modules\Project\Models\Project;
use Modules\Accounting\Models\Budget;
use Modules\Accounting\Models\ExpenseBudget;
use Modules\Accounting\Models\RevenueBudget;
use Modules\Accounting\Models\BudgetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['category', 'project']),
            'startDate' => $this->faker->dateTimeBetween("-30 days"),
            'endDate' => $this->faker->dateTimeBetween("-30 days","+30 days"),
            'taxes' => $this->faker->numberBetween(1,10),
            'note' => $this->faker->paragraph(),
            'created_at' => $this->faker->date(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function(Budget $budget){
            if($budget->type == 'project'){
                $budget->project_id = Project::inRandomOrder()->first()-> id ?? Project::factory()->create()->id;
            }
            if($budget->type == 'category'){
                $budget->budget_category_id = BudgetCategory::inRandomOrder()->first()-> id ?? BudgetCategory::factory()->create()->id;
            }
            $revenue = RevenueBudget::factory()->count(4)->state([
                'budget_id' => $budget->id
            ])->create();
            $expenses = ExpenseBudget::factory()->count(2)->state([
                'budget_id' => $budget->id
            ])->create();
            $profit = $revenue->sum('amount') - $expenses->sum('amount');
            $amount = $profit - $budget->taxes;
            $budget->amount = $amount;
            $budget->total_revenue = $revenue->sum('amount');
            $budget->total_expense = $expenses->sum('amount');
            $budget->save();
            return $budget;
        });
    }
}

