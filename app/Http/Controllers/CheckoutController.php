<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Setting; // 🌟 Ye shamil karna zaroori hai

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        
        // 🌟 Sari settings ko array mein load karein taake frontend par show hon
        $settings = Setting::pluck('value', 'key')->toArray();

        $data = [
            'car'         => $car,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_days'  => $request->total_days,
            'total_price' => $request->total_price,
            'settings'    => $settings, // 🌟 Ye settings frontend ko pass karein
        ];

        return view('checkout.index', $data);
    }
}