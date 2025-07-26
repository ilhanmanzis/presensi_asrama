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
        Schema::create('kelompok_alquran_santris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_alquran_santri');
            $table->timestamps();
            $table->foreign('id_santri')
                ->references('id_santri')
                ->on('santris')
                ->onDelete('cascade');
            $table->foreign('id_alquran_santri')
                ->references('id_alquran_santri')
                ->on('alquran_santris')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_alquran_santris');
    }
};
