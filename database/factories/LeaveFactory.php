<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveFactory extends Factory
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
            'leave_type_id' => LeaveType::factory(),
            'from' => $this->faker->dateTimeThisMonth(),
            'to'  => $this->faker->dateTimeBetween(),
            'reason' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['Approved','Pending','Declined']),
        ];
    }
}
