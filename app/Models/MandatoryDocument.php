<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandatoryDocument extends Model
{
    /** @use HasFactory<\Database\Factories\MandatoryDocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_mandatory',
        'requires_file',
    ];
}
