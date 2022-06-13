<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'client_id' => Client::factory(),
            'start_date' => $this->faker->dateTimeBetween(),
            'end_date' => $this->faker->dateTimeBetween('+30'),
            'rate' => $this->faker->numberBetween(20,1000),
            'rate_type' => $this->faker->randomElement(['Hour','Fixed']),
            'priority' => $this->faker->randomElement(['High','Medium','Low']),
            'leader' => Employee::factory(),
            'team' => $this->faker->randomElements(Employee::pluck('id')),
            'description' => $this->faker->realTextBetween(255,300),
            'files' => '',
            'progress' => $this->faker->numberBetween(1,100),
            'status' => $this->faker->randomElement([true,false])
        ];
    }
}
