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
            $table->string('payer_full_name', 70);
            $table->string('payer_email', 70);
            $table->decimal('payer_phone_number', 10, 0);
            $table->enum('payer_document_type', ['CC', 'CE', 'TI']);
            $table->decimal('payer_document_number', 10, 0);
            $table->integer('payment_method');
            $table->integer('payment_status');
            $table->date('payment_date');
            $table->time('payment_time');
            $table->decimal('payment_amount', 10)->nullable();
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
