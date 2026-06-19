<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Settings ka page dikhane ke liye
    public function index()
    {
        // Database se saari settings nikal kar ek simple Array mein convert kar li
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    // Settings ko save/update karne ke liye
    public function update(Request $request)
    {
        // Token ke ilawa baqi sab data le lo
        $data = $request->except(['_token']);
        
        // Loop chala kar har field ko key aur value mein save ya update kar do
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key], 
                ['value' => $value]
            );
        }

        return back()->with('success', 'System Settings Successfully Updated!');
    }

    // 🚀 NEW: Custom Admin Login Logic (Security Vault)
    public function adminLogin(Request $request)
    {
        // 1. Validate karein ke email aur password enter kiya gaya hai
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Database mein check karein ke kya details theek hain
        if (auth()->attempt($credentials)) {
            
            // 3. Check karein ke kya login karne wala waqai ADMIN hai
            if (auth()->user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // Agar koi normal user admin page se login karne ki koshish kare, toh usay bahar nikal do
            auth()->logout();
            return back()->withErrors(['email' => 'Access Denied. You are not an administrator.']);
        }

        // Agar Email ya Password galat ho
        return back()->withErrors(['email' => 'Invalid security credentials.']);
    }
}