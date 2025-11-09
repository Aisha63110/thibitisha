<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationLog extends Model
{
    /** @use HasFactory<\Database\Factories\VerificationLogsFactory> */
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'ip_address',
        'user_agent',
        'is_valid',
        'verified_at'
    ];
public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
}
