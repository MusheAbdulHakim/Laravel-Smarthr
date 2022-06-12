<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class OvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'overtime_date' => $this->faker->dateTimeBetween('+2 days','+30 days'),
            'hours' => $this->faker->numberBetween(1,5),
            'description' => $this->faker->paragraph(),
        ];
    }
}
