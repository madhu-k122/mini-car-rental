<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CarAvailability extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'car_availabilities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'a_code',
        'a_car_id',
        'a_date',
        'a_is_available',
        'a_status',
        'a_created_by',
        'a_updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->a_code = 'AV' . strtoupper(Str::random(6));
            $model->a_created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->a_updated_by = auth()->id();
        });
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'a_car_id');
    }
}
