<?php

namespace App\Actions\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use App\Trait\ApiResponse;

class LoginUser
{
    use ApiResponse;
 
    public function handle(array $credentials): array
    {
        if (! $token = JWTAuth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['password']])) {
            throw ValidationException::withMessages([    'phone' => 'Invalid credentials'    ]);
        }
        
        $user = JWTAuth::user();

        if (! $user->isVerified()) {
            JWTAuth::setToken($token)->invalidate();
            throw ValidationException::withMessages([    'phone' => 'User not verified'    ]);
        }

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
