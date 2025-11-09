<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    /** @use HasFactory<\Database\Factories\DegreeFactory> */
    use HasFactory;

    protected $fillable = [];

    // degree relationships

    // 1 degree has many qualifications
    public function qualifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Qualification::class);
    }

    
}
