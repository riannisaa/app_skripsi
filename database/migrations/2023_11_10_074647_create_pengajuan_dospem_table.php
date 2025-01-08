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
        Schema::create('pengajuan_dospem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('topik'); 
            $table->string('judul');   
            $table->unsignedBigInteger('dp1_id');   
            $table->unsignedBigInteger('dp2_id')->nullable();   
            $table->string('status'); 
            $table->string('semester');
            $table->string('periode'); 
            $table->text('desc_status')->nullable();   
            $table->timestamps();

            $table->foreign('dp1_id')->references('id')->on('dosen');
            $table->foreign('dp2_id')->references('id')->on('dosen');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_dospem');
    }
};
