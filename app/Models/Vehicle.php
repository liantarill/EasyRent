<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'brand',
        'year',
        'plate_number',
        'transmission',
        'fuel_type',
        'capacity',
        'price_per_day',
        'description',
        'photo',
        'vehicle_type',
        'status',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price_per_day, 0, ',', '.');
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
