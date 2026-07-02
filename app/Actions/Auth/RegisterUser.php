<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\Otp\OtpService;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{
    public function __construct(private OtpService $otpService)
    {
    }
    public function handle(array $data): User
    {
        // create a new user
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        // issue OTP to the user
        $this->otpService->issueOtp($user);

        // create a new cart for the user
        (new CartService())->getOrCreateCart($user);

        return $user;
    }
}
