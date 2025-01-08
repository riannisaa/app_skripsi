<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KaprodiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                    
        if (auth()->check() && auth()->user()->role === 'kaprodi') {
            return $next($request);
        }

        // If the user is not a Mahasiswa, redirect to another page (e.g., login)
        return redirect()->back()->with('error', 'Access denied. You must be a Kaprodi to access this page.');
    }
}
