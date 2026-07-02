<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    
    public function index() 
    {
        $cart = Cart::getAuthenticatedUserCart()->with('meals')->first();

        return $this->successResponse($cart, 'Cart fetched successfully');
    }


    public function destroy()
    {
        $cart = Cart::getAuthenticatedUserCart()->firstOrFail();
        $cart->meals()->detach();
        return $this->successResponse(null, 'Cart cleared successfully');
    }
}
