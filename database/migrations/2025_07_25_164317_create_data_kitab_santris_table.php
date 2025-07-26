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
        Schema::create('data_kitab_santris', function (Blueprint $table) {
            $table->bigIncrements('id_data_kitab_santri');
            $table->unsignedBigInteger('id_kitab_santri');
            $table->string('kegiatan')->nullable();
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('id_kitab_santri')->references('id_kitab_santri')->on('kitab_santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kitab_santris');
    }
};
