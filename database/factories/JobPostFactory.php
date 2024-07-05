<?php

namespace Database\Factories;

use App\Models\JobPost;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostFactory extends Factory
{
    protected $model = JobPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'department_id' => Department::factory(),
            'location' => $this->faker->address(),
            'vacancies' => $this->faker->numberBetween(1,10),
            'experience' => $this->faker->numberBetween(1,5),
            'age' => $this->faker->numberBetween(19,50),
            'salary_from' => $this->faker->numberBetween(100,1000),
            'salary_to'=> $this->faker->numberBetween(101,1001),
            'type' => $this->faker->randomElement(['Full Time','Part Time','Internship','Temporary','Remote','Others']),
            'status' => $this->faker->randomElement(['Open','Cancelled','Closed']),
            'start_date' => $this->faker->date(),
            'expire_date' => $this->faker->date(),
            'description' => $this->faker->realTextBetween(),
        ];
    }
}
