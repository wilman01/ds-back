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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->unsignedBigInteger('provider_id');
            $table->string('name');
            $table->double('amount');
            $table->double('coverage');
            $table->string('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
