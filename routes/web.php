<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

    Route::get('/student',action: [StudentController::class, 'index']) ->name('students.index');
    Route::get('/student/create',action: [StudentController::class, 'create']) ->name('students.create');
    Route::post('/student',action: [StudentController::class, 'store']) ->name('students.store');
    Route::get('/student/{student}/edit',action: [StudentController::class, 'edit']) ->name('students.edit');
    Route::put('/student/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/student/{student}/delete', [StudentController::class, 'delete'])->name('students.delete');


