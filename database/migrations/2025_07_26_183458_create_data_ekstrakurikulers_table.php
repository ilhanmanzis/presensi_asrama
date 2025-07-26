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
        Schema::create('data_ekstrakurikulers', function (Blueprint $table) {
            $table->bigIncrements('id_data_ekstrakurikuler');
            $table->unsignedBigInteger('id_ekstrakurikuler');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_ekstrakurikuler')->references('id_ekstrakurikuler')->on('ekstrakurikulers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ekstrakurikulers');
    }
};
