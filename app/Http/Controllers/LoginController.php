<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
{
    // First try to login as admin
    if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
        return redirect('/admin/students'); // Admin sees the CRUD
    }

    // Then try to login as student
    if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
        return redirect('/'); // Student sees the blog post
    }

    return back()->withErrors(['login' => 'Invalid credentials.']);
}
}
