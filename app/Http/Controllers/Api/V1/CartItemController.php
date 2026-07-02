<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Meal;
use App\Service\CartService;

class CartItemController extends Controller
{
    
    public function store(Meal $meal) 
    {
        $cart = Cart::getAuthenticatedUserCart()->firstOrFail();
        $cart = (new CartService())->addMealToCart($cart, $meal, 1);
        
        return $this->successResponse($cart, 'Item added to cart successfully');
    }


    public function destroy(Meal $meal) 
    {
        $cart = Cart::getAuthenticatedUserCart()->firstOrFail();
        $cart = (new CartService())->removeMealFromCart($cart, $meal);
        
        return $this->successResponse($cart, 'Item removed from cart successfully');
    }
}
