<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate users (default 10 per page, configurable via .env)
        $users = User::with('role')->orderBy('id', 'desc')->paginate(env('PAGINATION_COUNT', 10));
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role');
        $user->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'thibit1sha'));
        $user->save();

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role');
        // We are not updating the password here
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Reset a user's password to the default.
     */
    public function resetPassword(User $user)
    {
        $user->password = Hash::make(env('USER_DEFAULT_PASSWORD', 'thibit1sha'));
        $user->save();
        //@TODO : Notifications(email,sms)
        return redirect()->route('users.index')->with('success', 'User password reset successfully.');
    }
}
