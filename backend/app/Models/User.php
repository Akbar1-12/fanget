<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [

        'name',

        'artist_name',

        'email',

        'password',

        'is_approved',

    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [

        'password',

        'remember_token',

    ];

    /**
     * Attribute Casting
     */
    protected $casts = [

        'email_verified_at' => 'datetime',

        'password' => 'hashed',

        'is_approved' => 'boolean',

    ];

    /**
     * Campaigns
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * Email Verification Notification
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    /**
     * Password Reset Notification
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
