<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 public function handle(Request $request, Closure $next)
    {
        // Check if logged in and role is admin
        if (Auth::check() && trim(strtolower(Auth::user()->role)) === 'admin') {
            return $next($request);
        }

        // If logged in but not admin → logout
        if (Auth::check()) {
            Auth::logout();
        }

        // Redirect to admin login with error
        return redirect()
            ->route('admin.login')
            ->withErrors([
                'error' => 'Unauthorized access. Please log in as an admin.'
            ]);
    }


}
