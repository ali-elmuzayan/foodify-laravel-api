<?php

use App\Enums\OtpProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('otp_sms_body')->nullable();
            $table->enum('otp_provider', OtpProvider::cases())->nullable();
            $table->enum('otp_length', [4, 6, 8])->default(4);
            $table->enum('otp_expires_in_minutes', [1, 3, 5, 10, 15, 30])->default(3);
            $table->string('otp_from_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
