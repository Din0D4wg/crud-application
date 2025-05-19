<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is a student
        if (Auth::check() && Auth::user()->role === 'student') {
            return $next($request);
        }

        // If user is admin, redirect to admin dashboard
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('info', 'Admin users should use the admin dashboard.');
        }

        // Redirect to login page with error message
        return redirect()->route('login')->with('error', 'Access denied. Student account required.');
    }
}