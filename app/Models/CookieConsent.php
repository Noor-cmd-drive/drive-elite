<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_id',
        'consent_status',
        'preferences',
    ];

    // JSON column ko array mein convert karne ke liye
    protected $casts = [
        'preferences' => 'array',
    ];

    // User ke sath relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}