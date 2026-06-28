<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->successResponse([
            'token' => JWTAuth::refresh(JWTAuth::getToken()),
        ], 'Token refreshed successfully');
    }
}
