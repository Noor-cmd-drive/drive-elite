<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
        
        // 🌟 NAYE PAYMENT FIELDS (ULTRA PREMIUM PRO PLUS) 🌟
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_proof',
    ];

    // Relationships (Taake hum gari ka naam dashboard par dikha sakein)
    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}