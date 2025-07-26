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
        Schema::create('jamaah_santris', function (Blueprint $table) {
            $table->bigIncrements('id_jamaah_santri');
            $table->enum('waktu', ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'])->default('subuh');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamaah_santris');
    }
};
