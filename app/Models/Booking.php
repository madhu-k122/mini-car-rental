<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'b_car_id','b_user_id','b_from_date','b_to_date','b_total_price','b_status'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'b_user_id');
    }
}