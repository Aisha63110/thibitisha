<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all roles from the database<Model>
        $roles = Role::all();// return an eloquent collection with all the roles in the 

        //view <Display>
        return view( 'roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreRoleRequest $request)
{
    $name = $request->get('name');
    $description = $request->get('description');

    $newRole = new Role;
    $newRole->name = $name;
    $newRole->description = $description;
    $newRole->save();

    // Redirect back to the role index with a success message
    return redirect()->route('roles.index')->with('success', 'Role added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
