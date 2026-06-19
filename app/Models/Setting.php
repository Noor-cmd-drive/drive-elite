<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Ye line batati hai ke in columns mein data save karne ki ijazat hai
    protected $fillable = ['key', 'value'];
}