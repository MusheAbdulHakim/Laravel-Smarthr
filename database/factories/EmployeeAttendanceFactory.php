<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeAttendanceFactory extends Factory
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
            'type' => $this->faker->randomElement(['checkin','checkout']),
            'time' => $this->faker->dateTimeBetween(),
            'status' => null,
        ];
    }
}
