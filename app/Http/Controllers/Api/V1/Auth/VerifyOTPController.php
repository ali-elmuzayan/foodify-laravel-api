<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\VerifyOtpRequest;
use App\Models\User;
use App\Services\Auth\OtpService;

class VerifyOTPController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyOtpRequest $request, OtpService $otpService)
    {
        // get the user
        $user = User::where('phone', $request->phone)->firstOrFail();

        // verify the OTP
        $otpService->resetOtp($user);
        $user->validateUser();
        

        // return success response
        return $this->successResponse([
            'user' => $user,
        ], 'OTP verified successfully');
    }
}
