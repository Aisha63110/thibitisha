<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SubSpecialities;

class Practitioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'full_name',
        'profile_photo_url',
        'status_id',
        'speciality_id',
        'sub_speciality_id',
        'date_of_registration'
    ];
    /*  Relationships */

    
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    public function subSpeciality(): BelongsTo
    {
        return $this->belongsTo(SubSpeciality::class);
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    public function practitionerDocuments(): HasMany
    {
        return $this->hasMany(PractitionersDocument::class);
    }
    
    public function verificationLogs(): HasMany
    {
        return $this->hasMany(VerificationLog::class);
    }

}
