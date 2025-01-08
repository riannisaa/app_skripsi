<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the authenticated user has the 'mahasiswa' role
         if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // If the user is not a Mahasiswa, redirect to another page (e.g., login)
        return redirect()->back()->with('error', 'Access denied. You must be an Admin to access this page.');
    }
}
