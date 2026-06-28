<?php

use App\Http\Controllers\Api\V1\CheckHealthController;
use Illuminate\Support\Facades\Route;
// products routes
// categories routes
// orders routes
// carts routes



// Helath route 
Route::get('/health', CheckHealthController::class); 
// auth routes
require_once __DIR__.'/auth.php';
