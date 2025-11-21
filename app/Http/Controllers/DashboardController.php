<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()

    {
        // general practitioners count
        $generalPractitioners = \App\Models\Practitioner::whereHas('speciality', function ($query) {
            $query->where('name', '=','UNKNOWN');
        })
        ->whereHas('status', function ($query) {
            $query->where('name', 'ACTIVE');
        })->count();

        // specialist practitioners count
         
        $specialistPractitioners = \App\Models\Practitioner::whereHas('speciality', function ($query) {
            $query->where('name', '!=','UNKNOWN');
        })
        ->whereHas('status', function ($query) {
            $query->where('name', 'ACTIVE');
        })->count();

        // valid verifications count
        $successfulVerifications = \App\Models\VerificationLog::where('is_valid', true)->count();
        // failed verfications count
        $failedVerifications = \App\Models\VerificationLog::where('is_valid', false)->count();

        return view('dashboard.index', compact('generalPractitioners', 'specialistPractitioners', 'successfulVerifications', 'failedVerifications'));
    }
}
