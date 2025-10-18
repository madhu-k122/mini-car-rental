<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory,Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'code'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'integer',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isSupplier(): bool
    {
        return $this->role === 'supplier';
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'c_user_id');
    }

    public function bookingsAsSupplier()
    {
        return $this->hasMany(Booking::class, 'b_user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'b_user_id', 'id');
    }
}
