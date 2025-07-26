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
        Schema::create('santris', function (Blueprint $table) {
            $table->bigIncrements('id_santri');
            $table->string('nis');
            $table->string('name');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_asrama');
            $table->unsignedBigInteger('id_kitab_santri')->nullable();
            $table->unsignedBigInteger('id_alquran_santri')->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_asrama')->references('id_asrama')->on('asramas')->onDelete('cascade');
            $table->foreign('id_kitab_santri')->references('id_kitab_santri')->on('kitab_santris')->onDelete('cascade');
            $table->foreign('id_alquran_santri')->references('id_alquran_santri')->on('alquran_santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
