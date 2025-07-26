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
        Schema::create('data_kitab_santriwatis', function (Blueprint $table) {
            $table->bigIncrements('id_data_kitab_santriwati');
            $table->unsignedBigInteger('id_kitab_santriwati');
            $table->string('kegiatan')->nullable();
            $table->date('tanggal');

            $table->timestamps();
            $table->foreign('id_kitab_santriwati')->references('id_kitab_santriwati')->on('kitab_santriwatis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kitab_santriwatis');
    }
};
