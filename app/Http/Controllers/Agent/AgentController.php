<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    public function agentDashboard()
    {
        return view('backend.agent.index');
    }

    public function agentLogin()
    {
        return view('backend.agent.login');
    }

    public function agentLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => "Agent Logout!",
            'alert-type' => 'error',
        );

        return redirect('/agent/login')->with($notification);
    }

    public function agentRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
    }

    public function agentProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.agent.profile', compact('profileData'));
    }

    public function agentProfileUpdate(Request $request)
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
            @unlink(public_path('upload/images/agent/'.$data->photo));
            $filename = $request->username.'-'.date('dmYHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/images/agent'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => "Agent Profile Updated Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function agentPasswordChange()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('backend.agent.password_change', compact('profileData'));
    }

    public function agentPasswordUpdate(Request $request)
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
