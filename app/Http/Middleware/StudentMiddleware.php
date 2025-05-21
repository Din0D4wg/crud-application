<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'student') {
            return $next($request);
        }

        return redirect('/dashboard-posts')->with('error', 'This page is for students only.');
    }
}