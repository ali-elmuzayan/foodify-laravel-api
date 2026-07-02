<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Otp\OtpService;
use App\Services\Cart\CartService;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request, OtpService $otpService)
    {
        // validate the request
        $validated = $request->validated();

        // create a new user
        $user = User::create($validated);

        // issue OTP to the user
        $otpService->issueOtp($user);

        // create a new cart for the user
        (new CartService())->getOrCreateCart($user);

        // return success response
        return $this->successResponse($user, 'OTP sent successfully');
    }
}
