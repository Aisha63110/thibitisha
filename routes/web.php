<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PractitionersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SubSpecialityController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Root URL → Home page
Route::get('/', function () {
    return view('pages.home');
});

// Static pages
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/verify', function () {
    return view('pages.verify');
});

// Admin dashboard
Route::get('/mkubwa', function () {
    return view('admin.dashboard');
});

// Resource routes
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Reset a user's password (admin panel)
Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset_password');

Route::resource('practitioners', PractitionersController::class);
Route::resource('contacts', ContactController::class);
Route::resource('qualifications', QualificationController::class);
Route::resource('statuses', StatusesController::class);
Route::resource('specialities', SpecialityController::class);
Route::resource('subspecialities', SubSpecialityController::class);
Route::resource('institutions', InstitutionController::class);
Route::resource('degrees', DegreeController::class);
Route::resource('settings', SettingsController::class);
