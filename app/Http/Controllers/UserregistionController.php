<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserregistionController extends Controller
{
      public function userdashboard()
{
    return view('Userdashboard.index');
}
    public function userlogin(){
        return view('Frontend.login.login');
    }

    public function register()
    {
        return view('Frontend.login.register');
    }


public function registerSubmit(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'username' => 'nullable|string|max:255|unique:users',
        'phone'    => 'required|string|max:20|unique:users',
        'ref_code' => 'nullable|string|max:255',
        'referred_by' => 'nullable|integer|exists:users,id',
        'ref_id'      => 'nullable|integer|exists:users,id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Referral system logic
    $referredBy = $request->referred_by; // from hidden input
    $refId = $request->ref_id;

    if ($request->filled('ref_code') && !$referredBy) {
        $refUser = User::where('username', $request->ref_code)
                       ->orWhere('id', $request->ref_code)
                       ->first();
        if ($refUser) {
            $referredBy = $refUser->id;
        }
    }

    // Create user
    $user = User::create([
        'name'              => $request->name,
        'email'             => $request->email,
        'password'          => Hash::make($request->password),
        'username'          => $request->username ?? Str::random(8),
        'phone'             => $request->phone,
        'referred_by'       => $referredBy,
        'ref_id'            => $refId,
        'refer_income'      => 0.00,
        'generation_income' => 0.00,
        'status'            => 'active',
        'role'              => 'user'
    ]);

    // Login after registration
    auth()->login($user);

    return redirect()->route('userdashboard')->with('success', 'Registration successful!');
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
        return redirect()->route('userdashboard')->with('success', 'Login successful!');
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

