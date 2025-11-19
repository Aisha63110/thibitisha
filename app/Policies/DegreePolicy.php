<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Degree;

class DegreePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view
    }

    public function view(User $user, Degree $degree): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role && strtolower($user->role->name) === 'admin';
    }

    public function update(User $user, Degree $degree): bool
    {
        return $user->role && strtolower($user->role->name) === 'admin';
    }

    public function delete(User $user, Degree $degree): bool
    {
        return $user->role && strtolower($user->role->name) === 'admin';
    }
}

