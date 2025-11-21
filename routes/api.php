<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

   // route to practitioner API controller
Route:: apiResource('v1/practitioners', App\Http\Controllers\v1\PractitionerApiController::class);

//verifying practitioner
Route::post('v1/practitioners/verify', [App\Http\Controllers\v1\PractitionerApiController::class, 'verify']);

});