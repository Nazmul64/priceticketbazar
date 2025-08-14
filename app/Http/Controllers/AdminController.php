<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.index');
    }

    public function showLoginForm()
    {
        return view('Admin.login.login');
    }

public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // If no user found
        if (!$user) {
            return back()
                ->withErrors(['email' => 'No account found with this email.'])
                ->withInput($request->except('password'));
        }

        // If user is not admin
        if (trim(strtolower($user->role)) !== 'admin') {
            return back()
                ->withErrors(['email' => 'You are not authorized to access the admin panel.'])
                ->withInput($request->except('password'));
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login successful!');
        }

        // Wrong password
        return back()
            ->withErrors(['email' => 'Invalid password.'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('admin.login')
            ->with('success', 'Logged out successfully.');
    }
}
