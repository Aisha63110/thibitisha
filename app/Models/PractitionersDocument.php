<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PractitionersDocument extends Model
{
    /** @use HasFactory<\Database\Factories\PractitionersDocumentsFactory> */
    use HasFactory;
    protected $fillable = [
        'practitioner_id',
        'document_type',
        'file_path',
        'uploaded_at'
    ];

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
}
