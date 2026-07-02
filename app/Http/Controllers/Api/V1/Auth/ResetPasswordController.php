<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ResetPasswordRequest;
use App\Models\User;
use App\Services\Otp\OtpService;

class ResetPasswordController extends Controller
{
    public function store(ResetPasswordRequest $request, OtpService $otpService)
{
    $validated = $request->validated();
    $user = User::wherePhone($validated['phone'])->firstOrFail();

    //TODO:  change the logic, by add column to the users table to reset the password
    $otpService->assertValidOtp($user, $validated['otp']);
    $otpService->resetOtp($user);


    $user->forceFill([
        'password' => $validated['password'], // hashed via User cast
    ])->save();
    return $this->successResponse(null, 'Password reset successfully');
}
}
