<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');// api authentication

// route to practitioner api controller
Route:: apiResource('v1/practitioners', App\Http\Controllers\v1\PractitionerApiController::class);

Route::post('v1/practitioners/verify', [App\Http\Controllers\v1\PractitionerApiController::class, 'verify']);