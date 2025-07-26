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
        Schema::create('data_alquran_santris', function (Blueprint $table) {
            $table->bigIncrements('id_data_alquran_santri');
            $table->unsignedBigInteger('id_alquran_santri');
            $table->string('kegiatan')->nullable();
            $table->date('tanggal');

            $table->timestamps();
            $table->foreign('id_alquran_santri')->references('id_alquran_santri')->on('alquran_santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alquran_santris');
    }
};
