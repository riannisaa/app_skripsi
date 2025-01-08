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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dosenpa_id');
            $table->string('nama_mahasiswa');
            $table->string('nim')->unique();
            $table->string('prodi');
            $table->string('peminatan')->nullable();
            $table->integer('status_mhs');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dosenpa_id')->references('id')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
