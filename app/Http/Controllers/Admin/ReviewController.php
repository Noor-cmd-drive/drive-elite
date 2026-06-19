<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // 1. Saare reviews ki list dikhana
    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // 2. Review ko Approve (Publish) karna
    public function update(Request $request, Review $review)
    {
        $review->update(['is_published' => true]);
        return back()->with('success', 'Reflection has been published to the landing page.');
    }

    // 3. Ghalat review ko delete karna
    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Reflection removed successfully.');
    }
}