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
        Schema::create('vehi_models', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('brand_id');
            $table->string('model')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehi_models');
    }
};
