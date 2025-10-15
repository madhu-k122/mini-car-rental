<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'c_code',
        'c_user_id',
        'c_name',
        'c_type',
        'c_location',
        'c_price_per_day',
        'c_image',
        'c_is_approved',
        'c_status',
        'c_created_by',
        'c_updated_by'
    ];


    public function supplier()
    {
        return $this->belongsTo(User::class, 'c_user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function availabilities()
    {
        return $this->hasMany(CarAvailability::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
