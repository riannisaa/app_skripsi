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
        Schema::create('pengajuan_topik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('topik_id'); 
            $table->string('judul');   
            $table->text('desc_judul');   
            $table->string('status'); 
            $table->text('desc_status')->nullable();   
            $table->timestamps();

            $table->foreign('topik_id')->references('id')->on('data_topik');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_topik');
    }
};
