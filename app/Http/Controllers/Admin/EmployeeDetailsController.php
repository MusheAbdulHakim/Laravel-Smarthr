<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use App\Enums\Payroll\SalaryType;
use App\Models\EmployeeEducation;
use App\Enums\Payroll\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryDetail;
use App\Models\EmployeeWorkExperience;
use App\Http\Controllers\BaseController;

class EmployeeDetailsController extends BaseController
{

    public function personalInfo(EmployeeDetail $employeeDetail)
    {
        return view('pages.employees.modals.personal-info', compact(
            'employeeDetail'
        ));
    }

    public function updatePersonalInfo(Request $request, EmployeeDetail $employeeDetail)
    {
        $employeeDetail->update([
            'passport_no' => $request->passport,
            'passport_expiry_date' => $request->expiry_date,
            'passport_tel' => $request->tel,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'ethnicity' => $request->ethnicity,
            'marital_status' => $request->marital_status,
            'spouse_occupation' => $request->spouse_occupation,
            'no_of_children' => $request->children,
            'dob' => $request->dob,
            'date_joined' => $request->date_joined, 
        ]);
        $notification = notify(__("Personal Information has been updated"));
        return back()->with($notification);
    }

    public function emergencyContacts(EmployeeDetail $employeeDetail)
    {
        return view('pages.employees.modals.emergency-contacts', compact(
            'employeeDetail'
        ));
    }

    public function updateEmergencyContacts(Request $request, EmployeeDetail $employeeDetail)
    {
        $employeeDetail->update([
            'emergency_contacts' => [
                'primary' => $request->primary,
                'secondary' => $request->secondary,
            ]
        ]);
        $notification = notify(__("Emergency contacts has been updated"));
        return back()->with($notification);
    }


    public function workExperience(EmployeeDetail $employeeDetail)
    {
        $experiences = $employeeDetail->workExperience;
        return view('pages.employees.modals.experience', compact(
            'employeeDetail',
            'experiences'
        ));
    }

    public function updateWorkExperience(Request $request, EmployeeDetail $employeeDetail)
    {
        $request->validate([
            'experience' => 'required',
        ]);
        $employeename = $employeeDetail->user->fullname;
        $employeeExperiences = $employeeDetail->workExperience;
        $experiences = $request->experience;
        foreach ($experiences as $i => $experience) {
            $fileName = null;
            $dir = public_path("storage/employees/" . $employeeDetail->emp_id . "/work-experience");
            $requestFile = $experience['file'] ?? null;
            if (!empty($requestFile)) {
                $fileName = random_str(7) . '.' . $requestFile->extension();
                $requestFile->move($dir, $fileName);
            }
            EmployeeWorkExperience::updateOrCreate([
                'employee_detail_id' => $employeeDetail->id,
                'id' => $experience['id'] ?? null,
                'company' => $experience['company'] ?? '',
                'location' => $experience['location'] ?? '',
            ], [
                'employee_detail_id' => $employeeDetail->id,
                'company' => $experience['company'] ?? '',
                'location' => $experience['location'] ?? '',
                'position' => $experience['position'] ?? '',
                'start_date' => $experience['start_date'] ?? '',
                'end_date' => $experience['end_date'] ?? '',
                'file' => $fileName,
            ]);
        }
        $notification = notify(__("Exployee Working experience has been updated"));
        return back()->with($notification);
    }

    public function salarySetting(Request $request, EmployeeDetail $employeeDetail)
    {
        $request->validate([
            'base_salary' => 'required|numeric',
            'pf_number' => 'nullable|required_if:pf_contribution,1|numeric',
            'total_pf_rate' => 'nullable|numeric',
            'esi_number' => 'nullable|required_if:esi_contribution,1',
            'addtional_esi_rate' => 'nullable|numeric',
            'total_esi_rate' => 'nullable|numeric',
        ]);
        EmployeeSalaryDetail::updateOrCreate([
            'id' => $request->salary_detail_id,
            'employee_detail_id' => $employeeDetail->id
        ],[
            'employee_detail_id' => $employeeDetail->id,
            'basis' => $request->basis ?? SalaryType::Monthly,
            'base_salary' => $request->base_salary,
            'payment_method' => $request->payment_method ?? PaymentMethod::BankTransfer,
            'pf_contribution' => $request->pf_contribution ?? 0,
            'pf_number' => $request->pf_number,
            'additional_pf' => $request->additional_pf_rate ?? 0.00,
            'total_pf_rate' => $request->total_pf_rate ?? 0.00,
            'esi_contribution' => $request->esi_contribution,
            'esi_number' => $request->esi_number,
            'additional_esi_rate' => $request->additional_esi_rate ?? 0.00,
            'total_additional_esi_rate' => $request->total_esi_rate ?? 0.00
        ]);
        $notification = notify(__('Salary details has been updated'));
        return back()->with($notification);
    }

    public function deleteWorkExperience(Request $request, EmployeeWorkExperience $experience)
    {
        $experience->delete();
        $notification = notify(__("Work experience has been deleted"));
        return back()->with($notification);
    }

    public function education(EmployeeDetail $employeeDetail)
    {
        $educations = $employeeDetail->education;
        return view('pages.employees.modals.education', compact(
            'employeeDetail',
            'educations'
        ));
    }

    public function updateEducation(Request $request, EmployeeWorkExperience $employeeDetail)
    {
        $educations = $request->education;
        foreach ($educations as $i => $education) {
            $fileName = null;
            $dir = public_path("storage/employees/" . $employeeDetail->emp_id . "/education");
            $requestFile = $education['file'] ?? null;
            if (!empty($requestFile)) {
                $fileName = random_str(7) . '.' . $requestFile->extension();
                $requestFile->move($dir, $fileName);
            }
            EmployeeEducation::updateOrCreate([
                'employee_detail_id' => $employeeDetail->id,
                'id' => $education['id'] ?? null,
            ], [
                'employee_detail_id' => $employeeDetail->id,
                'institution' => $education['start_date'] ?? '',
                'subject' => $education['subject'] ?? '',
                'course' => $education['course'] ?? '',
                'grade' => $education['grade'] ?? '',
                'start_date' => $education['start_date'] ?? '',
                'end_date' => $education['end_date'] ?? '',
                'file' => $fileName,
            ]);
        }
        $notification = notify(__("Employee education has been added"));
        return back()->with($notification);
    }

    public function deleteEducation(Request $request)
    {
        $education = EmployeeEducation::findOrFail($request->education);
        $education->delete();
        $notification = notify(__('Employee Education has beel deleted'));
        return back()->with($notification);
    }
}
