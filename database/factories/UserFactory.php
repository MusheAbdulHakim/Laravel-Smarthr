<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Str;
use App\Enums\MaritalStatus;
use App\Models\EmployeeDetail;
use App\Enums\Payroll\SalaryType;
use App\Enums\Payroll\PaymentMethod;
use App\Models\EmployeeSalaryDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->userName(),
            'lastname' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'type' => $this->faker->randomElement(UserType::cases()),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'country_code' => $this->faker->countryCode(),
            'dial_code' => $this->faker->countryISOAlpha3(), 
            'phone' => $this->faker->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_active' => $this->faker->randomElement([1,0]),
        ];
    }

   
    public function configure(): static
    {
        return $this->afterCreating(function (User $user){
            if($user->type === UserType::EMPLOYEE){
                $totalEmployees = User::where('type', UserType::EMPLOYEE)->where('is_active', true)->count();
                $empId = "EMP-" . pad_zeros(($totalEmployees + 1));
                $details = EmployeeDetail::create([
                    'emp_id' => $empId,
                    'user_id' => $user->id,
                    'dob' => $this->faker->dateTimeBetween()->format('Y-m-d'),
                    'date_joined' => $this->faker->date(),
                    'no_of_children' => $this->faker->numberBetween(0,10),
                    'spouse_occupation' => $this->faker->jobTitle(),
                    'marital_status' => $this->faker->randomElement(MaritalStatus::cases()),
                    'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory()->create()->id,
                    'designation_id' => Designation::inRandomOrder()->first()->id ?? Designation::factory()->create()->id,
                ]);
                EmployeeSalaryDetail::factory()->count(1)->create([
                    'employee_detail_id' => $details->id,
                ]);
            }
        });
    }
}
