<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'service_type',
        'cost',
        'service_date',
        'next_service_date',
        'notes'
    ];

    // Ek maintenance record kisi ek gari (Car) ka hota hai
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}