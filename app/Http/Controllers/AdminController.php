<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function dashboard()
    {
        $studentCount = Student::count();
        $postCount = Post::count();
        $userCount = User::count();
        
        return view('admin.dashboard', compact('studentCount', 'postCount', 'userCount'));
    }
}