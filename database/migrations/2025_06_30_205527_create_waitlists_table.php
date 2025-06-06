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
        Schema::create('waitlists', function (Blueprint $table) {
            $table->uuid('waitlist_id')->primary();
            $table->foreignUuid('user_id')->constrained('users', 'user_id');
            $table->foreignUuid('product_id')->constrained('products', 'product_id');
            $table->foreignId('size_id')->constrained('sizes', 'size_id');
            $table->boolean('waitlist_notified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitlists');
    }
};
