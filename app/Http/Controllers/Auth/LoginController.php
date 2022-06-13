<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $title = "Login";
        return view('auth.login',compact('title'));
    }

    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $authenticate = auth()->attempt($request->only('email','password'));
        if(!$authenticate){
            return back()->with('login_error',"Invalid Login Credentials");
        }
        return redirect()->route('dashboard');
    }
    
}
