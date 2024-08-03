<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use App\Models\Payslip;
use App\Models\EmployeeDetail;
use Illuminate\Support\Carbon;
use App\Enums\Payroll\SalaryType;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeDeduction;
use App\Models\AttendanceTimestamp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payslip>
 */
class PayslipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ps_id' => null,
            'title' => null,
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
            'use_allowance' => $this->faker->randomElement([true, false]),
            'use_deduction' => $this->faker->randomElement([true, false]),
            'payslip_date' => $this->faker->date(),
            'weeks' => $this->faker->numberBetween(0,4),
            'type' => $this->faker->randomElement(SalaryType::cases()),
            'total_hours' => null,
            'net_pay' => null,
            'startDate' => $this->faker->dateTimeBetween('-30 days'),
            'endDate' => $this->faker->dateTimeBetween("-30 days"),
            'created_at' => $this->faker->date(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function(Payslip $payslip){
            $employee = $payslip->employee;
            $salaryInfo = $employee->salaryDetails;
            $base_salary = $salaryInfo->base_salary ?? 0;
            $deductions = 0;
            $allowances = 0;
            $total_hours = 0;
            $allowancesItems = null;
            $deductionItems = null;
            $net_pay = 0;
            if(!empty($payslip->use_allowance)){
                $allowancesItems = EmployeeAllowance::where('employee_detail_id',$payslip->employee_detail_id)->get();
                $allowances = $allowancesItems->sum('amount');
            }
            if(!empty($payslip->use_deductions)){
                $deductionItems = EmployeeDeduction::where('employee_detail_id',$payslip->employee_detail_id)->get();
                $deductions = $deductionItems->sum('amount');
            }
            $net_pay = ($base_salary + $allowances) - $deductions;
            if($payslip->type === SalaryType::Hourly){
                $total_hours = AttendanceTimestamp::where('user_id',$employee->user_id)->whereBetween('created_at',[Carbon::parse($payslip->startDate), Carbon::parse($payslip->endDate)])
                    ->whereNotNull(['attendance_id','startTime','endTime'])->sum('totalHours');
                $hourly_pay = ($total_hours * $base_salary);
                $net_pay = ($hourly_pay + $allowances) - $deductions;
            }
            if($payslip->type === SalaryType::Weekly){
                $weeks_salary = ($payslip->weeks * $base_salary);
                $net_pay = ($weeks_salary + $allowances) - $deductions;
            }
            $payslip->update([
                'ps_id' => pad_zeros(Payslip::count()+1),
                'title' => "Payslip for $payslip->payslip_date",
                'net_pay' => $net_pay,
                'total_hours' => $total_hours
            ]);
        });
    }
}
