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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->uuid('payment_detail_id')->primary();
            $table->foreignUuid('payment_id')->constrained('payments', 'payment_id');
            $table->string('payment_method');
            $table->string('payment_detail_status');
            $table->string('payment_buyer_name');
            $table->string('payment_buyer_email');
            $table->string('payment_buyer_document');
            $table->string('payment_buyer_document_type');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
