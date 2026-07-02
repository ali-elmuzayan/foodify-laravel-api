<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\VerifyOtpRequest;
use App\Models\User;
use App\Services\Auth\OtpService;

class VerifyUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyOtpRequest $request, OtpService $otpService)
    {
        $validated = $request->validated();
        $user = User::wherePhone($validated['phone'])->firstOrFail();

        // assert if OTP is valid
        $otpService->assertValidOtp($user, $validated['otp']);

        // reset OTP
        $otpService->resetOtp($user);
        $user->verifyUser();
        

        // return success response
        return $this->successResponse([
            'user' => $user,
        ], 'OTP verified successfully');
    }
}
