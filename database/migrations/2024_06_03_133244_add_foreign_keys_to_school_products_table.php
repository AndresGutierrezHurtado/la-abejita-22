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
        Schema::table('school_products', function (Blueprint $table) {
            $table->foreign(['product_id'], 'school_product_product_id')->references(['product_id'])->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['school_id'], 'school_product_school_id')->references(['school_id'])->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_products', function (Blueprint $table) {
            $table->dropForeign('school_product_product_id');
            $table->dropForeign('school_product_school_id');
        });
    }
};
