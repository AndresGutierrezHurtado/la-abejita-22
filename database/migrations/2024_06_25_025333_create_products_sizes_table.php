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
        Schema::create('products_sizes', function (Blueprint $table) {
            $table->integer('product_size_id', true);
            $table->integer('product_id')->index('fk_product_size_product_id');
            $table->integer('product_size_stock');
            $table->decimal('product_size_price', 10, 0);
            $table->integer('size_id')->index('fk_product_size_size_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_sizes');
    }
};
