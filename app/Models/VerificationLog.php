<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'ip_address',
        'user_agent',
        'is_valid',
        'verified_at',
    ];
}
