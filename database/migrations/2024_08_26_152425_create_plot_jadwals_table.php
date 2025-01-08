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
        Schema::create('plot_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ruangan');
            $table->string('waktu', 20);
            $table->date('tanggal');
            $table->string('prodi', 35);
            $table->string('jenis_sidang', 20);
            $table->timestamps();
            
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_jadwals');
    }
};
