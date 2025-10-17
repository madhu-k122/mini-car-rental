<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'b_car_id',
        'b_user_id',
        'b_start_date',
        'b_end_date',
        'b_total_price',
        'b_status',
        'b_code'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'b_car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'b_user_id');
    }

    // The supplier (owner of the car)
    public function supplier()
    {
       return $this->belongsTo(User::class, 'b_user_id');
    }
}
