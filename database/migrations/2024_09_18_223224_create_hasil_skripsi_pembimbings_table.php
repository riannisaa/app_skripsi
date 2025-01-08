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
        Schema::create('hasil_skripsi_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen');
            $table->foreignId('id_jadwal_skripsi');
            $table->unsignedInteger('kedisiplinan');
            $table->unsignedInteger('kemauan');
            $table->unsignedInteger('kemandirian');
            $table->unsignedInteger('standarisasi');
            $table->unsignedInteger('keutuhan');
            $table->unsignedInteger('kerapihan');
            $table->unsignedInteger('analisis');
            $table->unsignedInteger('solusi');
            $table->unsignedInteger('kajian');
            $table->unsignedInteger('penguasaan');
            $table->text('pertanyaan_pokok')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->timestamps();

            $table->foreign('id_dosen')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('id_jadwal_skripsi')->references('id')->on('jadwal_skripsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_skripsi_pembimbings');
    }
};
