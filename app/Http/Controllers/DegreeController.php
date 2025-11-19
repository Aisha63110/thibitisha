<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Http\Requests\StoreDegreeRequest;
use App\Http\Requests\UpdateDegreeRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DegreeController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $degrees = Degree::all();
        return view('degrees.index', compact('degrees'));
    }

    public function create()
    {
        $this->authorize('create', Degree::class);
        return view('degrees.create');
    }

    public function store(StoreDegreeRequest $request)
    {
        Degree::create($request->validated());
        return redirect()->route('degrees.index')->with('success', 'Degree added successfully!');
    }

    public function edit(Degree $degree)
    {
        $this->authorize('update', $degree);
        return view('degrees.edit', compact('degree'));
    }

    public function update(UpdateDegreeRequest $request, Degree $degree)
    {
        $degree->update($request->validated());
        return redirect()->route('degrees.index')->with('success', 'Degree updated successfully!');
    }

    public function destroy(Degree $degree)
    {
        $this->authorize('delete', $degree);
        $degree->delete();
        return redirect()->route('degrees.index')->with('success', 'Degree deleted successfully!');
    }
}
