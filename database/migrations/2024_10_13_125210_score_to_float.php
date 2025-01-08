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
        Schema::table('hasil_proposals', function (Blueprint $table) {
            $table->unsignedFloat('kesesuaian')->change();
            $table->unsignedFloat('kedalaman')->change();
            $table->unsignedFloat('rumusan')->change();
            $table->unsignedFloat('penguasaan')->change();
            $table->unsignedFloat('metode')->change();
        });

        Schema::table('hasil_skripsi_pembimbings', function (Blueprint $table) {
            $table->unsignedFloat('kedisiplinan')->change();
            $table->unsignedFloat('kemauan')->change();
            $table->unsignedFloat('kemandirian')->change();
            $table->unsignedFloat('standarisasi')->change();
            $table->unsignedFloat('keutuhan')->change();
            $table->unsignedFloat('kerapihan')->change();
            $table->unsignedFloat('analisis')->change();
            $table->unsignedFloat('solusi')->change();
            $table->unsignedFloat('kajian')->change();
            $table->unsignedFloat('penguasaan')->change();
        });

        Schema::table('hasil_skripsi_pengujis', function (Blueprint $table) {
            $table->unsignedFloat('sarana')->change();
            $table->unsignedFloat('menjelaskan')->change();
            $table->unsignedFloat('standarisasi')->change();
            $table->unsignedFloat('keutuhan')->change();
            $table->unsignedFloat('kerapihan')->change();
            $table->unsignedFloat('pemahaman')->change();
            $table->unsignedFloat('pendekatan')->change();
            $table->unsignedFloat('menjawab')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('float', function (Blueprint $table) {
            //
        });
    }
};
