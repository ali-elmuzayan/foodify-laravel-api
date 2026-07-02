<?php

return [
    /**
     * OTP Length
     */
    'length' => env('OTP_LENGTH', 4),

    /**
     * OTP Expires In Minutes
     */
    'expires_in_minutes' => env('OTP_EXPIRES_IN_MINUTES', 3),

    /**
     * OTP Provider
     */
    'provider' => env('OTP_PROVIDER', 'twilio'), // twilio | vonage

    /**
     * Twilio Configuration
     */
    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'from' => env('TWILIO_FROM'),
    ],

    /**
     * Vonage Configuration
     */
    'vonage' => [
        'key' => env('VONAGE_API_KEY'),
        'secret' => env('VONAGE_API_SECRET'),
        'from' => env('VONAGE_FROM'),
    ],
];