<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use App\Enums\Payroll\SalaryType;
use App\Enums\Payroll\PaymentMethod;
use App\Models\EmployeeSalaryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSalaryDetail>
 */
class EmployeeSalaryDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_detail_id' => User::whereHas('employeeDetail')
                ->inRandomOrder()
                ->where('is_active', true)
                ->where('type', UserType::EMPLOYEE)
                ->first()
                ->employeeDetail->id
                ??
            User::factory()->create([
                'type' => UserType::EMPLOYEE
            ])->first()->employeeDetail->id,
            'basis' => $this->faker->randomElement(SalaryType::cases()),
            'base_salary' => $this->faker->numberBetween(500,1000),
            'payment_method' => $this->faker->randomElement(PaymentMethod::cases()),
            'pf_contribution' => $this->faker->randomElement([true, false]),
            'pf_number' => $this->faker->numberBetween(1000),
            'additional_pf' => $this->faker->numberBetween(0,10),
            'total_pf_rate' => null,
            'esi_contribution' => $this->faker->randomElement([true, false]),
            'esi_number' => $this->faker->numberBetween(1000),
            'additional_esi_rate' => $this->faker->numberBetween(0,10),
            'total_additional_esi_rate' => null,
        ];
    }

    public function configure(): static 
    {
        return $this->afterCreating(function(EmployeeSalaryDetail $detail){
            $detail->update([
                'total_pf_rate' => $detail->additional_pf + (SalarySettings('emp_pf_percentage') ?? 0),
                'total_additional_esi_rate' => $detail->additional_esi_rate + SalarySettings('emp_esi_percentage') ?? 0
            ]);
        });
    }
}
