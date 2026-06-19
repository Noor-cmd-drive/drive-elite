<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Data save karne ki ijazat
    protected $fillable = ['name', 'description'];

    // Relationship: Ek category mein bohat si gariyan (cars) ho sakti hain
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}