<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    /**
     * Get the listings created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Listing>
     */
    public function listings(): HasMany
    {
        return $this->hasMany(
            Listing::class,
            'by_user_id'
        );
    }
    /**
     * Get the offers created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Offer>
     */
    public function offers(): HasMany
    {
        return $this->hasMany(
            Offer::class,
            'bidder_id'
        );
    }
}
