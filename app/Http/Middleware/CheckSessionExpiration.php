<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSessionExpiration
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Check if the session has expired
            if (time() - strtotime(session('last_activity')) > config('session.lifetime') * 60) {
                Auth::logout(); // Logout the user
                return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
            }

            // Update last activity timestamp
            session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
