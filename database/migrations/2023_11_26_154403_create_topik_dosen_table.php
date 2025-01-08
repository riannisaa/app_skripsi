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
        Schema::create('topik_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topik_id');
            $table->unsignedBigInteger('dosen_id');

            $table->foreign('topik_id')->references('id')->on('data_topik')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('cascade');

            $table->unique(['topik_id', 'dosen_id']);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topik_dosen');
    }
};
