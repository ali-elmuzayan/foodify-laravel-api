<?php

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
        Schema::create('cart_meals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity')->default(1);
            $table->timestamps();

            // Relationships
            $table->foreignUuid('cart_id')->constrained('carts')->onDelete('cascade');
            $table->foreignUuid('meal_id')->constrained('meals')->onDelete('cascade');

            // Indexes
            $table->unique(['cart_id', 'meal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_meals');
    }
};
