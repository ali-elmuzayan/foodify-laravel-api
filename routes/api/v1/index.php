<?php

use App\Http\Controllers\Api\V1\CheckHealthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\MealController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CartItemController;


// products routes
// categories routes
Route::apiResource('categories', CategoryController::class); 
// meals routes
Route::apiResource('meals', MealController::class); 

// carts routes, should be authenticated and verified
//---------------------------------------------------
Route::middleware(['auth:api'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart', [CartController::class, 'destroy']);
    Route::post('/cart/meals/{meal}', [CartItemController::class, 'store']);
    Route::put('/items/{item}', [CartItemController::class, 'update']);
    Route::delete('/cart/meals/{meal}', [CartItemController::class, 'destroy']);
});

// orders routes



// Helath route 
Route::get('/health', CheckHealthController::class); 
// auth routes
require_once __DIR__.'/auth.php';
