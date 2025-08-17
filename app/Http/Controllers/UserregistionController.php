<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserregistionController extends Controller
{
//      public function userdashboard(){
//    $userId = Auth::id();

//         // শুধু approved deposit এর sum
//         $mainbalance = Deposite::where('user_id', $userId)
//                         ->where('status', 'approved')
//                         ->sum('amount');

//         return view('Userdashboard.index', compact('mainbalance'));
// }
public function userdashboard(){
    $userId = Auth::id();

    $user = User::find($userId);

    // Approved deposits
    $mainDeposit = Deposite::where('user_id', $userId)
                    ->where('status', 'approved')
                    ->sum('amount');

    // Total Invest (all deposits)
    $totalInvest = Deposite::where('user_id', $userId)
                    ->sum('amount');

    // Main Balance
    $mainBalance = $mainDeposit;

    // Commission settings
    $commissionSetting = CommissionSetting::first();

    // Weekly team deposit (0-500 USD)
    $weeklyDeposit = Deposite::where('status','approved')
                             ->whereBetween('amount',[0,500])
                             ->sum('amount');

    // Weekly team commission = 4%
    $weeklyTeamCommission = $weeklyDeposit * ($commissionSetting->weekly_team_commission / 100);

    // Generation levels (max 5)
    $generationLevels = [
        1 => $commissionSetting->generation_level_1,
        2 => $commissionSetting->generation_level_2,
        3 => $commissionSetting->generation_level_3,
        4 => $commissionSetting->generation_level_4,
        5 => $commissionSetting->generation_level_5,
    ];

    // Example: Generation income per level
    $generationIncomePerLevel = [];
    foreach($generationLevels as $level => $percent){
        $generationIncomePerLevel[$level] = $user->generation_income * ($percent / 100);
    }

    return view('Userdashboard.index', compact(
        'mainDeposit',
        'totalInvest',
        'mainBalance',
        'user',
        'weeklyDeposit',
        'weeklyTeamCommission',
        'generationIncomePerLevel',
        'commissionSetting'
    ));
}
    public function userlogin(){
        return view('Frontend.login.login');
    }

    public function register(Request $request)
    {
         $refCode = $request->query('ref'); // URL থেকে ref কোড নিব
        return view('Frontend.login.register',compact('refCode'));
    }


public function registerSubmit(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'username' => 'nullable|string|max:255|unique:users',
        'phone'    => 'required|string|max:20|unique:users',
        'ref_code' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // ডিফল্ট null
    $referredBy = null;

    // রেফারেল কোড থাকলে চেক
    if ($request->filled('ref_code')) {
        $refUser = User::where('ref_code', $request->ref_code)->first();
        if ($refUser) {
            $referredBy = $refUser->id;
        }
    }

    // নতুন ইউজার তৈরি
    $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => Hash::make($request->password),
        'username'    => $request->username ?? Str::random(8),
        'phone'       => $request->phone,
        'ref_code'    => strtoupper(Str::random(8)),
        'referred_by' => $referredBy,
        'status'      => 'active',
        'role'        => 'user'
    ]);

    auth()->login($user);

    return redirect()->route('user.dashboard')->with('success', 'Registration successful!');
}










    // Add login submit method
public function loginSubmit(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email'    => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');
    $credentials['role'] = 'user'; // শুধুমাত্র role = user হলে লগইন হবে

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('user.dashboard')->with('success', 'Login successful!');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput();
}

    // Add logout method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', 'Successfully logged out!');
    }

}

