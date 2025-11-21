<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Livewire\Practitioners;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PractitionerApiController extends Controller
{
    // GET, POST, PUT, DELETE methods
    /**
     * Display a listing of the practitioners.
     */
    public function index() : JsonResponse
    {
        //Limit to 5 practitioners
        $practitioners = Practitioners::limit(50)->get() ->toArray();
        return response()->json(['status' => 'success', 'data' => $practitioners], 200);
    }

    public function verify(Request $request) : JsonResponse
    {
        $registration_number = $request->input('registration_number');
        // select from practitioners
        $practitioners = Practitioners::where('registration_number', $registration_number)
           
            ->first();
        //verification successful
        if ($practitioners || !ctype_digit($registration_number)) {
            return response()->json(['status' => 'success', 'data' => $practitioners], 200);
        } else {
            // verification failed
            return response()->json(['status' => 'error', 'message' => 'Practitioner not found'], 404);
        }
    }

    /**
     * Store a newly created practitioner in storage.
     */
    public function store(Request $request)
    {
        // validate and save a new practitioner
    }

    /**
     * Display the specified practitioner.
     */
    public function show($id)
    {
        return $this->verify($id);
    }

    /**
     * Update the specified practitioner in storage.
     */
    public function update(Request $request, $id)
    {
        // validate and update practitioner by id
    }

    /**
     * Remove the specified practitioner from storage.
     */
    public function destroy($id)
    {
        // delete practitioner by id
    }
}
