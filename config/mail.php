<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    */
    // 🚀 Ab hum API use kar rahe hain, SMTP nahi
    'default' => 'resend',

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    */
    'mailers' => [

        'resend' => [
            'transport' => 'resend',
        ],

        // SMTP block abhi bhi neeche mojood hai (taake code crash na ho), lekin hum use Resend karenge
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    */
    'from' => [
        // 🚀 ZAROORI: Jab tak aap custom domain (xyz.com) nahi khareedte, Resend testing ke liye yeh email use karne deta hai
        'address' => 'onboarding@resend.dev',
        'name' => 'Drive Elite System',
    ],

];