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
        Schema::table('sold_products', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_sold_product_order_id')->references(['order_id'])->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['product_id'], 'fk_sold_product_product_id')->references(['product_id'])->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sold_products', function (Blueprint $table) {
            $table->dropForeign('fk_sold_product_order_id');
            $table->dropForeign('fk_sold_product_product_id');
        });
    }
};
