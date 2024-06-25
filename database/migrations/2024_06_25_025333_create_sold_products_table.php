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
        Schema::create('sold_products', function (Blueprint $table) {
            $table->integer('order_id')->index('fk_sold_product_order_id');
            $table->integer('product_id')->index('fk_sold_product_product_id');
            $table->integer('size_id')->index('fk_sold_product_size_id');
            $table->integer('product_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sold_products');
    }
};
