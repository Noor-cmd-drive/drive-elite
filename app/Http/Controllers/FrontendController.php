<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Newsletter; 
use App\Models\BotResponse; // 🚀 Database Fallback ke liye Model
use Illuminate\Support\Facades\Http; 

class FrontendController extends Controller
{
    public function index()
    {
        // Load settings to keep Navbar and Footer dynamic
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // 🌟 PROFESSIONAL UPDATE: Homepage Pagination & No Status Limit
        $featured_cars = Car::with('category')->latest()->paginate(3);
        
        return view('frontend.index', compact('settings', 'featured_cars'));
    }

    // 🌟 THE ELITE SEARCH ENGINE 🌟
    public function fleet(Request $request)
    {
        // Load settings
        $settings = Setting::pluck('value', 'key')->toArray();

        $query = Car::with('category');

        // 🧠 LOGIC 1: Filter by City/Location
        if ($request->filled('location') && $request->location !== 'Global Coverage') {
            $query->where('city', $request->location);
        }

        // 🧠 LOGIC 2: Filter by Vehicle Class (Category)
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->category . '%'); 
            });
        }

        // 🧠 LOGIC 3: Filter by Selected Brand (New Search Logic)
        if ($request->filled('search')) {
            $query->where('brand', $request->search);
        }

        // 🧠 LOGIC 4: Filter by Maximum Budget (New Price Logic)
        if ($request->filled('max_price')) {
            $query->where('daily_rent', '<=', $request->max_price);
        }

        // 🚀 LOGIC 5: ACCESSIBILITY FEATURE (Wheelchair Filter)
        if ($request->filled('wheelchair_accessible')) {
            $query->where('is_wheelchair_accessible', 1);
        }

        // Get results and paginate
        $cars = $query->latest()->paginate(9);

        return view('frontend.fleet', compact('settings', 'cars'));
    }

    // Show complete details of a single car
    public function showCar(Car $car)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.car_details', compact('settings', 'car'));
    }

    /**
     * 🌟 THE ELITE ABOUT PAGE
     */
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.about', compact('settings'));
    }
    
    public function services()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.services', compact('settings'));
    }

    /**
     * 🚀 NEWSLETTER SUBSCRIPTION LOGIC
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.unique' => 'You are already subscribed to our newsletter.',
            'email.email' => 'Please enter a valid email address.'
        ]);

        Newsletter::create([
            'email' => $request->email
        ]);

        return back()->with('success', 'Thank you! You have successfully subscribed to our newsletter.');
    }

    /**
     * 🤖 HYBRID CHATBOT LOGIC (AI + Database Fallback)
     */
    public function chatbotReply(Request $request)
    {
        $userMessage = strtolower($request->message);
        $apiKey = env('GEMINI_API_KEY');

        // 🛡️ PLAN B: DATABASE FALLBACK FUNCTION
        // Yeh function tab chalega jab AI fail hoga
        $dbFallback = function() use ($userMessage) {
            $botResponses = BotResponse::all();
            $reply = "I am sorry, I did not understand that. Please email us at driveelite099@gmail.com";
            
            foreach ($botResponses as $bot) {
                if (str_contains($userMessage, strtolower($bot->keyword))) {
                    $reply = $bot->response;
                    break;
                }
            }
            return response()->json(['reply' => $reply]);
        };

        // Agar API key .env mein nahi hai, toh seedha Database use karo
        if (!$apiKey) {
            return $dbFallback();
        }

        $systemPrompt = "You are the official customer support AI for 'Drive Elite', a premium car rental SaaS platform in Pakistan. 
        Your rules:
        1. Keep answers very short, polite, and conversational (max 2-3 sentences).
        2. Our daily rent starts from 5,000 PKR. We have Sedans, SUVs, and Economy cars.
        3. Our office is in Sargodha, but we deliver to Lahore, Islamabad, and Faisalabad.
        4. Do NOT use bold (**text**) or markdown formatting. Just plain text.
        5. If asked about features, mention our advanced search, VIP accessibility widget, and secure customer portal.
        
        User's message: " . $userMessage;

        try {
            // PLAN A: Google AI (gemini-1.5-flash) ko try karo
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $systemPrompt]]]
                ]
            ]);

            // Agar AI ne sahi jawab diya
            if ($response->successful()) {
                $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                $reply = str_replace(['**', '*', '`'], '', $reply);
                return response()->json(['reply' => trim($reply)]);
            } else {
                // 🚨 AI FAILED (Error 404/500): Khamoshi se Database wala jawab de do!
                return $dbFallback();
            }
        } catch (\Exception $e) {
            // 🚨 NETWORK FAILED (SSL Error/Internet Issue): Khamoshi se Database wala jawab de do!
            return $dbFallback();
        }
    }
}