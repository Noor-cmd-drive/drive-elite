<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    // Terminal mein jo command hum chalayenge
    protected $signature = 'make:admin {email}';
    
    // Command ki description
    protected $description = 'Create a new admin user for the Car Rental System';

    public function handle()
    {
        $email = $this->argument('email');
        
        // Agar email pehle se database mein hai toh error do
        if (User::where('email', $email)->exists()) {
            $this->error('Yeh email pehle se system mein majood hai!');
            return;
        }

        // Terminal mein naam aur password mangne ke liye
        $password = $this->secret('Admin ka password enter karein (type karte waqt nazar nahi aayega)');
        $name = $this->ask('Admin ka naam enter karein');

        // Admin account database mein save karna
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin', // Yeh hissa user ko "Admin" banata hai
        ]);

        $this->info("Zabardast! Admin account '{$email}' successfully ban gaya hai.");
    }
}