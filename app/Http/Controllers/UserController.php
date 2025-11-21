<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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
        return view('users.edit', compact('user', '/mkubwa', 'roles'));
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
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
{
    // validate the form
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // regenerate session to prevent fixation
        $request->session()->regenerate();

        // ✅ go to dashboard
        return redirect()->intended('/mkubwa');
    }

    // Authentication failed
    return redirect()->back()
        ->withErrors(['email' => 'Invalid credentials provided.'])
        ->withInput();
}

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to landing page
    return redirect('/');
}

// profile 
    public function profile()
    {
        $user = Auth::user();
        // courtesty of laravel sanctum (HasApiTokens trait in User model)
        $tokens = $user->tokens;
        return view('users.profile', compact('user', 'tokens'));
    }

    public function generateToken(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'token_name' => 'required|string|max:255',
    ]);

    $abilities = $request->input('abilities', []); // keep abilities separate

    // create a token
    $token = $user->createToken($request->input('token_name'), $abilities);

    return redirect()->route('users.profile')
        ->with('success', 'API Token generated successfully.')
        ->with('token_value', $token->plainTextToken);
}

public function revokeToken(Request $request, $tokenId)
{
    $user = Auth::user();

    try {
        $user->tokens()->where('id', $tokenId)->delete();
        return redirect()->route('users.profile')
            ->with('success', 'API Token revoked successfully.');
    } catch (\Exception $e) {
        return redirect()->route('users.profile')
            ->with('error', 'Failed to revoke API Token.');
    }
}
public function revokeAllTokens(Request $request)
{
    $user = Auth::user();

    try {
        $user->tokens()->delete();
        return redirect()->route('users.profile')
            ->with('success', 'All API Tokens revoked successfully.');
    } catch (\Exception $e) {
        return redirect()->route('users.profile')
            ->with('error', 'Failed to revoke API Tokens.');
    }

} 

    
}

