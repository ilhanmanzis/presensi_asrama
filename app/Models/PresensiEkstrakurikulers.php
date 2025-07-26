<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiEkstrakurikulers extends Model
{
    protected $table = 'presensi_ekstrakurikulers';
    protected $primaryKey = 'id_presensi_ekstrakurikuler';
    protected $guarded = [];

    public function santri()
    {
        return $this->belongsTo(Santris::class, 'id_santri', 'id_santri');
    }
    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }

    public function dataEkstrakurikuler()
    {
        return $this->belongsTo(DataEkstrakurikulers::class, 'id_data_ekstrakurikuler', 'id_data_ekstrakurikuler');
    }
}
