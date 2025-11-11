<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved_by',
        'vehicle_id',
        'rent_date',
        'return_date',
        'daily_price_snapshot',
        'total_price',
        'rent_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }


    public function getRentalDaysAttribute()
    {
        $rentDate = \Carbon\Carbon::parse($this->rent_date);
        $returnDate = \Carbon\Carbon::parse($this->return_date);
        return $rentDate->diffInDays($returnDate);
    }
}
