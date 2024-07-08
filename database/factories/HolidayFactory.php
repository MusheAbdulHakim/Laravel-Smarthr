<?php

namespace Database\Factories;

use App\Enums\CalendarColors;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(30),
            'startDate' => $this->faker->dateTimeThisYear(),
            'endDate' => $this->faker->dateTimeBetween(),
            'description' => $this->faker->sentence(),
            'is_annual' => $this->faker->randomElement([1,0]),
            'color' => CalendarColors::Primary,
        ];
    }
}
