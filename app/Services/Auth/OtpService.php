<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class OtpService
{
    // issue OTP to the user
    public function issueOtp(User $user): void
    {
        $otp = $this->generateOtp();
        $user->otp = Hash::make($otp);
        $user->otp_expires_at = now()->addMinutes(config('otp.expires_at'));
        $user->save();
        Log::info('OTP issued to the user', ['user' => $user->id, 'otp' => $otp]);

        // send the OTP to the user's phone number to verify the user's phone number
        $this->sendOtp($user, $otp);
    }

    // verify OTP
    public function verifyOtp(User $user, string $otp): bool
    {
        return Hash::check($otp, $user->otp);
    }

    // reset OTP
    public function resetOtp(User $user): void
    {
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();
    }

    // check if OTP is expired
    public function isOtpExpired(User $user): bool
    {
        return $user->otp_expires_at < now();
    }

    // check if OTP is valid
    public function isOtpValid(User $user): bool
    {
        return $this->verifyOtp($user, $user->otp) && ! $this->isOtpExpired($user);
    }

    // generate OTP
    private function generateOtp(): string
    {
        return rand(1000, 9999); // TODO: use the OTP length from the config
    }

    // send OTP to the user's phone number to verify the user's phone number

    private function sendOtp(User $user, string $otp): void
    {
        // TODO: SMS Provider
        // Or: $user->notify(new OtpNotification($otp));
    }
}
