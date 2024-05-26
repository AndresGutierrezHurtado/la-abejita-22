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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('product_id', true);
            $table->string('product_name', 100);
            $table->string('product_description', 100);
            $table->integer('product_stock');
            $table->string('product_image_url', 100)->nullable()->default('/images/products/nf.jpg');
            $table->integer('school_id')->index('fk_product_school_id');
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->integer('size_id', true);
            $table->string('size_name', 50);
        });

        Schema::create('products_sizes', function (Blueprint $table) {
            $table->integer('product_size_id', true);
            $table->integer('product_id')->index('fk_product_size_product_id');
            $table->integer('size_id')->index('fk_product_size_size_id');
            $table->decimal('price', 10);
        });
                
        Schema::create('schools', function (Blueprint $table) {
            $table->integer('school_id')->primary();
            $table->string('school_name', 100);
            $table->string('schoold_address', 200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('products_sizes');
        Schema::dropIfExists('schools');
    }
};
