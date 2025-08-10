<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin()
    {
        return view('Admin.index');
    }
    public function login()
    {
        return view('Admin.login.login');
    }


public function admin_login_submit(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->route('admin')->with('success', 'Login successful!');
    }
    return back()->withErrors([
        'email' => 'Invalid email or password'
    ])->withInput($request->except('password'));
}
public function logout()
{
    Auth::logout();
    return redirect()->route('login')->with('success', 'Logged out successfully!');

}
}
