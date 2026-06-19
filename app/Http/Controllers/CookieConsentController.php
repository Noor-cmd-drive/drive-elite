<?php

namespace App\Http\Controllers;

use App\Models\CookieConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CookieConsentController extends Controller
{
    // Frontend se data save karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'consent_status' => 'required|in:accept_all,reject_all,customized',
            'preferences' => 'nullable|array'
        ]);

        $existingConsent = CookieConsent::where('ip_address', $request->ip())->first();

        $data = [
            'ip_address' => $request->ip(),
            'user_id' => Auth::check() ? Auth::id() : null,
            'consent_status' => $request->consent_status,
            'preferences' => $request->preferences ?? [],
        ];

        if ($existingConsent) {
            $existingConsent->update($data);
        } else {
            CookieConsent::create($data);
        }

        return response()->json(['success' => true, 'message' => 'Preferences saved securely!']);
    }

    // Admin Panel mein data dikhane ke liye
    public function index()
    {
        // Sab se latest consent pehle aayega
        $consents = CookieConsent::with('user')->latest()->get();
        return view('admin.cookies', compact('consents'));
    }
    public function destroy($id)
{
    CookieConsent::findOrFail($id)->delete();
    return back()->with('success', 'Record deleted successfully! User will be prompted again.');
}
}