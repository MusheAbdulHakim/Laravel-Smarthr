<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\{Salaries,SalaryGrades, Overtime, EmployeeAttendance, PayrollHistory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;
use PDF;
use Session;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title="Salary Scales";
        $salaries = SalaryGrades::get();
        return view('backend.salaries.add_salary_scale', compact('salaries', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function run_payroll()
    {
        //
        return view('backend.salaries.run_payroll', [
            'title' => 'Employee Salary',
            'employees' => Salaries::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'salary_scale'=>'required|string|max:255',
            'salary_amount'=>'required|numeric',
            'salary_currency'=>'required|string'
        ]);

        SalaryGrades::create([
            'salary_scale'=>$request->salary_scale,
            'salary_amount'=>$request->salary_amount,
            'salary_currency'=>$request->salary_currency

        ]);
        return back()->with('success', "Salary Scale has been added successfully!!");
    }






/**
     * Compile Payroll.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function compile_payroll(Request $request)
    {
        $date = explode(' - ', $request->date);
        $start_date = date("Y-m-d", strtotime($date[0]));
        $end_date = date("Y-m-d", strtotime($date[1]));
        $monthYear = date('F-Y', strtotime($end_date));


        $payslips = $this->payroll($request);




        foreach ($payslips as $payslip) {
            set_time_limit(180);


            $pdf = PDF::loadView("backend.salaries.export_toPDF", [

                'payslip'=> $payslip,
                'date'=> $request->date,
                'salarie'=> Salaries::where('employee_id', "=", $payslip->id)->first(),
                "overtimes" => Overtime::whereBetween("overtime_date", [$start_date,$end_date])->get(),
                'monthYear' => date('F-Y', strtotime($end_date)),
                'payDay' => date('d F Y', strtotime($end_date))
            ]);
            $password = str_replace('-', '', $payslip->uuid);
            $pdf->setEncryption($password);

            $fileName = $payslip->uuid.'.pdf';
            $monthYear = date('F-Y', strtotime($end_date));
            Storage::disk("payslips")->put("$monthYear/".$fileName, $pdf->output());
            //return \json_encode('Payslips Compiled Successfully');
        }
        return response()->json([
            'status'=>true,
            "message"=>"You have successfully! Compiled the PAYROLL For $monthYear, You can now download the payslips"

            ]);
    }



    private function payroll(Request $request)
    {
        $date = explode(' - ', $request->date);

        $start_date = date("Y-m-d", strtotime($date[0]));
        $end_date = date("Y-m-d", strtotime($date[1]));

        $attendances = EmployeeAttendance::whereBetween("created_at", [$start_date,$end_date])->pluck('employee_id')->toArray();
        $empIds = array_unique($attendances);

        $payslips = Employee::get();

        return $payslips;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */






     // Downloading compiled slips in ZIP Now

    public function download_payslips_show(Request $request)
    {
        return View("backend.salaries.download_payslips", [
            'title' => 'DOwnloading Payslips'
        ]);
    }




    public function download_payslips_compressed(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        //$requesDt = date('F-Y');
        $requestDt = $month."-".$year;
        $zip = new ZipArchive();

        $fileName = "$requestDt.zip";
        try {
            if ($zip->open(public_path("PAYSLIPS/$fileName"), ZipArchive::CREATE) === true) {
                $files = File::files(public_path("PAYSLIPS/$requestDt"));


                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }

                $zip->close();
            }

            return response()->download(public_path("PAYSLIPS/$fileName"));
        } catch(\Throwable $e) {
            Session::flash('warning_no_payslips', 'No Payslip found for the Month and Year Selected');
            return redirect()->back();
        }
    }



// Payroll Summary Report IN PDF
public function payroll_summary_report()
{
    $pdf = PDF::loadView(
        "backend.salaries.payroll_summary_report",
        [
         'payroll_summary_report' => PayrollHistory::get()

]
    );

    $fileName = "payroll-".date("d-M-Y")."-".time().'.pdf';
    return $pdf->download($fileName);
}










    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
        $client=SalaryGrades::findOrFail($request->id);
        $client->delete();
        return back()->with('success', "Salary Grade has been deleted successfully!!");
    }
}
