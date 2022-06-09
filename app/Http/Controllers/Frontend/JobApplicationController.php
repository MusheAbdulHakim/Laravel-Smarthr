<?php

namespace App\Http\Controllers\Frontend;

use App\Models\JobApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:200',
            'email' => 'required|email',
            'cv' => 'required|file|mimes:pdf',
            'message' => 'nullable|max:255|min:10',
        ]);
        if($request->hasFile('cv')){
            $cv = time().'.'.$request->cv->extension();
            $request->cv->move(public_path('storage/cv'), $cv);
        }
        JobApplicant::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'cv' => $cv
        ]);
        return back()->with('success',"Your application has been sent!!");
    }

    
}
