<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Setting; // 🌟 Yeh import add kiya hai taake company details load ho sakein
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * 🌟 NEW: SHOW CONTACT PAGE 🌟
     */
    public function index()
    {
        // Admin settings se phone, email, etc. load kar ke view ko pass kar rahe hain
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.contact', compact('settings'));
    }

    /**
     * 🌟 SECURE CONTACT ENGINE (Premium Level)
     */
    public function store(Request $request)
    {
        try {
            // 1. Strict Data Validation (Spam Protection)
            $request->validate([
                'name'    => 'required|string|max:100',
                'email'   => 'required|email|max:150',
                'phone'   => 'nullable|string|max:20',
                'subject' => 'nullable|string|max:200',
                'message' => 'required|string|min:10|max:2000',
            ], [
                'message.min' => 'Your message must be at least 10 characters long.',
            ]);

            // 2. Secure Database Entry
            Contact::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status'  => 'unread' // By default unread rahega admin ke liye
            ]);

            // 3. VIP Success Response
            return back()->with('success', 'Your message has been securely transmitted to our executive team. We will reach out to you shortly.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Agar user ne data sahi nahi dala
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // Agar system crash ho (Admin Alert)
            Log::error('Contact Form Crash: ' . $e->getMessage());
            return back()->with('error', 'A secure connection could not be established. Please try again later.')->withInput();
        }
    }
}