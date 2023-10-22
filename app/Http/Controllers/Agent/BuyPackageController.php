<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\PackagePlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuyPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.agent.package.index');
    }

    public function businessPlan()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('backend.agent.package.business_plan', compact('data'));
    }

    public function businessPlanStore(Request $request)
    {
        $id = Auth::user()->id;
        $creditFind = User::findOrFail($id);
        $creditValue = $creditFind->credit;

        PackagePlan::create([
            'user_id' => $id,
            'package_name' => 'Business',
            'package_invoice' => 'BP-'.Str::random(5),
            'package_credit' => '3',
            'package_amount' => '20',
        ]);

        User::where('id',$id)->update([
            'credit' => DB::raw('3 + '.$creditValue),
        ]);

        $notification = array(
            'message' => "Basic Package Purchase!",
            'alert-type' => 'success',
        );

        return redirect()->route('agent.property.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function packageHistory()
    {
        $data = PackagePlan::latest()->get();
        return view('backend.agent.package.package_history', compact('data'));
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
