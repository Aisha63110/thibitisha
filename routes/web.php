<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PractitionersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SubSpecialityController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VerificationLogsController;

/*
|--------------------------------------------------------------------------
| Public routes (no auth required)
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Static pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/verify', function () {
    return view('pages.verify');
})->name('verify');

// Login form
Route::get('login', [UserController::class, 'login'])->name('login');

// Handle login submission
Route::post('login', [UserController::class, 'authenticate'])->name('login.submit');

/*
|--------------------------------------------------------------------------
| Protected routes (require auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Admin dashboard (only one route, no duplicates)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset_password');
    Route::resource('practitioners', PractitionersController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('qualifications', QualificationController::class);
    Route::resource('statuses', StatusController::class);
    Route::resource('specialities', SpecialityController::class);
    Route::resource('subspecialities', SubSpecialityController::class);
    Route::resource('institutions', InstitutionController::class);
    Route::resource('degrees', DegreeController::class);
    Route::resource('settings', SettingsController::class);

    // Verifications (logs)
    Route::resource('verifications', VerificationLogsController::class);

    // ✅ Logout route should be last
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
