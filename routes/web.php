<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'isAdmin']);
Route::get('/auth', function () {
    return 'Hello Auth';
})->middleware('auth');
Route::resource('/students', StudentController::class)->middleware(['auth', 'isAdmin']);
Route::resource('/teachers', TeacherController::class)->middleware(['auth', 'isAdmin']);
Route::get('/classes', [StudentController::class, 'classe'])->middleware(['auth', 'isAdmin']);
Route::post('/classes', [StudentController::class, 'editClasse'])->middleware(['auth', 'isAdmin']);
Route::get('/terms', [StudentController::class, 'terms'])->middleware(['auth', 'isAdmin']);
Route::post('/terms', [StudentController::class, 'editTerm'])->middleware(['auth', 'isAdmin']);
Route::get('/teacher', [TeacherPageController::class, 'teacher'])
    ->name('teacher')
    ->middleware('auth');
Route::get('/class/{class}/{subject}', [TeacherPageController::class, 'classe'])->middleware('auth');
Route::post('/addGrade/{user}/{classID}/{subjectID}', [TeacherPageController::class, 'addGrade'])->middleware('auth');

Route::get('/studentPage', [StudentPageController::class, 'index'])->middleware('auth');
Route::get('/image', function () {
    return view('image');
});
Route::post('/image',[AuthController::class,'image']);

// Route::get('/email/verify', [AuthController::class,'verifyNotice'])->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
// use Illuminate\Http\Request;

// Route::post('/email/verification-notification', [AuthController::class,'resendEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
