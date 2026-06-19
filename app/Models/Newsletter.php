<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    // ✅ Yeh line add karni hai taake email save ho sakay
    protected $fillable = ['email'];
}