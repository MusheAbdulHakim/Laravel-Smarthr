<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeAllowance>
 */
class EmployeeAllowanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_detail_id' => User::inRandomOrder()
                ->where('type', UserType::EMPLOYEE)
                ->whereHas('employeeDetail')
                ->first()
                ->employeeDetail()->id 
            ?? User::factory()->create([
                'type' => UserType::EMPLOYEE,
            ])->id, 
            'name' => $this->faker->word(),
            'amount' => $this->faker->numberBetween(10,100),
        ];
    }
}
