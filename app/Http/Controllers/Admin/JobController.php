<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Department;
use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "jobs";
        $jobs = Job::with('department')->get();
        $departments = Department::get();
        return view('backend.jobs',compact(
            'title','departments','jobs'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'department'=>'required',
            'location'=>'required',
            'vacancies'=>'required',
            'experience'=>'required',
            'age'=>'nullable',
            'salary_from'=>'nullable',
            'salary_to'=>'nullable',
            'type'=>'required',
            'status'=>'required',
            'start_date'=>'required',
            'expire_date'=>'required',
            'description'=>'required',
        ]);
        Job::create($request->all());
        return back()->with('success',"Job has been added Posted!!");
    }

    public function applicants(){
        $title = 'Job Applicants';
        $applicants = JobApplicant::with('Job')->latest()->get();
        return view('backend.job-applicants',compact(
            'title','applicants'
        ));
    }

    public function downloadCv(Request $request){
        $pathToFile = public_path('storage/cv/'. $request->cv);
        return response()->download($pathToFile)->with('success',"Applicant cv has been downloaded");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function destroy($id)
    {
        //
    }
}
