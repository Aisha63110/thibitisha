<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speciality extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialitiesFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    public function practitioners(): HasMany
    {
        return $this->hasMany(Practitioner::class);
    }
    
    public function subSpecialities(): HasMany
    {
        return $this->hasMany(SubSpeciality::class);
    }
}
