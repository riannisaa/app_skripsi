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
        Schema::create('jadwal_sidangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penguji_1');
            $table->foreignId('id_penguji_2');
            $table->foreignId('id_pembimbing');
            $table->foreignId('id_plot_jadwal');
            $table->string('status', 15);
            $table->text('keterangan')->nullable();
            $table->boolean('done')->default(false);
            $table->timestamps();

            $table->foreign('id_penguji_1')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('id_penguji_2')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('id_pembimbing')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('id_plot_jadwal')->references('id')->on('plot_jadwals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sidangs');
    }
};
