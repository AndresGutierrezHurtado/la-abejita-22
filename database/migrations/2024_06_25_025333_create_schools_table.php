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
        Schema::create('schools', function (Blueprint $table) {
            $table->integer('school_id', true);
            $table->string('school_name', 100);
            $table->string('school_address', 200);
            $table->string('school_image_url', 100)->default('/images/schools/nf.jpg');
            $table->string('school_use_guide_url', 100)->default('/pdf/ejemplo.pdf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
