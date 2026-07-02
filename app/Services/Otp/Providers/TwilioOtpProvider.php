<?php

namespace App\Services\Otp\Providers;

use App\Contracts\OtpProvider;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioOtpProvider implements OtpProvider  
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

        // WE NEED TO DECRYPT THE OTP
        $otp = $user->otp;

        try {
            $this->client->messages->create($user->phone, [
                'from' => $this->from,
                'body' => "Your Foodify verfication code is: {$otp}"
            ]);
        } catch (\Exception $e) {
            Log::error("Failed to send OTP: {$e->getMessage()}");
            throw new \Exception("Failed to send OTP: please connect us");
            }
        }
    }
