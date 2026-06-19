<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // 🌟 Yeh line add karein:
    protected $fillable = [
        'user_id', 
        'rating', 
        'comment', 
        'is_published'
    ];

    /**
     * Review ka user ke sath rishta (Relationship)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}