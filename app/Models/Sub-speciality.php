<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Speciality;
use App\Models\Practitioner;

class SubSpeciality extends Model
{
    /** @use HasFactory<\Database\Factories\SubSpecialitiesFactory> */
    use HasFactory;
    protected $fillable = ['name', 'speciality_id'];

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }
    public function practitioners(): HasMany
    {
        return $this->hasMany(Practitioner::class);
    }
}
