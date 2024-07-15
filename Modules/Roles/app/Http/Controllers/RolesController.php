<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Crypt;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id = null)
    {
        $pageTitle = 'Roles and Permissions';
       
        $roles = Role::with(['permissions'])->get();

        $selected_role = null;
        if(!empty($id)){
            $decrypted_id = Crypt::decrypt($id);
            $selected_role = Role::find($decrypted_id);
        }
        $permissions = [];

        $permissionArray = Permission::orderBy('module')->get();
        foreach ($permissionArray as $item) {
            $module = $item->module;
            $permission = $item->name;
            $permissions[$module][] = $permission;
        }
        return view('roles::index',compact(
            'pageTitle','roles','selected_role','permissions'
        ));
    }

    public function create(Request $request){
        return view('roles::create');
    }

    public function edit(Request $request, Role $role){
        return view('roles::edit', compact(
            'role'
        ));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::create(['name' => $request->name]);
        $notification = notify('role created successfully');
        return back()->with($notification);
    }


    public function updatePermission(Request $request, Role $role){
        $request->validate([
            'permissions' => 'required',
        ],[
            'permissions.required' => 'Select atleast one permission'
        ]);
        $role->syncPermissions($request->permissions);
        $notification = notify("permissions has been updated");
        return back()->with($notification);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::findOrFail($request->id);
        $role->update([
            'name' => $request->name
        ]);
        $notification = notify("Role has been updated");
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Renderable
     */
    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        $notification = notify("Role has been deleted");
        return back()->with($notification);
    }
}
