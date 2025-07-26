<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiAlquranSantris extends Model
{
    use HasFactory;
    protected $table = 'presensi_alquran_santris';
    protected $primaryKey = 'id_presensi_alquran_santri';
    protected $guarded = [];

    public function santri()
    {
        return $this->belongsTo(Santris::class, 'id_santri', 'id_santri');
    }
    public function alquranSantri()
    {
        return $this->belongsTo(AlquranSantris::class, 'id_alquran_santri', 'id_alquran_santri');
    }
}
