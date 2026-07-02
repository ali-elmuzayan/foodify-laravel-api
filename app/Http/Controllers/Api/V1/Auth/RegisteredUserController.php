<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Actions\Auth\RegisterUser;

class RegisteredUserController extends Controller
{
    public function __construct(private RegisterUser $registerUserAction)
    {
    }
    public function store(RegisterRequest $request)
    {
        $user = $this->registerUserAction->handle($request->validated());

        return $this->successResponse($user, 'OTP sent successfully');
    }
}
