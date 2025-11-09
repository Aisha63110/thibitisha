<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Practitioner;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'type',
        'value',
        'is_primary',


    ];

    public function practitioner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
}
