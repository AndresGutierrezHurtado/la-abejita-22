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
        Schema::create('discount_uses', function (Blueprint $table) {
            $table->uuid('discount_use_id')->primary();
            $table->foreignUuid('user_id')->constrained('users', 'user_id');
            $table->foreignUuid('discount_id')->constrained('discounts', 'discount_id');
            $table->foreignUuid('order_id')->constrained('orders', 'order_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_uses');
    }
};
