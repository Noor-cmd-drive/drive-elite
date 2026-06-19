<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:male,female,other'],
            'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            
            // 🌟 100% Strict Check: User MUST tick the license box
            'has_driving_license' => ['accepted'], 
        ];
    }

    /**
     * 🌟 VIP Custom Error Messages
     * User ko professional errors show karne ke liye
     */
    public function messages(): array
    {
        return [
            'has_driving_license.accepted' => 'You must confirm that you hold a valid driving license to maintain your Elite profile.',
            'dob.before_or_equal' => 'You must be at least 18 years old to use our premium services.',
        ];
    }
}