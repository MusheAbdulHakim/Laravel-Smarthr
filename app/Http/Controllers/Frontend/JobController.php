<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index(){
        $title = "Jobs";
        $jobs = Job::with('department')->get();
        return view('frontend.job-list',compact(
            'title','jobs'
        ));
    }

    public function show(Job $job){
        $title = "Job View";
        return view('frontend.job-view',compact(
            'title','job'
        ));
    }
}
