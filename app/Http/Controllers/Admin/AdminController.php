<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
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
}
