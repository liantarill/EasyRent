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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->integer('year');
            $table->string('plate_number')->unique();
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel_type', ['gasoline', 'diesel', 'electric']);
            $table->integer('capacity');
            $table->decimal('price_per_day', 12, 2);
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('vehicle_type', ['car', 'motorcycle'])->default('car');
            $table->enum('status', ['Available', 'Rented', 'Maintenance'])->default('Available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
