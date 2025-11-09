<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    // Eloquent -ORM  - object Relational Mapper
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];
    protected $table = 'roles';
    // relationship
    //1-m
    // 1 role has many users(innerjoin,outerjoin left join)
    // an admin has many users
    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
    // get the number of users in one role
    public function users_count()
    {
        return $this->users()->count();
    }
}
