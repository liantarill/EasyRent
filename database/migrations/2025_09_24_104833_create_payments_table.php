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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->constrained('rents')->cascadeOnDelete();
            $table->string('order_id')->unique();
            $table->string('snap_token')->nullable();
            $table->string('method')->default('midtrans');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['Pending', 'Pending Payment', 'Paid', 'Failed', 'Expired'])->default('Pending');
            $table->timestamps();

            // Add index for faster queries
            $table->index('rent_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
