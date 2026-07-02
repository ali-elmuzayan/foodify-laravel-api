<?php

namespace App\Enums;

enum PaymentMethod : string
{
    case CASH = 'cash';
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
}
