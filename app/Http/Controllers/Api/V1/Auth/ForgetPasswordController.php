<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ForgetPasswordRequest;
use App\Models\User;
use App\Services\Otp\OtpService;

class ForgetPasswordController extends Controller
{
    public function store(ForgetPasswordRequest $request, OtpService $otpService) {
        $validated = $request->validated(); 

        $user = User::where('phone', $validated['phone'])->firstOrFail();
        // send the OTP to the user's phone number to verify the user's phone number 
        $otpService->issueOtp($user);

        return $this->successResponse($user, 'OTP sent successfully');
    }
}
