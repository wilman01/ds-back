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
        Schema::create('relationship_vehi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vehi_model_id');
            $table->foreign('vehi_model_id')->references('id')->on('vehi_models')->onDelete('cascade');

            $table->unsignedBigInteger('vehi_version_id');
            $table->foreign('vehi_version_id')->references('id')->on('vehi_versions')->onDelete('cascade');

            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationship_vehi');
    }
};
