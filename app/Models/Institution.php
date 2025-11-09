<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;
    protected $fillable = ['name', 'abbrev'];
    // institution relationships

    // 1 institution has many qualifications
    public function qualifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Qualification::class);
    }
}
