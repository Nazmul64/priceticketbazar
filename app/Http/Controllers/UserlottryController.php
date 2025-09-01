<?php

namespace App\Http\Controllers;

use App\Models\Lotter;
use App\Models\Waleta_setup;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\Profit;
use App\Models\User;
use App\Models\Userpackagebuy;
use App\Models\WithdrawCommission;
use Illuminate\Http\Request;
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
        return view('userdashboard.lottery.usersowlattery', compact('lotteries', 'walate'));
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
        // 1️⃣ Lock approved deposit row to prevent race condition
        $deposit = Deposite::where('user_id', $user->id)
            ->where('status', 'approved')
            ->lockForUpdate()
            ->first();

        if (!$deposit || $deposit->amount < $package->price) {
            DB::rollBack();
            return back()->with('error', 'Insufficient balance in deposit to buy this package.');
        }

        // 2️⃣ Decrement deposit balance
        $deposit->decrement('amount', $package->price);

        // 3️⃣ Generate unique ticket number (only if lottery)
        $ticketNumber = null;
        if ($package->type === 'lottery') {
            do {
                $candidate = 'L-' . now()->format('Ymd') . '-' . strtoupper(uniqid());
            } while (Userpackagebuy::where('ticket_number', $candidate)->exists());
            $ticketNumber = $candidate;
        }

        // 4️⃣ Save user package purchase (UNLIMITED allowed)
        $userPackageBuy = Userpackagebuy::create([
            'user_id'       => $user->id,
            'package_id'    => $package->id,
            'ticket_number' => $ticketNumber,
            'price'         => $package->price,
            'status'        => 'active',
        ]);

        // 5️⃣ Log expense in Profit
        Profit::create([
            'user_id'      => $user->id,
            'from_user_id' => $user->id,
            'deposit_id'   => $deposit->id,
            'amount'       => -$package->price,
            'level'        => 0,
            'note'         => 'User purchased package: ' . $package->id,
        ]);

        // 6️⃣ Referral + Generation Commissions
        $settings = CommissionSetting::first();
        if ($settings && $settings->status) {
            // Referral commission distribute
            $this->distributeReferralCommission($user, $package, $settings, $deposit->id);

            // Generation commission only for non-lottery packages
            if ($package->type !== 'lottery') {
                $this->distributeGenerationCommission($user, $package, $settings, $deposit->id);
            }
        }

        DB::commit();

        // 7️⃣ Success response
        if ($package->type === 'lottery') {
            return back()->with([
                'success'       => 'Package purchased successfully!',
                'ticket_number' => $ticketNumber
            ]);
        }

        return back()->with('success', 'Package purchased successfully!');

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
        if ($settings->refer_commission > 0) {
            $bonus = round($package->price * ($settings->refer_commission / 100), 2);
        }

        if ($bonus > 0) {
            $ref->increment('balance', $bonus);
            $ref->increment('refer_income', $bonus);

            Profit::create([
                'user_id'      => $ref->id,
                'from_user_id' => $user->id,
                'deposit_id'   => $depositId,
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
                    'deposit_id'   => $depositId,
                    'amount'       => $bonus,
                    'level'        => $level,
                    'note'         => 'Generation commission (Level '.$level.')',
                ]);
            }

            $current = $ref;
        }
    }

    /**
     * User lottery history
     */
    public function userlotterhistory()
    {
        $user = Auth::user();

        $purchases = Userpackagebuy::with(['package', 'results'])
            ->where('user_id', $user->id)
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('userdashboard.lotteryhistory.lotteryhistory', compact('purchases'));
    }

    /**
     * Money conversion view
     */
public function indexconvert()
{
    $user = Auth::user(); // logged in user
    return view('userdashboard.monyconvert.manyconvert', compact('user'));
}


    /**
     * Convert user balance to deposit with commission
     */
    public function convert(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'amount' => "required|numeric|min:1|max:{$user->balance}"
        ]);

        $commissionSetting = WithdrawCommission::first();
        $percentage = $commissionSetting?->money_exchange_commission ?? 0;

        $amount = $request->amount;
        $commission = ($amount * $percentage) / 100;
        $finalAmount = $amount - $commission;

        if ($finalAmount <= 0) {
            return back()->with('error', 'Invalid amount after commission deduction.');
        }

        DB::transaction(function () use ($user, $amount, $finalAmount) {
            $user->decrement('balance', $amount);

            Deposite::create([
                'user_id'       => $user->id,
                'amount'        => $finalAmount,
                'status'        => 'approved',
                'payment_method'=> 'conversion',
            ]);
        });

        return back()->with('success', "Converted {$amount} Dollar. Commission: {$commission} Dollar. Final deposit: {$finalAmount} Dollar");
    }
}
