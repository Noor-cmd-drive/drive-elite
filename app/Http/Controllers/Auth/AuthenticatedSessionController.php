<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // 🌟 Naya Add Kiya (reCAPTCHA verification ke liye)
use Illuminate\Validation\ValidationException; // 🌟 Naya Add Kiya (Error throw karne ke liye)
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 🌟 1. STRICT CAPTCHA VALIDATION (Form submit hone se pehle check karega)
        $request->validate([
            'g-recaptcha-response' => ['required'],
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        // 🌟 2. GOOGLE BACKEND VERIFICATION (Check karega ke Captcha real hai ya fake)
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        // Agar Google ne fail kar diya toh wapis login page par bhej dega error ke sath
        if (!$recaptchaResponse->json('success')) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Captcha verification failed. Please try again.'
            ]);
        }

        // 🌟 3. REGULAR LOGIN PROCESS (Agar Captcha theek hai toh Login karega)
        $request->authenticate();

        // 🚀 4. ELITE SECURITY PROTOCOL: Admin ko normal login se block karo
        if ($request->user()->role === 'admin') {
            
            // Foran logout karo aur session destroy karo
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Error message ke sath wapis normal login page par bhej do
            return back()->withErrors([
                'email' => 'Security Alert: Administrators must use the Secure Vault to log in.',
            ]);
        }

        $request->session()->regenerate();

        // 🌟 VIP Update: SweetAlert Message on Successful Login
        return redirect()->intended(route('dashboard', absolute: false))
            ->with('success', 'Welcome back to Drive Elite. Your Executive Terminal is ready.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Logout hone se pehle check karo ke user ADMIN tha ya NORMAL?
        $role = $request->user() ? $request->user()->role : 'user';

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // 3. SMART REDIRECT: Agar Admin logout ho raha hai toh wapis Vault par bhejo
        if ($role === 'admin') {
            return redirect()->route('admin.login.page')
                ->with('success', 'Vault securely locked. Goodbye Commander.');
        }

        // 🌟 VIP Update: SweetAlert Message on Secure Logout for Normal User
        return redirect('/')
            ->with('success', 'You have been securely logged out. We hope to serve you again soon.');
    }
}