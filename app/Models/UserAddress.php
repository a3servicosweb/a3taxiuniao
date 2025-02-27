<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class UserAddress extends Model
{
    /** @use HasFactory<\Database\Factories\UserAddressFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'postal_code',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'uf',
        'reference_point',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
