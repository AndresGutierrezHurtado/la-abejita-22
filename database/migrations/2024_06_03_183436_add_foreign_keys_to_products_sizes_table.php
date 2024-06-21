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
        Schema::table('products_sizes', function (Blueprint $table) {
            $table->foreign(['product_id'], 'fk_product_size_product_id')->references(['product_id'])->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['size_id'], 'fk_product_size_size_id')->references(['size_id'])->on('sizes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_sizes', function (Blueprint $table) {
            $table->dropForeign('fk_product_size_product_id');
            $table->dropForeign('fk_product_size_size_id');
        });
    }
};
