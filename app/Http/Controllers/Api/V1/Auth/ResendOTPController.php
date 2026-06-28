<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ResendOTPRequest;
use App\Models\User;
use App\Services\Auth\OtpService;

class ResendOTPController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResendOTPRequest $request, OtpService $otpService)
    {
        // get the user
        $user = User::where('phone', $request->phone)->firstOrFail();

        // issue OTP to the user
        $otpService->issueOtp($user);
        // return success response
        return $this->successResponse($user, 'OTP sent successfully');
    }
}
