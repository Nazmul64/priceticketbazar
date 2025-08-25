<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Profit;
use App\Models\Userpackagebuy;
use App\Models\Waleta_setup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositeContrller extends Controller
{
    // List all deposits for admin
    public function approveindex() {
        $deposite = Deposite::with('user')->latest()->get();
        return view('Admin.userdeposite.index', compact('deposite'));
    }

    // Create deposit form (user)
public function create()
{
    // Fetch all wallets with bank name and account number
    $wallets = Waleta_setup::select('bankname', 'accountnumber')->get();

    // Transaction history for the authenticated user
    $transactions = Deposite::where('user_id', auth()->id())->latest()->get();

    return view('userdashboard.deposite.deposite', compact('wallets', 'transactions'));
}



    // Store deposit request
public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:500',
        'payment_method' => 'required',
        'transaction_id' => 'required|string|max:255',
        'screenshot' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'amount.min' => 'ন্যূনতম 500 টাকা ডিপোজিট করতে হবে।'
    ]);

    $photoName = null;

    if ($request->hasFile('screenshot')) {
        $photoName = time().'_'.uniqid().'.'.$request->file('screenshot')->extension();
        $request->file('screenshot')->move(public_path('uploads/deposite'), $photoName);
    }

    Deposite::create([
        'user_id' => Auth::id(),
        'amount' => $request->amount,
        'payment_method' => $request->payment_method,
        'transaction_id' => $request->transaction_id,
        'screenshot' => $photoName,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Deposit request submitted successfully!');
}


    // Update deposit status by admin
    public function updateStatus(Request $request, Deposite $deposit) {
        $request->validate(['status'=>'required|in:pending,approved,rejected']);
        $deposit->update(['status'=>$request->status]);
        return back()->with('success', 'Deposit status updated successfully!');
    }

    // Delete deposit
    public function approvedelete($id) {
        $deposit = Deposite::findOrFail($id);
        $deposit->delete();
        return back()->with('success','Deposit deleted successfully!');
    }
}
