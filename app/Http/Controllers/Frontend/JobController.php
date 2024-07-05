<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobPost;

class JobController extends Controller
{
    public function index(){
        $title = "Jobs";
        $jobs = JobPost::with('department')->get();
        return view('frontend.job-list',compact(
            'title','jobs'
        ));
    }

    public function show(JobPost $job){
        $title = "Job View";
        return view('frontend.job-view',compact(
            'title','job'
        ));
    }
}
