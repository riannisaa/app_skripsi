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
        Schema::table('jadwal_skripsis', function (Blueprint $table) {
            $table->boolean('acc_pembimbing_1')->nullable();
            $table->boolean('acc_pembimbing_2')->nullable();
            $table->boolean('acc_penguji_1')->nullable();
            $table->boolean('acc_penguji_2')->nullable();
            $table->boolean('acc_kaprodi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
