<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalarySettingController extends Controller
{
    public function index(){
        $title = "Salary Settings";
        return view('backend.salary-settings',compact('title'));
    }
}
