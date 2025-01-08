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
        Schema::create('berkas_sidang_skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_dospem');
            $table->string('tahun_ajaran', 25);
            $table->text('ktp_kk_akta');
            $table->text('pas_foto');
            $table->text('ijazah');
            $table->text('buku_bimbingan');
            $table->text('turnitin');
            $table->text('khs');
            $table->text('kst');
            $table->text('ukt');
            $table->text('file_dokumen');
            $table->text('video');
            $table->text('bebas_pustaka')->nullable();
            $table->text('bebas_pinjam')->nullable();
            $table->string('status', 10);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_pengajuan_dospem')->references('id')->on('pengajuan_dospem')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_sidang_skripsis');
    }
};
