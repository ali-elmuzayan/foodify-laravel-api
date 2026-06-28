<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatedUserController extends Controller
{
    /**
     * Login a user
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        try {
            if (! $token = JWTAuth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['password']])) {
                return $this->errorResponse('Invalid credentials', 'Invalid credentials', 401);
            }
            $user = JWTAuth::user();

            if (! $user->isVerified()) {
                JWTAuth::setToken($token)->invalidate();

                return $this->errorResponse('User not verified', 'Please verify your account to continue', 401);
            }

            return $this->successResponse(['token' => $token, 'user' => $user], 'User authenticated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Error authenticating user', $e->getMessage(), 500);
        }
    }

    /**
     * Show Authenticated User
     */
    public function show(Request $request)
    {
        
        return $this->successResponse($request->user(), 'Retrieved authenticated user successfully');
    }

    /**
     * Logout a user
     */
    public function destroy(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->successResponse(null, 'User logged out successfully');
    }
}
