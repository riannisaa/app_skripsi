<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekomendasi_akademik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosenpa_id');
            $table->date('tanggal_pengajuan')->default(DB::raw('CURRENT_DATE'));
            $table->integer('sks')->default(0);
            $table->string('khs_file')->nullable();
            $table->string('pkm_file')->nullable();
            $table->string('ukt_file')->nullable();
            $table->string('toefl_file')->nullable();
            $table->string('seminar_file')->nullable();
            $table->string('profesi_file')->nullable();
            $table->string('status');
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->foreign('dosenpa_id')->references('id')->on('dosen');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_akademik');
    }
};
