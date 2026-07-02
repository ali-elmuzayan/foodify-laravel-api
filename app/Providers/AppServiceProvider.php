<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\OtpProvider;
use App\Enums\OtpProvider as OtpProviderEnum;
use App\Services\Otp\Providers\TwilioOtpProvider;
use App\Services\Otp\Providers\VonageOtpProvider;
use Twilio\Rest\Client as TwilioClient;
use Vonage\Client as VonageClient;
use Vonage\Client\Credentials\Basic as VonageCredentials;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OtpProvider::class, function ($app) {
            return match (config('otp.provider')) {
                OtpProviderEnum::VONAGE->value => new VonageOtpProvider(
                    new VonageClient(new VonageCredentials(
                        config('otp.vonage.key'),
                        config('otp.vonage.secret'),
                    )),
                    config('otp.vonage.from'),
                ),
                default => new TwilioOtpProvider(
                    new TwilioClient(
                        config('otp.twilio.sid'),
                        config('otp.twilio.token'),
                    ),
                    config('otp.twilio.from'),
                ),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
