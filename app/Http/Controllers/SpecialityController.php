<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Rules\AlphaSpaces;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $search = trim(request('search'));

    if (request()->has('search')) {
        request()->validate([
            'search' => [new AlphaSpaces()],
        ]);

        $specialities = \App\Models\Speciality::where('name', 'LIKE', "%{$search}%")
            ->sortable()
            ->paginate(env('PAGINATION_COUNT', 10)); // Add pagination here too

        return view('specialities.index', compact('specialities'));
    }

    $specialities = \App\Models\Speciality::query()
        ->sortable()
        ->paginate(env('PAGINATION_COUNT', 10));

    return view('specialities.index', compact('specialities'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specialities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $speciality = new \App\Models\Speciality();
        $speciality->name = $request->get('name');
        $speciality->save();
        return redirect()->route('specialities.index')->with('success', 'Speciality added successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Speciality $speciality)
    {
        return view('specialities.edit',compact('speciality') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Speciality $speciality)
    {
;
        $speciality->name = $request->get('name');
        $speciality->save();
        return redirect()->route('specialities.index')->with('success', 'Speciality updated successfully.');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $speciality = \App\Models\Speciality::findOrFail($id);
            $speciality->delete();
            return redirect()->route('specialities.index')->with('success', 'Speciality deleted successfully.');

        }catch( QueryException $e){
            //log
            Log::error('Error deleting speciality: '.$e->getMessage());
            return redirect()->route('specialities.index')->with('error', 'cannot delete speciality because it has one or more subspecialities .');

        }
    }
}
