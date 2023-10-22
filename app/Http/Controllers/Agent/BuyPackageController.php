<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\PackagePlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuyPackageController extends Controller
{
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

    public function packageHistory()
    {
        $id = Auth::user()->id;
        $data = PackagePlan::where('user_id',$id)->get();
        return view('backend.agent.package.package_history', compact('data'));
    }

    public function packageInvoiceDownload($id)
    {
        $packageHistory = PackagePlan::where('id',$id)->first();

        $pdf = Pdf::loadView('backend.agent.package.package_history_invoice_pdf', compact('packageHistory'))
                ->setPaper('a4')->setOption([
                    'tempDir' => public_path(),
                    'chroot' => public_path(),
                ]);
        return $pdf->download('invoice.pdf');
    }

    public function adminPackageHistory()
    {
        $data = PackagePlan::latest()->get();
        return view('backend.admin.package.package_history', compact('data'));
    }

    public function adminPackageInvoiceDownload($id)
    {
        $packageHistory = PackagePlan::where('id',$id)->first();

        $pdf = Pdf::loadView('backend.agent.package.package_history_invoice_pdf', compact('packageHistory'))
                ->setPaper('a4')->setOption([
                    'tempDir' => public_path(),
                    'chroot' => public_path(),
                ]);
        return $pdf->download('invoice.pdf');
    }
}
