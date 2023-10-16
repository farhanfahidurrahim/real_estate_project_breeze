<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function signIn()
    {
        return view('auth.login-f');
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function editUserProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.profile.edit_profile', compact('userData'));
    }

    public function updateUserProfile(Request $request)
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
            @unlink(public_path('upload/images/user/'.$data->photo));
            $filename = $request->username.'-'.date('dmYHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/images/user'),$filename);
            $data['photo'] = $filename;
        }

        // if ($request->file('photo')) {
        //     $file = $request->file('photo');
        //     @unlink(public_path('upload/images/admin/'.$data->photo));
        //     $filename = $request->username.'-'.date('dmYHi').'.'.$file->getClientOriginalExtension();
        //     $file->move(public_path('upload/images/admin'),$filename);
        //     $data['photo'] = $filename;
        // }

        $data->save();
        $notification = array(
            'message' => "User Profile Updated!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
