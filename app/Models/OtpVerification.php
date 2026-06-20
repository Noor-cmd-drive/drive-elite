<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    // 🚀 Yeh line add karein taake Laravel data save karne de
    protected $fillable = ['email', 'otp'];
}