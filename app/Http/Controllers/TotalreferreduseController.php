<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TotalreferreduseController extends Controller
{
    // লগইন ইউজারের সব কমিশন দেখানো
    public function commissions()
    {
        $commissions = Profit::with('fromUser')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('userdashboard.commissions.commissions', compact('commissions'));
    }

    // লগইন ইউজারের রেফারাল দেখানো
public function myReferrals()
{
    $user = auth()->user();

    // প্রতিটি রেফারালের নিজস্ব রেফারাল সংখ্যা লোড
    $referrals = $user->referrals()->withCount('referrals')->get();

    // মোট ডিরেক্ট রেফারাল সংখ্যা
    $count = $referrals->count();

    return view('userdashboard.referrals.referrals', compact('user', 'referrals', 'count'));
}



    // অ্যাডমিনের জন্য যেকোন ইউজারের রেফারাল দেখানো
    public function userReferrals($id)
    {
        $user = User::with('referrals')->findOrFail($id);

        return view('Admin.referrals.show', compact('user'));
    }

    // মোট রেফারাল সংখ্যা (API/Ajax)
    public function totalCount()
    {
        $user = auth()->user();
        $count = $user->referrals()->count();

        return response()->json([
            'user_id' => $user->id,
            'total_referred' => $count
        ]);
    }
public function referrals_nested()
{
    $user = Auth::user();

    // Eager load direct referrals recursively
    $referrals = $user->referrals()
        ->with('referrals') // load direct referrals
        ->get();

    return view('userdashboard.referrals.referrals_nested', compact('user', 'referrals'));
}



}
