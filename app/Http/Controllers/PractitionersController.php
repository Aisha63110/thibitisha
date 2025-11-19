<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepractitionersRequest;
use App\Http\Requests\UpdatepractitionersRequest;
use App\Livewire\Practitioners as LivewirePractitioners;
use App\Models\practitioners;

class PractitionersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('practitioners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepractitionersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LivewirePractitioners $practitioners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LivewirePractitioners $practitioners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepractitionersRequest $request, LivewirePractitioners $practitioners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LivewirePractitioners $practitioners)
    {
        //
    }
}
