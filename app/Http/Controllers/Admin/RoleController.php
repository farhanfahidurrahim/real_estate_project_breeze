<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Contracts\Role as ContractsRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allPermission()
    {
        $permission = Permission::all();
        return view('backend.admin.permission.all_permission', compact('permission'));
    }

    public function addPermission(Request $request)
    {
        return view('backend.admin.permission.add_permission');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => "Permission Created Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    //< ========================= Role ======================== >

    public function allRole()
    {
        $roles = Role::all();
        return view('backend.admin.role.all_role', compact('roles'));
    }


    public function addRole(Request $request)
    {
        return view('backend.admin.role.add_role');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => "Role Created Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function allRolePermission()
    {
        $roles = Role::all();

        return view('backend.admin.role.all_role_permission', compact('roles'));
    }

    public function addRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permissionGroupNames = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return view('backend.admin.role.add_role_permission', compact('roles', 'permissions', 'permissionGroupNames'));
    }

    public function storeRolePermission(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => "Role Permission Created Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.role.permission')->with($notification);
    }

    public function editRolePermission($id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissionGroupNames = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return view('backend.admin.role.edit_role_permission', compact('roles', 'permissions', 'permissionGroupNames'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
