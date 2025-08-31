<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposite;
use App\Models\User;
use App\Models\User_widthdraw;
use App\Models\Waleta_setup;
use App\Models\WithdrawCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
public function withdraw()
{
    $waleta_setups = Waleta_setup::all();
    $withdraw_commission = WithdrawCommission::first();
    $deposite_amount = User::where('id', auth()->id())->sum('balance');

    return view('userdashboard.Withdraw.index', compact('waleta_setups', 'withdraw_commission','deposite_amount'));
}

public function submit(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'wallet_name' => 'required|string',
        'account_number' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    // শুধু উইথড্র রিকোয়েস্ট তৈরি হবে, balance এখনই কাটা হবে না
    User_widthdraw::create([
        'user_id' => $user->id,
        'wallet_name' => $request->wallet_name,
        'account_number' => $request->account_number,
        'amount' => $request->amount,
        'charge' => 0, // Admin Approve করার সময় হিসাব হবে
        'status' => 'pending',
    ]);

    return back()->with('success', 'Withdrawal request submitted successfully. Waiting for admin approval.');
}

// Show all withdrawals
    public function Withdrawshow()
    {
        $withdrawals = User_widthdraw::with('user')->orderBy('created_at', 'desc')->get();
        return view('Admin.widthraw.index', compact('withdrawals'));
    }

    // Approve withdrawal
    public function approve($id)
    {
        $withdraw = User_widthdraw::findOrFail($id);
        $user = $withdraw->user;

        $withdraw_commission = WithdrawCommission::first();
        $commission_percentage = $withdraw_commission->withdraw_commission ?? 0;

        $charge = ($commission_percentage / 100) * $withdraw->amount;
        $total_deduction = $withdraw->amount + $charge;

        if ($user->balance < $total_deduction) {
            return back()->with('error', 'User balance insufficient.');
        }

        $user->balance -= $total_deduction;
        $user->save();

        $withdraw->charge = $charge;
        $withdraw->status = 'approved';
        $withdraw->save();

        return back()->with('success', 'Withdrawal approved successfully.');
    }

    // Reject withdrawal
    public function reject($id)
    {
        $withdraw = User_widthdraw::findOrFail($id);
        $withdraw->status = 'rejected';
        $withdraw->save();

        return back()->with('success', 'Withdrawal rejected successfully.');
    }
}



