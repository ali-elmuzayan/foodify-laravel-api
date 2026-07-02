<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\Otp\OtpService;
use Illuminate\Support\Facades\Hash;

class ResetPassword
{
    public function __construct(private OtpService $otpService)
    {
    }
    public function handle(array $data): void
    {
        $user = User::wherePhone($data['phone'])->firstOrFail();
    
        //TODO:  change the logic, by add column to the users table to reset the password
        $this->otpService->assertValidOtp($user, $data['otp']);
        $this->otpService->resetOtp($user);
    
    
        $user->forceFill([
            'password' => Hash::make($data['password']), // hashed via User cast
        ])->save();
    }
}
