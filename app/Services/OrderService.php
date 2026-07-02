<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderShipped;

class OrderService
{
    public function shipOrder(Order $order) 
    {
        // 1) Load authenticated user's cart with items 
        // 2) failed if the cart is empty 
        // 3) Create the Order + order Items rows from cart items 
        // 4) Run the payment service to process the payment 
        // 5) Clear the cart on success 
        // 6) Fire teh payment completed successfully event 
        $order->status =  'shipped'; 
        $order->shipped_at = now(); 


        // notification  type
        if(config('app.notification_type') === 'email') {
            $this->sendEmailNotification($order, $order->user);
        } else if(config('app.notification_type') === 'sms') {
            // implement later ;
        }

        $order->save();
    }

    private function sendEmailNotification(Order $order, User $user)
    {
        $user = $order->user;
      //  $user->notify(new OrderShipped($order, $user));
    }
}
