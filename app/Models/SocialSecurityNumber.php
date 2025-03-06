<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSecurityNumber extends Model
{
    /** @use HasFactory<\Database\Factories\SocialSecurityNumberFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pis_pasep',
        'nit',
        'nis',
    ];
}
