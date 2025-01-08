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
        Schema::create('jadwal_skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_berkas_skripsi');
            $table->foreignId('id_jadwal');
            $table->text('file_revisi', 25)->nullable();
            $table->string('keterangan', 25)->nullable();
            $table->string('status_revisi', 25)->nullable();
            $table->timestamps();

            $table->foreign('id_berkas_skripsi')->references('id')->on('berkas_sidang_skripsis')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_sidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_skripsis');
    }
};
