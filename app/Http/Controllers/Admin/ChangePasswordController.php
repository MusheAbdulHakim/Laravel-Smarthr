<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(){
        $title = "Change Password";
        return view('backend.change-password',compact('title'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if(password_verify($request->old_password,auth()->user()->password)){
            auth()->user()->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success',"User password changed .");
        }else{
            return back()->with('danger',"Wrong old password!!!");
        }
    }
}
