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
        Schema::create('rule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyakit_id');
            $table->foreign('penyakit_id')->references('id')->on('penyakit');
            $table->unsignedBigInteger('gejala_id');
            $table->foreign('gejala_id')->references('id')->on('gejala');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule');
    }
};
