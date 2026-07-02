<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\VerifyOtpRequest;
use App\Actions\Auth\VerifyUser;

class VerifyUserController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * 
     */

    public function __construct(private VerifyUser $verifyUser)
    {
    }
    public function __invoke(VerifyOtpRequest $request)
    {

        $user = $this->verifyUser->handle($request->validated());

        // return success response
        return $this->successResponse([
            'user' => $user,
        ], 'OTP verified successfully');
    }
}
