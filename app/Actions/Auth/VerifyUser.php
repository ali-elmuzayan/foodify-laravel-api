<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\Otp\OtpService;
class VerifyUser
{
    public function __construct(private OtpService $otpService)
    {
    }
    public function handle(array $data): User
    {
        $user = User::where('phone', $data['phone'])->firstOrFail();

        // assert if OTP is valid
        $this->otpService->assertValidOtp($user, $data['otp']);

        // reset OTP
        $this->otpService->resetOtp($user);
        $user->verifyUser();

        return $user;
    }
}
