<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; 
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException; 
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 🌟 STRICT NAME: No numbers allowed at all, only alphabets and spaces
            'name' => [
                'required', 
                'string', 
                'max:255', 
                'not_in:admin,administrator,root,Admin,Administrator,Root', 
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            
            // 🌟 SMART PHONE: International format (10 to 15 digits, optional +)
            'phone' => [
                'required', 
                'string', 
                'min:10', 
                'max:15', 
                'regex:/^\+?[0-9]+$/'
            ],
            
            'gender' => ['required', 'in:male,female,other'],
            'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'driving_license' => ['required', 'accepted'],
            'terms' => ['required', 'accepted'],
            'g-recaptcha-response' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // 🌟 Custom Error Messages Updated
            'name.not_in' => 'Reserved names like "admin", "administrator", or "root" are not allowed.',
            'name.regex' => 'Name can only contain alphabets and spaces. Numbers are not allowed.',
            'phone.regex' => 'Please enter a valid phone number (only numbers or a starting + are allowed).',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'phone.max' => 'Phone number cannot exceed 15 digits.',
            'dob.before_or_equal' => 'You are too young to register. You must be at least 18 years old.',
            'driving_license.accepted' => 'A valid driving license is required to join Drive Elite.',
            'terms.accepted' => 'You must agree to our Terms & Conditions to proceed.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'), 
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$recaptchaResponse->json('success')) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Captcha verification failed. Please try again.'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'has_driving_license' => true, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Account created successfully. Welcome to the Elite club.');
    }
}