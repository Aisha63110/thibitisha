<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\License;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    protected $fillable = [
        'license_id',
        'amount',
        'payment_date',
        'method',
        'status'
    ];

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}
