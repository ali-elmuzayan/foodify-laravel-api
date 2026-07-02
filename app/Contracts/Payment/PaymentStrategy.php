<?php

namespace App\Contracts\Payment;

use App\Models\Order;
use App\Models\Payment;
interface PaymentStrategy
{
    public function pay(Order $order): void; 

    public function refund(Payment $payment): void; 
}
