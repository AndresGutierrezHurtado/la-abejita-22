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
            $table->integer('user_id', true);
            $table->string('user_first_name', 50);
            $table->string('user_last_name', 50);
            $table->string('user_email', 70);
            $table->string('user_username', 20);
            $table->string('user_password', 70);
            $table->string('user_address', 30)->nullable();
            $table->decimal('user_phone_number', 10, 0)->nullable();
            $table->string('user_image_url', 100)->nullable()->default('/images/users/nf.jpg');
            $table->integer('role_id')->default(1)->index('fk_user_role_id');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('role_id')->primary();
            $table->string('role_name', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('roles');
    }
};
