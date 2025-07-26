<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataEkstrakurikulers extends Model
{
    protected $table = 'data_ekstrakurikulers';

    protected $primaryKey = 'id_data_ekstrakurikuler';

    protected $guarded = [];

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikulers::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }

    public function presensi()
    {
        return $this->hasMany(PresensiEkstrakurikulers::class, 'id_data_ekstrakurikuler', 'id_data_ekstrakurikuler');
    }
}
