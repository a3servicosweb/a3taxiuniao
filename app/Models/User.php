<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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

    public function userAddress(): HasOne
    {
        return $this->hasOne(UserAddress::class);
    }

    public function userIdentity(): HasOne
    {
        return $this->hasOne(UserIdentity::class);
    }

    public function userElectoral(): HasOne
    {
        return $this->hasOne(UserElectoral::class);
    }

    public function userMilitaryReserveCard(): HasOne
    {
        return $this->hasOne(UserMilitaryReserveCard::class);
    }
}
