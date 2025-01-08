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
        Schema::create('hasil_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen');
            $table->foreignId('id_jadwal_proposal');
            $table->unsignedInteger('kesesuaian');
            $table->unsignedInteger('kedalaman');
            $table->unsignedInteger('rumusan');
            $table->unsignedInteger('penguasaan');
            $table->unsignedInteger('metode');
            $table->text('saran')->nullable();
            $table->timestamps();

            $table->foreign('id_dosen')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('id_jadwal_proposal')->references('id')->on('jadwal_proposals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_proposals');
    }
};
