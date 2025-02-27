<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserIdentity extends Model
{
    /** @use HasFactory<\Database\Factories\UserIdentityFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'identity_number',
        'issuing_authority',
        'issue_date',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
