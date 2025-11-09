<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PractitionersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\SpecialitiesController;
use App\Http\Controllers\SubSpecialitiesController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\SettingsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Default Laravel welcome page (root URL)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/verify', function () {
    return view('pages.verify');
});

Route::get('/mkubwa', function () {
    return view('admin.dashboard');
});

//Method,name, action
//Route::get('roles',[RoleController::class,'index'])-> name('roles.index');
// resource routes
Route::resource('roles', RoleController::class);
// index (listing all roles), showing the create form, saving the form 
//showing the edit form, saving the form
//deleting a record
Route::resource('users', UserController::class);
Route::resource('practitioners', PractitionersController::class);
Route::resource('contacts', ContactController::class);
Route::resource('qualifications', QualificationController::class);
Route::resource('statuses', StatusesController::class);
Route::resource('specialities', SpecialitiesController::class);
Route::resource('subspecialities', SubSpecialitiesController::class);
Route::resource('institutions', InstitutionController::class);
Route::resource('degrees', DegreeController::class);
Route::resource('settings', SettingsController::class);