<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
//        return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cpf_number',
        'name',
        'nickname',
        'nationality',
        'born_in',
        'gender',
        'fathers_name',
        'mothers_name',
        'marital_status',
        'email',
        'photo',
        'birth_date',
        'password',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => 'string',
            'marital_status' => 'string',
        ];
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function identity(): HasOne
    {
        return $this->hasOne(Identity::class);
    }

    public function electoral(): HasOne
    {
        return $this->hasOne(Electoral::class);
    }

    public function militaryReserveCard(): HasOne
    {
        return $this->hasOne(MilitaryReserveCard::class);
    }

    public function driverLicense(): HasOne
    {
        return $this->hasOne(DriverLicense::class);
    }

    public function socialSecurityNumber(): HasOne
    {
        return $this->hasOne(SocialSecurityNumber::class);
    }

    public function comorbidities(): BelongsToMany
    {
        return $this->belongsToMany(Comorbidity::class);
    }

    public function vaccines()
    {
        return $this->belongsToMany(Vaccine::class, 'user_vaccine')
            ->withPivot('dose', 'vaccination_date', 'next_dose_due')
            ->withTimestamps();
    }
}
