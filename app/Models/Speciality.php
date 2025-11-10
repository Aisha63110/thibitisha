<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Akaunting\Sortable\Traits\Sortable;
// Ensure the SubSpecialities model exists and is correctly imported
use App\Models\SubSpeciality;

class Speciality extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialitiesFactory> */
    use HasFactory, Sortable;
    protected $fillable = ['name'];
    public $sortable = ['name'];

    public function practitioners(): HasMany
    {
        return $this->hasMany(Practitioner::class);
    }
    
    public function subSpecialities(): HasMany
    {
        return $this->hasMany(SubSpeciality::class);
    }
}
