<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CheckHealthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        // check if the server is healthy
        $isHealthy = true;
        if (!$isHealthy) {
            return $this->errorResponse('Server is not healthy', 'Server is not healthy', 500);
        }
        
        return $this->successResponse([
            'message' => 'Server is healthy',
            'status' => 'ok',
            'version' => '1.0.0',
            'timestamp' => now(),
        ], 'Server is healthy');
    }
}
