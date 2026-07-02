<?php

namespace Database\Seeders;

use App\Enums\OtpProvider ;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::created([
            'otp_sms_body' => 'Your OTP is {otp}',
            'otp_provider' => OtpProvider::TWILIO->value,
            'otp_length' => 4,
            'otp_expires_in_minutes' => 3,
            'otp_from_number' => '+201010232458',
        ]);
    }
}
