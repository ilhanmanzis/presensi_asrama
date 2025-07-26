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
        Schema::create('presensi_ekstrakurikulers', function (Blueprint $table) {
            $table->bigIncrements('id_presensi_ekstrakurikuler');
            $table->unsignedBigInteger('id_santri')->nullable();
            $table->unsignedBigInteger('id_santriwati')->nullable();
            $table->unsignedBigInteger('id_data_ekstrakurikuler');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha'])->default('alpha');
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_santri')->references('id_santri')->on('santris')->onDelete('cascade');
            $table->foreign('id_santriwati')->references('id_santriwati')->on('santriwatis')->onDelete('cascade');
            $table->foreign('id_data_ekstrakurikuler')->references('id_data_ekstrakurikuler')->on('data_ekstrakurikulers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_ekstrakurikulers');
    }
};
