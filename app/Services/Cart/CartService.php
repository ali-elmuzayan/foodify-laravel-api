<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\User;
use App\Models\Meal;
use Illuminate\Support\Str;

class CartService
{
    public function getOrCreateCart(User $user): Cart
    {
        $cart = Cart::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'status' => 'pending',
            'quantity' => 0,
            'price' => 0,
            'total' => 0,
        ]);
        return $cart;
    }

    public function addMealToCart(Cart $cart, Meal $meal, int $quantity = 1): Cart
    {
        if ($cart->meals()->where('meal_id', $meal->id)->exists()) {
            $cart->meals()->where('meal_id', $meal->id)->increment('quantity', $quantity);
        } else {
            $cart->meals()->attach($meal->id, ['id' => (string) Str::uuid(), 'quantity' => $quantity]);
        }
        $cart->refresh();
        return $cart;
    }

    public function removeMealFromCart(Cart $cart, Meal $meal): Cart
    {
        $cart->meals()->detach($meal->id);
        $cart->refresh();
        return $cart;
    }
}
