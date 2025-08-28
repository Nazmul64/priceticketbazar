<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\Profit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserregistionController extends Controller
{
    /**
     * User dashboard
     */
    public function userdashboard()
    {
        $user = Auth::user();

        // Approved deposits (own)
        $mainDeposit = Deposite::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('amount');

        $totalInvest = Deposite::where('user_id', $user->id)->sum('amount');
        $mainBalance = $mainDeposit;

        $commissionSetting = CommissionSetting::first();

        // Direct Referral Income (level 1)
        $referIncome = Profit::where('user_id', $user->id)
            ->where('level', 1)
            ->sum('amount');

        // Generation Income per level
        $generationIncomePerLevel = [];
        for ($level = 1; $level <= 5; $level++) {
            $generationIncomePerLevel[$level] = Profit::where('user_id', $user->id)
                ->where('level', $level)
                ->sum('amount');
        }

        // Weekly team deposits (level-1 referrals)
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();

        $referralIds = $user->referrals()->pluck('id');
        $weeklyDeposit = Deposite::whereIn('user_id', $referralIds)
            ->where('status', 'approved')
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');

        $weeklyTeamCommission = $weeklyDeposit * (($commissionSetting->weekly_team_commission ?? 0) / 100);

        return view('Userdashboard.index', compact(
            'mainDeposit',
            'totalInvest',
            'mainBalance',
            'user',
            'referIncome',
            'generationIncomePerLevel',
            'weeklyDeposit',
            'weeklyTeamCommission',
            'commissionSetting'
        ));
    }

    /**
     * Show login form
     */
    public function userlogin()
    {
        return view('Frontend.login.login');
    }

    /**
     * Show register form
     */
    public function register(Request $request)
    {
        $refCode = $request->query('ref'); // referral code from URL
        return view('Frontend.login.register', compact('refCode'));
    }

    /**
     * Handle register form submit
     */
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

        $referredBy = null;
        if ($request->filled('ref_code')) {
            $refUser = User::where('ref_code', $request->ref_code)->first();
            if ($refUser) {
                $referredBy = $refUser->id;
            }
        }

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'username'    => $request->username ?? Str::random(8),
            'phone'       => $request->phone,
            'ref_code'    => strtoupper(Str::random(8)),
            'referred_by' => $referredBy,
            'status'      => 'active', // default active
            'role'        => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Handle login submit
     */
    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'user';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Status check (active/inactive)
            if (Auth::user()->status != 'active' && Auth::user()->status != 1) {
                Auth::logout();
                return redirect()->route('user.login')->withErrors([
                    'email' => 'Your account is inactive. Please contact support.',
                ]);
            }

            return redirect()->route('user.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', 'Successfully logged out!');
    }
}
