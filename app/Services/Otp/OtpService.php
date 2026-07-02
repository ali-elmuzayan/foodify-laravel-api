<?php

namespace App\Services\Otp;

use App\Models\User;
use App\Contracts\OtpProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OtpService
{

    public function __construct(
        private OtpProvider $otpProvider
    ) {}


    /**
     * Issue OTP to the user
     */
    public function issueOtp(User $user): void
    {
        $otp = $this->generateOtp();


        $user->forceFill([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes((int)config('otp.expires_in_minutes')),
        ])->save();


        Log::info('OTP issued to the user', ['user' => $user->id, 'otp' => $otp]);


        $this->otpProvider->send($user);
    }

    
    /**
     * Verify OTP
     */
    public function verifyOtp(User $user, string $otp): bool
    {
        if ($user->otp === null || $user->otp_expires_at === null) {
            return false;
        }
        if ($this->isOtpExpired($user)) {
            return false;
        }
        return $otp === $user->otp;
    }


    /**
     * Assert if OTP is valid
     */
    public function assertValidOtp(User $user, string $otp): void
    {
        if (! $this->verifyOtp($user, $otp)) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid or expired OTP.'],
            ]);
        }
    }

    /**
     * Reset OTP
     */
    public function resetOtp(User $user): void
    {
        $user->forceFill([
            'otp' => null,
            'otp_expires_at' => null,
        ])->save();
    }


    /**
     * Check if OTP is expired
     */
    public function isOtpExpired(User $user): bool
    {
        return $user->otp_expires_at?->isPast() ?? true;
    }



    /**
     * Generate OTP
     */
    private function generateOtp(): string
    {
        $length = (int) config('otp.length');
        return str_pad(
            (string) random_int(0, (10 ** $length) - 1),
            $length,
            '0',
            STR_PAD_LEFT
        );
    }

}
