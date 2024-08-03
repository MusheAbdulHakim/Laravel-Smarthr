<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserType;
use App\Models\Payslip;
use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use Illuminate\Support\Carbon;
use App\Enums\Payroll\SalaryType;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeDeduction;
use App\Models\AttendanceTimestamp;
use App\DataTables\PayslipDataTable;
use App\Http\Controllers\Controller;
use App\Models\PayslipItem;
use Illuminate\Support\Facades\Crypt;

class PayrollsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PayslipDataTable $dataTable)
    {
        $pageTitle = __('Payslips');
        return $dataTable->render('pages.payroll.payslips.index',compact(
            'pageTitle',
        ));
    }

    public function items(){
        $pageTitle = __('Payroll Items');
        $allowances = EmployeeAllowance::get();
        $deductions = EmployeeDeduction::get();
        return view('pages.payroll.items',compact(
            'pageTitle','allowances','deductions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();
        return view('pages.payroll.payslips.create',compact(
            'employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'type' => 'required',
            'payslip_date' => 'nullable|date',
            'title' => 'required_if:type,contract',
            'from_date' => 'required_if:type,hourly',
            'weeks' => 'required_if:type,weekly',
        ]);

        $employee = EmployeeDetail::findOrFail($request->employee);
        $salaryInfo = $employee->salaryDetails;
        $deductions = 0;
        $allowances = 0;
        $total_hours = 0;
        $allowancesItems = null;
        $deductionItems = null;
        if(!empty($request->use_allowance)){
            $allowancesItems = EmployeeAllowance::where('employee_detail_id',$employee->id)->get();
            $allowances = $allowancesItems->sum('amount');
        }
        if(!empty($request->use_deductions)){
            $deductionItems = EmployeeDeduction::where('employee_detail_id',$employee->id)->get();
            $deductions = $deductionItems->sum('amount');
        }
        $net_pay = ($salaryInfo->base_salary + $allowances) - $deductions;
        if($request->type === SalaryType::Hourly){
            $total_hours = AttendanceTimestamp::where('user_id',$employee->user_id)->whereBetween('created_at',[Carbon::parse($request->from_date), Carbon::parse($request->to_date)])
                ->whereNotNull(['attendance_id','startTime','endTime'])->sum('totalHours');
            $hourly_pay = ($total_hours * $salaryInfo->base_salary);
            $net_pay = ($hourly_pay + $allowances) - $deductions;
        }
        if($request->type === SalaryType::Weekly){
            $weeks_salary = ($request->weeks * $salaryInfo->base_salary);
            $net_pay = ($weeks_salary + $allowances) - $deductions;
        }
        $payslip = Payslip::create([
            'ps_id' => pad_zeros(Payslip::count()+1),
            'title' => $request->title,
            'employee_detail_id' => $employee->id,
            'use_allowance' => !empty($request->use_allowance),
            'use_deduction' => !empty($request->use_deductions),
            'payslip_date' => $request->payslip_date,
            'type' => $request->type,
            'startDate' => $request->from_date,
            'endDate' => $request->to_date,
            'total_hours' => $total_hours,
            'weeks' => $request->weeks,
            'net_pay' => $net_pay,
        ]);
        if(!empty($allowancesItems)){
            PayslipItem::insert($allowancesItems->map(function(EmployeeAllowance $item) use($payslip){
                return [
                    'type' => 'allowance',
                    'payslip_id' => $payslip->id,
                    'item_id' => $item->id
                ];
            })->all());
        }
        if(!empty($deductionItems)){
            PayslipItem::insert($deductionItems->map(function(EmployeeDeduction $item) use($payslip){
                return [
                    'type' => 'deduction',
                    'payslip_id' => $payslip->id,
                    'item_id' => $item->id
                ];
            })->all());
        }
        $notification = notify(__('Payslip has been created'));
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payslip = Payslip::findOrFail(Crypt::decrypt($id));
        $pageTitle = $payslip->ps_id ?? __('Payslip');
        $currency = LocaleSettings('currency_symbol');
        $employee = $payslip->employee;
        $allowances = $payslip->allowances();
        $deductions = $payslip->deductions();
        return view('pages.payroll.payslips.show',compact(
            'payslip','pageTitle','currency','employee','allowances','deductions'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payslip $payslip)
    {
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();
        return view('pages.payroll.payslips.edit',compact(
            'employees','payslip'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payslip $payslip)
    {
        $request->validate([
            'employee' => 'required',
            'type' => 'required',
            'payslip_date' => 'nullable|date',
            'title' => 'required_if:type,contract',
            'from_date' => 'required_if:type,hourly',
            'weeks' => 'required_if:type,weekly',
        ]);

        $employee = EmployeeDetail::findOrFail($request->employee);
        $salaryInfo = $employee->salaryDetails;
        $deductions = 0;
        $allowances = 0;
        $total_hours = 0;
        $allowancesItems = null;
        $deductionItems = null;
        if(!empty($request->use_allowance)){
            $allowancesItems = EmployeeAllowance::where('employee_detail_id',$employee->id)->get();
            $allowances = $allowancesItems->sum('amount');
        }
        if(!empty($request->use_deductions)){
            $deductionItems = EmployeeDeduction::where('employee_detail_id',$employee->id)->get();
            $deductions = $deductionItems->sum('amount');
        }
        $net_pay = ($salaryInfo->base_salary + $allowances) - $deductions;
        if($request->type === SalaryType::Hourly){
            $total_hours = AttendanceTimestamp::where('user_id',$employee->user_id)->whereBetween('created_at',[Carbon::parse($request->from_date), Carbon::parse($request->to_date)])
                ->whereNotNull(['attendance_id','startTime','endTime'])->sum('totalHours');
            $hourly_pay = ($total_hours * $salaryInfo->base_salary);
            $net_pay = ($hourly_pay + $allowances) - $deductions;
        }
        if($request->type === SalaryType::Weekly){
            $weeks_salary = ($request->weeks * $salaryInfo->base_salary);
            $net_pay = ($weeks_salary + $allowances) - $deductions;
        }
        $payslip->update([
            'title' => $request->title,
            'employee_detail_id' => $employee->id,
            'use_allowance' => !empty($request->use_allowance),
            'use_deduction' => !empty($request->use_deductions),
            'payslip_date' => $request->payslip_date,
            'type' => $request->type,
            'startDate' => $request->from_date,
            'endDate' => $request->to_date,
            'total_hours' => $total_hours,
            'weeks' => $request->weeks,
            'net_pay' => $net_pay,
        ]);
        if(!empty($allowancesItems)){
            PayslipItem::insert($allowancesItems->map(function(EmployeeAllowance $item) use($payslip){
                return [
                    'type' => 'allowance',
                    'payslip_id' => $payslip->id,
                    'item_id' => $item->id
                ];
            })->all());
        }
        if(!empty($deductionItems)){
            PayslipItem::insert($deductionItems->map(function(EmployeeDeduction $item) use($payslip){
                return [
                    'type' => 'deduction',
                    'payslip_id' => $payslip->id,
                    'item_id' => $item->id
                ];
            })->all());
        }
        $notification = notify(__('Payslip has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payslip $payslip)
    {
        $payslip->delete();
        $notification = notify(__('Payslip has been deleted'));
        return back()->with($notification);
    }
}
