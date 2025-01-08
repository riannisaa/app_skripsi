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
        Schema::create('data_topik', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan');
            $table->string('peminatan');
            $table->string('topik');
            $table->text('ket');
            $table->integer('kapasitas')->default(5);
            $table->integer('peserta')->default(0);
            $table->timestamps();
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topik');
    }
};
