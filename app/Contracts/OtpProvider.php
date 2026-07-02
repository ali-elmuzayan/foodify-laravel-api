<?php

namespace App\Contracts;

use App\Models\User;

interface OtpProvider
{
    public function send(User $user): void; 
}
