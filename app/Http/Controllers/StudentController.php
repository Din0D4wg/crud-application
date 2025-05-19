<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;


class StudentController extends Controller
{
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
            'username' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $newStudent = Student::create($data);

        return redirect(route('students.index'));
    }

    public function edit(Student $student) {
        return view('students.edit', ['student' => $student]);

    }

    public function update(Student $student, Request $request) {
        try {
            $data = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'username' => 'required',
                'email' => 'required',
                'phone' => 'nullable',
                'password' => 'required',
            ]);

            $student->update($data);

            return redirect(route('students.index'))->with('success', 'Student Information Updated Successfully!!');
        } catch (Exception $e) {
            // If error happens
            Log::error('Student update failed: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function delete(Student $student) {
        $student->delete();
        return redirect(route('students.index'))->with('success', 'Student Information Deleted Successfully!!');

    }
}
