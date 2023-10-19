<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('backend.admin.index');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.admin.profile', compact('profileData'));
    }

    public function adminLogin()
    {
        return view('backend.admin.login');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => "Admin Logout!",
            'alert-type' => 'success',
        );

        return redirect('/admin/login')->with($notification);
    }

    public function adminProfileUpdate(Request $request)
    {
        //return $request->all();
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/images/admin/'.$data->photo));
            $filename = $request->username.'-'.date('dmYHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/images/admin'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => "Admin Profile Updated Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function adminPasswordChange()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('backend.admin.password_change', compact('profileData'));
    }

    public function adminPasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        //Check Match Current Password
        if (!Hash::check($request->current_password, auth::user()->password)) {
            $notification = array(
                'message' => "Current Password Not Match!",
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

        //if Match than Update New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        $notification = array(
            'message' => "Password Change!",
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    //---------------Manage Admin-------------

    public function allAdmin()
    {
        $data = User::where('role','admin')->get();
        return view('backend.admin.manage_admin.index', compact('data'));
    }

    public function addAdmin()
    {
        $roles = Role::all();
        return view('backend.admin.manage_admin.create', compact('roles'));
    }

    public function storeAdmin(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required',
            'address' => 'required',
            'roles' => 'required',
        ]);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'admin',
            'status' => 'active',
        ]);

        if ($request->roles) {
            $data->assignRole($request->roles);
        }

        $notification = array(
            'message' => "New Admin Created!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $data = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.admin.manage_admin.edit', compact('data','roles'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'roles' => 'required',
        ]);

        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'admin',
            'status' => 'active',
        ]);

        $data->roles()->detach();
        if ($request->roles) {
            $data->assignRole($request->roles);
        }

        $notification = array(
            'message' => "Admin Updated!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => "Admin Deleted!",
            'alert-type' => 'error',
        );

        return redirect()->back()->with($notification);
    }

    //---------------get Agent in Admin-------------

    public function allAgent()
    {
        $data = User::where('role','agent')->orderBy('id','desc')->get();
        return view('backend.admin.manage_agent.index', compact('data'));
    }

    public function createAgent()
    {
        return view('backend.admin.manage_agent.create');
    }

    public function storeAgent(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required',
            'address' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'agent',
            'status' => 'active',
        ]);

        $notification = array(
            'message' => "Agent Created!",
            'alert-type' => 'success',
        );

        return redirect()->route('all.agent')->with($notification);
    }

    public function destroyAgent($id)
    {
        $data = User::findOrFail($id);
        @unlink(public_path('upload/images/agent/'.$data->photo));
        $data->delete();

        $notification = array(
            'message' => "Agent Deleted!",
            'alert-type' => 'danger',
        );

        return redirect()->back()->with($notification);
    }

    public function statusChangeAgent(Request $request)
    {
        //return $request->all();
        $data = User::findOrFail($request->id);
        $data->status = $request->status;
        $data->save();

        return response()->json([
            'success' => "Status Change!",
        ]);
    }
}
