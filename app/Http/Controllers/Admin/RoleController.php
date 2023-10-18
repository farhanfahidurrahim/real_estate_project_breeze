<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    /**
     * Show the form for creating a new resource.
     */
    public function addPermission(Request $request)
    {
        return view('backend.admin.permission.add_permission');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('permission.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
