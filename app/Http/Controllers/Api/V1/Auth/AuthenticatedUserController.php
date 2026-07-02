<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Actions\Auth\LoginUser;

class AuthenticatedUserController extends Controller
{

    public function __construct(private LoginUser $loginUserAction)
    {
    }
    /**
     * Login a user
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        try {
            $data = $this->loginUserAction->handle($credentials);
            return $this->successResponse($data, 'User authenticated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Error authenticating user', $e->getMessage(), 500);
        }
    }

    /**
     * Show Authenticated User
     */
    public function show()
    {
        $user = JWTAuth::user();
        return $this->successResponse($user, 'Retrieved authenticated user successfully');
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
