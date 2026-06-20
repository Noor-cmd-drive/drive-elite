<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OtpVerification; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException; 
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View { return view('auth.register'); }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_in:admin,administrator,root,Admin,Administrator,Root', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'min:10', 'max:15', 'regex:/^\+?[0-9]+$/'],
            'gender' => ['required', 'in:male,female,other'],
            'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'driving_license' => ['required', 'accepted'],
            'terms' => ['required', 'accepted'],
            'g-recaptcha-response' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'), 
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$recaptchaResponse->json('success')) {
            throw ValidationException::withMessages(['g-recaptcha-response' => 'Captcha verification failed.']);
        }

        $otp = rand(100000, 999999);
        OtpVerification::updateOrCreate(['email' => $request->email], ['otp' => $otp]);
        
        Session::put('temp_user', $request->all());

        // ==========================================
        // 🚀 THE EMERGENCY BYPASS (Added Here)
        // ==========================================
        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => 'smtp.gmail.com',
            'mail.mailers.smtp.port' => 465,
            'mail.mailers.smtp.encryption' => 'ssl',
            'mail.mailers.smtp.username' => 'driveeliterentals@gmail.com', // ⚠️ APNI GMAIL YAHAN LIKHEIN
            'mail.mailers.smtp.password' => 'faiv bpwo isqs ifke', // ⚠️ APNA APP PASSWORD YAHAN LIKHEIN
        ]);

        // OTP Email bhejo
        Mail::raw("Your DriveElite verification code is: $otp", function($message) use ($request) {
            $message->to($request->email)->subject('Verification OTP - DriveElite');
        });

        return redirect()->route('verify.otp.view');
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate(['otp' => 'required']);
        $tempData = Session::get('temp_user');

        if (!$tempData) return redirect()->route('register');

        $otpData = OtpVerification::where('email', $tempData['email'])->latest()->first();

        if ($otpData && $otpData->otp == $request->otp) {
            $user = User::create([
                'name' => $tempData['name'],
                'email' => $tempData['email'],
                'phone' => $tempData['phone'],
                'gender' => $tempData['gender'],
                'dob' => $tempData['dob'],
                'has_driving_license' => true, 
                'password' => Hash::make($tempData['password']),
            ]);

            event(new Registered($user));
            Auth::login($user);
            Session::forget('temp_user');
            return redirect(route('dashboard', absolute: false));
        }

        throw ValidationException::withMessages(['otp' => 'Invalid OTP code.']);
    }
}
//