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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->uuid('product_size_id')->primary();
            $table->foreignUuid('product_id')->constrained('products', 'product_id');
            $table->foreignId('size_id')->constrained('sizes', 'size_id');
            $table->integer('size_stock');
            $table->decimal('size_price', 10, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
