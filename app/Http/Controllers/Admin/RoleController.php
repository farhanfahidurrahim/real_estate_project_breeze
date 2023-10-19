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
        return view('backend.admin.permission_role.all_permission', compact('permission'));
    }

    public function addPermission(Request $request)
    {
        return view('backend.admin.permission_role.add_permission');
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
        return view('backend.admin.permission_role.all_role', compact('roles'));
    }


    public function addRole(Request $request)
    {
        return view('backend.admin.permission_role.add_role');
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

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => "Role Deleted Succesfully!",
            'alert-type' => 'error',
        );

        return redirect()->back()->with($notification);
    }

    //< ========================= Role Permission ======================== >

    public function allRolePermission()
    {
        $roles = Role::all();

        return view('backend.admin.permission_role.all_role_permission', compact('roles'));
    }

    public function addRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permissionGroupNames = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return view('backend.admin.permission_role.add_role_permission', compact('roles', 'permissions', 'permissionGroupNames'));
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

        return view('backend.admin.permission_role.edit_role_permission', compact('roles', 'permissions', 'permissionGroupNames'));
    }

    public function updateRolePermission(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => "Role Permission Updated Succesfully!",
            'alert-type' => 'error',
        );

        return redirect()->route('all.role.permission')->with($notification);
    }

    public function deleteRolePermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => "Role Permission Deleted Succesfully!",
            'alert-type' => 'error',
        );

        return redirect()->back()->with($notification);
    }
}
