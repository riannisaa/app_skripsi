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
        Schema::create('jadwal_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_berkas_proposal');
            $table->foreignId('id_jadwal');
            $table->timestamps();

            $table->foreign('id_berkas_proposal')->references('id')->on('berkas_sidang_proposals')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_sidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_proposals');
    }
};
