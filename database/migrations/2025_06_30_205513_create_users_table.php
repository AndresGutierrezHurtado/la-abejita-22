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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('user_name');
            $table->string('user_lastname');
            $table->string('user_email');
            $table->decimal('user_phone', 10, 0);
            $table->text('user_address');
            $table->string('user_image');
            $table->text('user_password');
            $table->foreignId('role_id')->constrained('roles', 'role_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
