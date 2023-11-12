<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\ProfileRequest;
use App\Http\Requests\User\PasswordChangeRequest;
use App\Http\Requests\User\PasswordUpdateRequest;

class UserController extends Controller
{
    public function profileUser()
    {
        return Auth::user();
    }

    public function profileUpdate(ProfileRequest $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();

        return response()->json([
            "message"=> "Update Success!",
        ]);
    }

    public function userPasswordUpdate(PasswordUpdateRequest $request)
    {
        //Current Password Match Check
        if (!Hash::check($request->current_password, auth::user()->password)) {
            return response()->json([
                'message' => 'Current Password Not Match!',
            ]);
        }

        //If Match
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Password Change Successfully!',
        ]);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout Successfully!',
        ]);
    }
}
