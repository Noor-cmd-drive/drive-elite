<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Data save karne ki ijazat (Naye columns ke sath)
    protected $fillable = [
        'category_id', 'brand', 'model_name', 'city', 'year', 
        'daily_rent', 'is_available', 'seats', 'fuel_type',
        'transmission', 'description', 'image', 'is_wheelchair_accessible'
    ];

    // Relationship: Ek gari kisi ek category ka hissa hoti hai
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Gari ki maintenance history
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}