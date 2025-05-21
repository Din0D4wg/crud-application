<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('admin'); 
    }

    public function index() {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    public function create() {
        return view('students.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|unique:students',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string',
            'password' => 'required|min:6',
        ]);
        
        // Create user account first
        $user = User::create([
            'name' => $data['firstname'] . ' ' . $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student'
        ]);
        
        // Create student record linked to user
        $student = Student::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'user_id' => $user->id,
        ]);

        return redirect(route('students.index'))->with('success', 'Student created successfully');
    }

    public function edit(Student $student) {
        return view('students.edit', ['student' => $student]);
    }

    public function update(Student $student, Request $request) {
        try {
            $emailChanged = $request->email !== $student->email;
            
            // Basic validation
            $validationRules = [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'username' => 'required|unique:students,username,'.$student->id,
                'phone' => 'nullable|string',
            ];
            
            if ($emailChanged) {
                $validationRules['email'] = 'required|email|unique:users,email,'.$student->user_id;
            } else {
                $validationRules['email'] = 'required|email';
            }
            
            $data = $request->validate($validationRules);

            // Update student record
            $student->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
            ]);
            
            $user = $student->user;
            

            $existingUserWithEmail = User::where('email', $data['email'])
                                    ->where('id', '!=', $student->user_id)
                                    ->first();
            
            if ($existingUserWithEmail) {
                Log::info('Linking student ' . $student->id . ' to existing user ' . $existingUserWithEmail->id);
                $student->update(['user_id' => $existingUserWithEmail->id]);
                $user = $existingUserWithEmail;
            }
            
            if ($user) {
                $updateData = [
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'email' => $data['email'],
                ];
                
                if ($request->filled('password')) {
                    $updateData['password'] = Hash::make($request->password);
                }
                
                $user->update($updateData);
            } else {
                $existingUser = User::where('email', $data['email'])->first();
                
                if ($existingUser) {
                    $student->update(['user_id' => $existingUser->id]);
                } else {
                    // Only create a new user if one doesn't already exist with this email
                    $user = User::create([
                        'name' => $data['firstname'] . ' ' . $data['lastname'],
                        'email' => $data['email'],
                        'password' => Hash::make($request->password ?? 'password123'), // Default password
                        'role' => 'student'
                    ]);
                    
                    $student->update(['user_id' => $user->id]);
                }
            }

            return redirect(route('students.index'))->with('success', 'Student updated successfully');
        } catch (Exception $e) {
            Log::error('Student update failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function delete(Student $student) {
        // Delete the user account
        if ($student->user) {
            $student->user->delete();
        } else {
            $student->delete();
        }
        
        return redirect(route('students.index'))->with('success', 'Student deleted successfully');
    }
}