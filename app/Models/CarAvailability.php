<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarAvailability extends Model
{
    protected $fillable = ['car_id','blocked_from','blocked_to'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
