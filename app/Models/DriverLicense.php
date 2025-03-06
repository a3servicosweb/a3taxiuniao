<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLicense extends Model
{
    /** @use HasFactory<\Database\Factories\DriverLicenseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'license_category',
        'issue_date',
        'expiration_date',
        'first_license_date',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiration_date' => 'date',
            'first_license_date' => 'date',
        ];
    }
}
