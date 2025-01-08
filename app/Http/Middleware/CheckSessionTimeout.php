<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && time() - session('last_activity') > config('session.lifetime') * 60) {
            Auth::logout();  // Logout the user
            return redirect()->route('login')->with('session_timeout', 'Your session has timed out. Please log in again.');
        }

        session(['last_activity' => time()]);  // Update last activity timestamp

        return $next($request);
    }
}
