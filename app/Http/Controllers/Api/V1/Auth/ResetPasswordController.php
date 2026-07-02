<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ResetPasswordRequest;
use App\Actions\Auth\ResetPassword;

class ResetPasswordController extends Controller
{
    public function __construct(private ResetPassword $resetPasswordAction)
    {
    }
    public function store(ResetPasswordRequest $request)
    {
        $this->resetPasswordAction->handle($request->validated());
        return $this->successResponse(null, 'Password reset successfully');
    }
}
