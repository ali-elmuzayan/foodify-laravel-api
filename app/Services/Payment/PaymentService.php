<?php

namespace App\Services\Payment;

use App\Enums\PaymentMethod;
use App\Services\Payment\Strategies\CashPaymentStrategy;
use App\Services\Payment\Strategies\PaypalPaymentStrategy;
use App\Services\Payment\Strategies\StribePaymentStrategy;

class PaymentService
{
    public static function process(string $method) 
    {
        return match($method) {
            PaymentMethod::CASH => new CashPaymentStrategy(),
            PaymentMethod::PAYPAL => new PaypalPaymentStrategy(),
            PaymentMethod::STRIPE => new StribePaymentStrategy(),
        };
    }
}
