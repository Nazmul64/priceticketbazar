<?php

namespace App\Http\Controllers;

 use App\Http\Controllers\Controller;
 use App\Models\Lotter;
 use App\Models\Waleta_setup;
 use Illuminate\Http\Request;
 use App\Models\CommissionSetting;
 use App\Models\Deposite;
 use App\Models\profit;
 use App\Models\User;
 use App\Models\User_profit;
use App\Models\Userpackagebuy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserlottryController extends Controller
{
  public function userlotter(){
     $walate = Waleta_setup::select('accountnumber','bankname')->get();
     $lotteries =Lotter::all();
    return view("userdashboard.lottery.usersowlattery",compact("lotteries",'walate'));
  }

public function buyPackage(Request $request, $packageId)
{
    $user = Auth::user();
    $package = Lotter::findOrFail($packageId);
    $deposte_decrement =Deposite::findOrFail($packageId);


    // Check balance
    if ($user->balance < $package->price) {
        return back()->with('error', 'Insufficient balance to buy this package.');
    }

    // Deduct balance
    $deposte_decrement->decrement('amount', $package->amount);

    // Save package buy log
    Userpackagebuy::create([
        'user_id'    => $user->id,
        'package_id' => $package->id,
        'price'      => $package->price,
        'status'     => 'active',
    ]);

    $settings = CommissionSetting::first();

    if ($settings && $settings->status) {
        $this->distributeReferralCommission($user, $package, $settings);

        if ($package->type != 'lottery') {
            $this->distributeGenerationCommission($user, $package, $settings);
        }
    }

    return back()->with('success', 'Package purchased successfully!');
}

/**
 * Direct referral commission
 */
protected function distributeReferralCommission($user, $package, $settings)
{
    $ref = $user->referrer;
    if (!$ref) return;

    $bonus = 0;
    if ($package->type == 'lottery' && $settings->lottery_percentages > 0) {
        $bonus = round($package->price * ($settings->lottery_percentages / 100), 2);
    } elseif ($settings->refer_commission > 0) {
        $bonus = round($package->price * ($settings->refer_commission / 100), 2);
    }

    if ($bonus > 0) {
        $ref->increment('balance', $bonus);
        $ref->increment('refer_income', $bonus);

        Profit::create([
            'user_id'      => $ref->id,
            'from_user_id' => $user->id,
            'deposit_id'   => null,
            'amount'       => $bonus,
            'level'        => 1,
            'note'         => $package->type == 'lottery'
                                ? 'Lottery referral commission'
                                : 'Direct referral commission',
        ]);
    }
}

/**
 * Generation commission (levels 1-5)
 */
protected function distributeGenerationCommission($user, $package, $settings)
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
        if (!$ref || $percents[$level] <= 0) break;

        $bonus = round($stockAmount * ($percents[$level] / 100), 2);
        if ($bonus > 0) {
            $ref->increment('balance', $bonus);
            $ref->increment('generation_income', $bonus);

            Profit::create([
                'user_id'      => $ref->id,
                'from_user_id' => $user->id,
                'deposit_id'   => null,
                'amount'       => $bonus,
                'level'        => $level,
                'note'         => 'Generation commission (Level ' . $level . ')',
            ]);
        }

        $current = $ref;
    }
}


}
