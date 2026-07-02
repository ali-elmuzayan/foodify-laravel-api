<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['name', 'email', 'password', 'otp', 'otp_expires_at', 'phone', 'status', 'role', 'verified_at'])]
#[Hidden(['password', 'remember_token', 'otp', 'otp_expires_at', 'verified_at'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    // Relationships:
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    // check if the user if verified
    public function isVerified(): bool
    {
        return $this->verified_at !== null;
    }

    // validate teh user 
    public function verifyUser(): void
    {
        // by select verified_at to now()
        $this->verified_at = now();
        $this->save();
    }

    // get the JWT identifier
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // get the JWT custom claims
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * Scopes 
     */
    #[Scope]
    public function wherePhone(Builder $query, string $phone): Builder
    {
        return $query->where('phone', $phone);
    }   
}
