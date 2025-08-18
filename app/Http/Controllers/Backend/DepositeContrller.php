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
use Illuminate\Support\Facades\Auth;

class DepositeContrller extends Controller
{
    /**
     * Admin: list all deposits
     */
    /**
     * Admin: list all deposits
     */
   public function approveindex() {
        $deposite = Deposite::with('user')->latest()->get();
        return view('Admin.userdeposite.index', compact('deposite'));
    }

    public function create() {
        $transactions = Deposite::with('method_type')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $walate = Waleta_setup::all();

        return view('userdashboard.deposite.deposite', compact('walate', 'transactions'));
    }

    public function store(Request $request) {
        $request->validate([
            'payment_method' => 'required|exists:waleta_setups,id',
            'amount' => 'required|numeric|min:500',
            'transaction_id' => 'required|string|max:255',
            'screenshot' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], ['amount.min' => 'ন্যূনতম 500 টাকা ডিপোজিট করতে হবে।']);

        $photoName = null;
        if ($request->hasFile('screenshot')) {
            $photoName = time() . '.' . $request->file('screenshot')->extension();
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

    public function updateStatus(Request $request, Deposite $deposit) {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);

        if ($deposit->status === 'approved' && $request->status === 'approved') {
            return back()->with('info', 'This deposit is already approved.');
        }

        $deposit->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $this->distribute($deposit);
            $this->updateUserProfitSummary($deposit->user_id);
        }

        return back()->with('success', 'Deposit status updated successfully!');
    }

    private function distribute(Deposite $deposit) {
        if ($deposit->status !== 'approved') return;
        if (Profit::where('deposit_id', $deposit->id)->exists()) return;

        $user = $deposit->user;
        if (!$user) return;

        $settings = CommissionSetting::first();
        if (!$settings || !$settings->status) return;

        $stockAmount = round($deposit->amount * 0.60, 2);

        $percents = [
            1 => (float) $settings->generation_level_1,
            2 => (float) $settings->generation_level_2,
            3 => (float) $settings->generation_level_3,
            4 => (float) $settings->generation_level_4,
            5 => (float) $settings->generation_level_5,
        ];

        DB::transaction(function() use ($user, $deposit, $stockAmount, $percents) {
            $current = $user;

            for ($level = 1; $level <= 5; $level++) {
                $ref = $current->referrer;
                if (!$ref) break;

                $bonus = round(($stockAmount * $percents[$level]) / 100, 2);
                if ($bonus <= 0) break;

                Profit::create([
                    'user_id' => $ref->id,
                    'from_user_id' => $user->id,
                    'deposit_id' => $deposit->id,
                    'amount' => $bonus,
                    'level' => $level,
                ]);

                $ref->increment('balance', $bonus);
                if ($level === 1) $ref->increment('refer_income', $bonus);
                else $ref->increment('generation_income', $bonus);

                $current = $ref;
            }
        });
    }

    private function updateUserProfitSummary(int $userId) {
        $totalDeposit = Deposite::where('user_id', $userId)
            ->where('status', 'approved')
            ->sum('amount');

        $totalProfit = Profit::where('user_id', $userId)->sum('amount');

        $summary = User_profit::firstOrCreate(['user_id' => $userId]);
        $summary->total_deposit = $totalDeposit;
        $summary->total_profit = $totalProfit;
        $summary->save();
    }

    public function approvedelete($id) {
        $deposit = Deposite::findOrFail($id);
        $deposit->delete();
        return back()->with('success', 'Deposit deleted successfully!');
    }
}
