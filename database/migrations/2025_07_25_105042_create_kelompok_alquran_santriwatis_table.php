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
        Schema::create('kelompok_alquran_santriwatis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_santriwati');
            $table->unsignedBigInteger('id_alquran_santriwati');
            $table->timestamps();

            $table->foreign('id_santriwati')
                ->references('id_santriwati')
                ->on('santriwatis')
                ->onDelete('cascade');
            $table->foreign('id_alquran_santriwati')
                ->references('id_alquran_santriwati')
                ->on('alquran_santriwatis')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_alquran_santriwatis');
    }
};
