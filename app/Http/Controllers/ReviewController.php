<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // 🌟 Yeh zaroori hai model ko use karne ke liye
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * 🌟 STORE CUSTOMER REFLECTION
     */
    public function store(Request $request) 
    {
        // 1. Strict Validation
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500'
        ]);

        // 2. Secure Data Creation
        Review::create([
            'user_id'      => Auth::id(),
            'rating'       => $request->rating,
            'comment'      => $request->comment,
            'is_published' => false, // By default admin check karega pehle
        ]);

        // 3. VIP Success Response
        return back()->with('success', 'Thank you! Your elite reflection has been securely submitted and will be live after verification.');
    }
}