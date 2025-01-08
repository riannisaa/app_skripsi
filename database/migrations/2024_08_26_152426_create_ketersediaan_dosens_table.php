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
        Schema::create('ketersediaan_dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_plot_jadwal');
            $table->foreignId('id_dosen');
            $table->boolean('used')->default(false);
            $table->timestamps();

            $table->foreign('id_plot_jadwal')->references('id')->on('plot_jadwals')->onDelete('cascade');
            $table->foreign('id_dosen')->references('id')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketersediaan_dosens');
    }
};
