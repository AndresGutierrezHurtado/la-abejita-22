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
        Schema::create('payments_details', function (Blueprint $table) {
            $table->integer('payment_id', true);
            $table->integer('order_id')->index('fk_payment_detail_order_id');
            $table->integer('payment_state');
            $table->integer('payment_method');
            $table->decimal('payment_amount', 10);
            $table->string('payment_buyer_email', 70);
            $table->string('payment_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments_details');
    }
};
