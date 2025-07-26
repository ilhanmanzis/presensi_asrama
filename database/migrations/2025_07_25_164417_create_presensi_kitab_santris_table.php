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
        Schema::create('presensi_kitab_santris', function (Blueprint $table) {
            $table->bigIncrements('id_presensi_kitab_santri');
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_data_kitab_santri');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha'])->default('alpha');
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_santri')->references('id_santri')->on('santris')->onDelete('cascade');
            $table->foreign('id_data_kitab_santri')->references('id_data_kitab_santri')->on('data_kitab_santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_kitab_santris');
    }
};
