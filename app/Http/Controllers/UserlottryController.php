<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use App\Models\Waleta_setup;
use Illuminate\Http\Request;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\Profit;
use App\Models\User;
use App\Models\Userpackagebuy;
use App\Models\WithdrawCommission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserlottryController extends Controller
{
    /**
     * Show lottery packages
     */
    public function userlotter()
    {
        $walate = Waleta_setup::select('accountnumber', 'bankname')->get();
        $lotteries = Lotter::all();
        return view("userdashboard.lottery.usersowlattery", compact("lotteries", 'walate'));
    }

    /**
     * Buy Lottery Package
     */
public function buyPackage(Request $request, $packageId)
{
    $user = Auth::user();
    $package = Lotter::findOrFail($packageId);

    DB::beginTransaction();
    try {
        // 1️⃣ Lock approved deposit to prevent race condition
        $deposit = Deposite::where('user_id', $user->id)
            ->where('status', 'approved')
            ->lockForUpdate()
            ->first();

        if (!$deposit || $deposit->amount < $package->price) {
            DB::rollBack();
            return back()->with('error', 'Insufficient balance in deposit to buy this package.');
        }

        // 2️⃣ Decrement deposit
        $deposit->decrement('amount', $package->price);

        // 3️⃣ Generate unique ticket number if lottery
        $ticketNumber = null;
        if ($package->type === 'lottery') {
            do {
                $candidate = 'L-' . now()->format('Ymd') . '-' . strtoupper(uniqid());
            } while (Userpackagebuy::where('ticket_number', $candidate)->exists());

            $ticketNumber = $candidate;
        }

        // 4️⃣ Save user package purchase
        $userPackageBuy = Userpackagebuy::create([
            'user_id'       => $user->id,
            'package_id'    => $package->id,
            'ticket_number' => $ticketNumber,
            'price'         => $package->price,
            'status'        => 'active',
        ]);

        // 5️⃣ Log user expense
        Profit::create([
            'user_id'      => $user->id,
            'from_user_id' => $user->id,
            'deposit_id'   => $deposit->id,
            'amount'       => -$package->price,
            'level'        => 0,
            'note'         => 'User purchased package: ' . $package->id,
        ]);

        // 6️⃣ Commissions
        $settings = CommissionSetting::first();
        if ($settings && $settings->status) {
            $this->distributeReferralCommission($user, $package, $settings, $deposit->id);
            if ($package->type !== 'lottery') {
                $this->distributeGenerationCommission($user, $package, $settings, $deposit->id);
            }
        }

        DB::commit();

        // 7️⃣ Return success with ticket number in session (for alert / copy)
        if ($package->type === 'lottery') {
            return back()->with([
                'success' => 'Package purchased successfully!',
                'ticket_number' => $ticketNumber
            ]);
        } else {
            return back()->with('success', 'Package purchased successfully!');
        }

    } catch (\Throwable $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}




    /**
     * Direct referral commission
     */
    protected function distributeReferralCommission(User $user, Lotter $package, CommissionSetting $settings, int $depositId): void
    {
        $ref = $user->referrer;
        if (!$ref) return;

        $bonus = 0.0;
        if ($package->type === 'lottery' && $settings->lottery_percentages > 0) {
            $bonus = round($package->price * ($settings->lottery_percentages / 100), 2);
        } elseif ($settings->refer_commission > 0) {
            $bonus = round($package->price * ($settings->refer_commission / 100), 2);
        }

        if ($bonus > 0) {
            // Referrer balance + refer_income increment
            $ref->increment('balance', $bonus);
            $ref->increment('refer_income', $bonus);

            Profit::create([
                'user_id'      => $ref->id,
                'from_user_id' => $user->id,
                'deposit_id'   => $depositId, // <-- link to buyer's deposit
                'amount'       => $bonus,
                'level'        => 1,
                'note'         => ($package->type === 'lottery')
                    ? 'Lottery referral commission'
                    : 'Direct referral commission',
            ]);
        }
    }

    /**
     * Generation commission (levels 1-5)
     */
    protected function distributeGenerationCommission(User $user, Lotter $package, CommissionSetting $settings, int $depositId): void
    {
        $current = $user;
        $stockAmount = round($package->price * ($settings->generation_commission / 100), 2);

        $percents = [
            1 => $settings->generation_level_1,
            2 => $settings->generation_level_2,
            3 => $settings->generation_level_3,
            4 => $settings->generation_level_4,
            5 => $settings->generation_level_5,
        ];

        for ($level = 1; $level <= 5; $level++) {
            $ref = $current->referrer;
            if (!$ref || ($percents[$level] ?? 0) <= 0) break;

            $bonus = round($stockAmount * ($percents[$level] / 100), 2);
            if ($bonus > 0) {
                $ref->increment('balance', $bonus);
                $ref->increment('generation_income', $bonus);

                Profit::create([
                    'user_id'      => $ref->id,
                    'from_user_id' => $user->id,
                    'deposit_id'   => $depositId, // <-- MUST NOT BE NULL
                    'amount'       => $bonus,
                    'level'        => $level,
                    'note'         => 'Generation commission (Level '.$level.')',
                ]);
            }

            $current = $ref;
        }
    }
    public function userlotterhistory()
    {
       $user = Auth::user();

    $purchases = Userpackagebuy::with(['package', 'results'])
        ->where('user_id', $user->id)
        ->orderBy('purchased_at', 'desc')
        ->get();

    return view('userdashboard.lotteryhistory.lotteryhistory', compact('purchases'));
    }

    public function indexconvert(){
       return view('userdashboard.monyconvert.manyconvert');
    }
public function convert(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'amount' => "required|numeric|min:1|max:{$user->balance}"
        ]);

        // Get admin-set commission %
        $commissionSetting = WithdrawCommission::first();
        $percentage = $commissionSetting?->money_exchange_commission ?? 0;

        $amount = $request->amount;

        // Commission calculation
        $commission = ($amount * $percentage) / 100;
        $finalAmount = $amount - $commission;

        if ($finalAmount <= 0) {
            return back()->with('error', 'Invalid amount after commission deduction.');
        }

        DB::transaction(function () use ($user, $amount, $finalAmount) {
            // Deduct full convert amount from user balance
            $user->balance -= $amount;
            $user->save();

            // Add final amount to deposits table
            Deposite::create([
                'user_id' => $user->id,
                'amount'  => $finalAmount,
                'status'  => 'approved',
                'payment_method' => 'conversion', // Required for DB
            ]);
        });

        return back()->with('success', "Converted {$amount} Dollar. Commission: {$commission} Dollar. Final deposit: {$finalAmount} Dollar");
    }
}
