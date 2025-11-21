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
        return view('dashboard.index', compact('generalPractitioners', 'specialistPractitioners'));
    }
}
