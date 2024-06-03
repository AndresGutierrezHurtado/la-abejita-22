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
        Schema::create('school_products', function (Blueprint $table) {
            $table->integer('product_school_id', true);
            $table->integer('product_id')->index('school_product_product_id');
            $table->integer('school_id')->index('school_product_school_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_products');
    }
};
