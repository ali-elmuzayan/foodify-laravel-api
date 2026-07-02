<?php

namespace App\Services\Otp\Providers;

use App\Contracts\OtpProvider;
use App\Models\User;
use Vonage\Client;
use Vonage\SMS\Message\SMS;
use Illuminate\Support\Facades\Log;


class VonageOtpProvider implements OtpProvider
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Client $client, 
        private string $from 
    ) {}

    public function send(User $user): void 
    {
        try {

        
        $this->client->sms()->send(
            new SMS($user->phone, $this->from, "Your Foodify verfication code is: {$user->otp}")
        );
        } catch (\Exception $e) {
            Log::error("Failed to send OTP: {$e->getMessage()}");
            throw new \Exception("Failed to send OTP: please connect us");
        }
    }
}
