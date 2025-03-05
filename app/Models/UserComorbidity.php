<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComorbidity extends Model
{
    /** @use HasFactory<\Database\Factories\UserComorbidityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}
