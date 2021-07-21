<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Notifications\NewUserNotification;

class RegisterController extends Controller
{
    public function index(){
        $title = "Register";
        return view('auth.register',compact('title'));
    }

    public function store(RegisterRequest $request){
        
        $imageName = null;
        if($request->avatar){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $imageName);
        }
        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'avatar'=>$imageName,
        ]); 
        $user->notify(new NewUserNotification($user)); 
        auth()->attempt($request->only('username','password'));
        return redirect()->route('dashboard');
            
    }
}
