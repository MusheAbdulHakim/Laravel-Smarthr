<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->realText(30),
            'tk_id' => ('TKT-'.$this->faker->numberBetween(0001,1000)),
            'employee_id' => Employee::factory(),
            'client_id' => Client::factory(),
            'priority' => $this->faker->randomElement(['high','low','medium']),
            'cc' => $this->faker->word(),
            'followers' => $this->faker->randomElements(Employee::pluck('id')),
            'files' => null,
            'status' => $this->faker->randomElement(['Closed','Opened','OnHold','Reopen','InProgress']),
            'description' => $this->faker->realTextBetween(255,300)
        ];
    }
}
