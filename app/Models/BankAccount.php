<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccount extends Model
{
    /** @use HasFactory<\Database\Factories\BankAccountFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'agency_number',
        'account_number',
        'account_type',
        'pix',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
