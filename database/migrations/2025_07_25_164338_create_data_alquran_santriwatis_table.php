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
        Schema::create('data_alquran_santriwatis', function (Blueprint $table) {
            $table->bigIncrements('id_data_alquran_santriwati');
            $table->unsignedBigInteger('id_alquran_santriwati');
            $table->string('kegiatan')->nullable();
            $table->date('tanggal');

            $table->timestamps();
            $table->foreign('id_alquran_santriwati')->references('id_alquran_santriwati')->on('alquran_santriwatis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alquran_santriwatis');
    }
};
