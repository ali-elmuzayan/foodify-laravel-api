<?php

namespace App\Enums;

enum OtpProvider: string
{
    case TWILIO = 'twilio';
    case VONAGE = 'vonage';
}
