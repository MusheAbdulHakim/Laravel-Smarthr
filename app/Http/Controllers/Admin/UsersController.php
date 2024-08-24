<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = __('Users');
        return $dataTable->render('pages.users.index', compact(
            'pageTitle'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('pages.users.create',compact(
            'roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'nullable|string',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,except,id',
            'password' => 'required|string|confirmed',
            'status' => 'required',
        ]);
        $imageName = null;
        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user = User::create([
            'type' => UserType::SUPERADMIN,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address,
            'country' => $request->country_name,
            'country_code' => $request->country_code,
            'dial_code' => $request->dial_code,
            'phone' => $request->phone,
            'avatar' => $imageName,
            'created_by' => auth()->user()->id,
            'is_active' => !empty($request->status),
            'password' => Hash::make($request->password)
        ]);
        if($request->has('role') && !empty($request->input('role'))){
            $user->assignRole($request->role);
        }
        $notification = notify(__('User has been created'));
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::get();

        return view('pages.users.edit', compact(
            'user','roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'nullable|string|confirmed',
            'status' => 'required',
        ]);
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
            'is_active' => !empty($request->status) ?? $user->is_active,
            'password' => !empty($request->password) ? Hash::make($request->password) : $user->password
        ]);
        if($request->has('role') && !empty($request->input('role'))){
            $user->syncRoles($request->role);
        }
        $notification = notify(__('User has been updated'));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $notification = notify(__('User has been deleted'));
        return redirect()->route('users.index')->with($notification);
    }
}
