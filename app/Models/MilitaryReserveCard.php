<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilitaryReserveCard extends Model
{
    /** @use HasFactory<\Database\Factories\MilitaryReserveCardFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reserve_card_number',
        'series_number',
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
