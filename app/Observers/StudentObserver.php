<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $user = User::create([
            'name' => $student->firstname . ' ' . $student->lastname,
            'email' => $student->email,
            'password' => Hash::make('password123'), // Temporary password
            'role' => 'student',
        ]);

        // Link the user to the student
        $student->user_id = $user->id;
        $student->save();
    }
}
