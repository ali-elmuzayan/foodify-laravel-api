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
        Schema::create('meals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('carb', 10, 2)->nullable()->default(0);
            $table->decimal('protein', 10, 2)->nullable()->default(0);
            $table->decimal('fat', 10, 2)->nullable()->default(0);
            $table->decimal('calories', 10, 2)->nullable()->default(0);
            $table->string('ingredients')->nullable();
            $table->decimal('kcal', 10, 2)->nullable()->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();

            // Relationships
            $table->foreignUuid('category_id')->constrained('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
