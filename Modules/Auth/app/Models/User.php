<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// use Modules\Auth\Database\Factories\UserFactory;

class User extends Model
{
        use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone',
        'otp',
        'otp_expires_at'
    ];

    protected $hidden = [
        'password',
        'otp'
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
