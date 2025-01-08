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
        Schema::create('berkas_sidang_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_dospem');
            $table->string('tahun_ajaran', 25);
            $table->string('jenis_sidang', 35);
            $table->text('buku_bimbingan');
            $table->text('khs');
            $table->text('kst');
            $table->text('video');
            $table->text('file_dokumen');
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
        Schema::dropIfExists('berkas_sidang_proposals');
    }
};
