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
        Schema::create('presensi_alquran_santriwatis', function (Blueprint $table) {
            $table->bigIncrements('id_presensi_alquran_santriwati');
            $table->unsignedBigInteger('id_santriwati');
            $table->unsignedBigInteger('id_data_alquran_santriwati');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha'])->default('alpha');
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_santriwati')->references('id_santriwati')->on('santriwatis')->onDelete('cascade');
            $table->foreign('id_data_alquran_santriwati')->references('id_data_alquran_santriwati')->on('data_alquran_santriwatis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_alquran_santriwatis');
    }
};
