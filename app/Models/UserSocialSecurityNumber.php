<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialSecurityNumber extends Model
{
    /** @use HasFactory<\Database\Factories\UserSocialSecurityNumberFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pis_pasep',
        'nit',
        'nis',
    ];
}
