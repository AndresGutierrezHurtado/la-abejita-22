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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('order_item_id')->primary();
            $table->foreignUuid('order_id')->constrained('orders', 'order_id');
            $table->foreignUuid('product_id')->constrained('products', 'product_id');
            $table->foreignId('size_id')->constrained('sizes', 'size_id');
            $table->integer('item_quantity');
            $table->decimal('item_price', 10, 0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
