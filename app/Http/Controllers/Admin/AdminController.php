<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return redirect('/admin-login');
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
}
