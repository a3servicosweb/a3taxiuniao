<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comorbidity extends Model
{
    /** @use HasFactory<\Database\Factories\ComorbidityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
