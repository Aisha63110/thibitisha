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
        // practitioner distribution by status
        $practitionerDistribution = \App\Models\Practitioner::selectRaw('status_id, COUNT(*) as count')
            ->groupBy('status_id')
            ->with('status')
            ->get();
        dd($practitionerDistribution);
        /**
         * ['ACTIVE' => 12, 'INACTIVE' => 2, ]
         */
        $practitionerDistributionByStatus = $practitionerDistributionByStatus->mapWithKeys(function ($item) {
            return [$item->status->name => $item->count];
        })->toArray();

        dd($practitionerDistributionByStatus);
        return view('dashboard.index', compact('generalPractitioners', 'specialistPractitioners', 'successfulVerifications', 'failedVerifications', 'practitionerDistributionByStatus'));
    }
}
