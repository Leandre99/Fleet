<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'driver_id',
        'pickup_address',
        'destination_address',
        'pickup_lat',
        'pickup_lng',
        'destination_lat',
        'destination_lng',
        'distance_km',
        'price',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
