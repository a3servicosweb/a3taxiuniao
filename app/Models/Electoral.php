<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Electoral extends Model
{
    /** @use HasFactory<\Database\Factories\ElectoralFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voter_registration_number',
        'voting_zone',
        'voting_section',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
