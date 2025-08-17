<?php

namespace App\Http\Controllers\Backend;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\profit;
use App\Models\User;
use App\Models\User_profit;
use App\Models\Waleta_setup;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DepositeContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function approveindex()
    {
        $deposite = Deposite::all();
        return view('Admin.userdeposite.index',compact('deposite'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    // Get all transactions for the authenticated user, with payment method relationship
    $transactions = Deposite::with('method_type')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

    // Get all available wallet/payment methods
    $walate = Waleta_setup::all();

    return view('userdashboard.deposite.deposite', compact('walate', 'transactions'));
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
     // Validate request
    $validated = $request->validate([
        'payment_method' => 'required|exists:waleta_setups,id', // Must match a payment method in DB
        'amount'         => 'required|numeric|min:500',         // Minimum 500 Taka
        'transaction_id' => 'required|string|max:255',
        'screenshot'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB limit
    ], [
        'amount.min' => 'ন্যূনতম 500 টাকা ডিপোজিট করতে হবে।', // Custom Bangla message
    ]);

    $photoName = null;
    if ($request->hasFile('screenshot')) {
        $photoName = time() . '.' . $request->screenshot->extension();
        $request->screenshot->move(public_path('uploads/deposite'), $photoName);
    }

    $deposit = Deposite::create([
        'user_id'        => auth()->id(),
        'amount'         => $request->amount,
        'payment_method' => $request->payment_method,
        'transaction_id' => $request->transaction_id,
        'screenshot'     => $photoName,
        'status'         => 'pending',
    ]);

    // Commission Distribution
    $this->distributeCommission($deposit);

    return redirect()->back()->with('success', 'Deposit request submitted successfully!');
}

private function distributeCommission($deposit)
{
    $settings = CommissionSetting::first();
    if (!$settings) return;

    $amount = $deposit->amount * 0.60; // 60% distributeable

    $percentages = [
        $settings->generation_level_1,
        $settings->generation_level_2,
        $settings->generation_level_3,
        $settings->generation_level_4,
        $settings->generation_level_5,
    ];

    $currentUser = $deposit->user;
    for ($level = 0; $level < 5; $level++) {
        if (!$currentUser->referred_by) break;

        $refUser =User::find($currentUser->referred_by);
        if ($refUser) {
            $commission = ($amount * $percentages[$level]) / 100;

            // Add to profit table
            $profit =User_profit::firstOrCreate(['user_id' => $refUser->id]);
            $profit->total_profit += $commission;
            $profit->save();
        }
        $currentUser = $refUser;
    }

    // Update depositor's total deposit
    $myProfit = User_profit::firstOrCreate(['user_id' => $deposit->user_id]);
    $myProfit->total_deposit += $deposit->amount;
    $myProfit->save();
}



public function updateStatus(Request $request, Deposite $deposit)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected',
    ]);

    if ($deposit->status === 'approved' && $request->status === 'approved') {
        return back()->with('info', 'This deposit is already approved.');
    }

    $deposit->update(['status' => $request->status]);

    if ($request->status === 'approved') {
        $this->distribute($deposit);
    }

    return back()->with('success', 'Deposit status updated successfully!');
}

private function distribute(Deposite $deposit): void
{
    if ($deposit->status !== 'approved') return;

    if (Profit::where('deposit_id', $deposit->id)->exists()) return;

    $user = $deposit->user;
    if (!$user) return;

    $stockAmount = round($deposit->amount * 0.60, 2);

    $settings = CommissionSetting::first();
    $percents = [
        1 => ($settings->generation_level_1 ?? 40),
        2 => ($settings->generation_level_2 ?? 25),
        3 => ($settings->generation_level_3 ?? 15),
        4 => ($settings->generation_level_4 ?? 10),
        5 => ($settings->generation_level_5 ?? 10),
    ];

    DB::transaction(function () use ($user, $deposit, $stockAmount, $percents) {
        $current = $user;

        for ($level = 1; $level <= 5; $level++) {
            $ref = $current->referrer; // <-- relation from User model
            if (!$ref) break;

            $bonus = round(($stockAmount * $percents[$level]) / 100, 2);
            if ($bonus <= 0) break;

            Profit::create([
                'user_id'      => $ref->id,
                'from_user_id' => $user->id,
                'deposit_id'   => $deposit->id,
                'amount'       => $bonus,
                'level'        => $level,
            ]);

            $ref->increment('balance', $bonus);

            $current = $ref;
        }
    });
}

    public function approvedelete($id){
        $delete =Deposite::find($id);
        $delete->delete();
         return back()->with('success', 'Deposit delete successfully!');
    }
}
