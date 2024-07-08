<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $pageTitle = __('Profile');
        return view('pages.profile', compact(
            'user',
            'pageTitle'
        ));
    }

    public function edit(Request $request)
    {
        $user = auth()->user();
        return view('pages.profile.edit', compact(
            'user'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $user = User::findOrFail(auth()->user()->id);
        $imageName = $user->avatar;
        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user->update([
            'firstname' => $request->firstname ?? $user->firstname,
            'middlename' => $request->middlename ?? $user->middlename,
            'lastname' => $request->lastname ?? $user->lastname,
            'email' => $request->email ?? $user->email,
            'username' => $request->username ?? $user->username,
            'address' => $request->address ?? $user->address,
            'country' => $request->country_name ?? $user->country,
            'country_code' => $request->country_code ?? $user->country_code,
            'dial_code' => $request->dial_code ?? $user->dial_code,
            'phone' => $request->phone ?? $user->phone,
            'avatar' => $imageName,
        ]);
        $notification = notify(__('Profile has been updated'));
        return redirect()->route('profile')->with($notification);
    }
}
