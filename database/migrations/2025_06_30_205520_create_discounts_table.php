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
        Schema::create('discounts', function (Blueprint $table) {
            $table->uuid('discount_id')->primary();
            $table->string('discount_code');
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 10, 0);
            $table->decimal('discount_min_purchase', 10, 0)->nullable();
            $table->integer('discount_max_uses')->nullable();
            $table->integer('discount_user_limit')->nullable();
            $table->date('discount_start');
            $table->date('discount_end');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
