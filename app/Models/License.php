<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    /** @use HasFactory<\Database\Factories\LicenseFactory> */
    use HasFactory;
    protected $fillable = [
        'practitioner_id',
        'license_number',
        'issue_date',
        'expiry_date',
        'status'
    ];

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
