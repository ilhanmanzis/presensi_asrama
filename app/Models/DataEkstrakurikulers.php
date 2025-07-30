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
    public function scopeTanggal($query, $filters)
    {

        if (isset($filters['tanggal']) && $filters['tanggal']) {
            $query->where('tanggal', $filters['tanggal']);
        }

        if (isset($filters['ekstrakurikuler']) && $filters['ekstrakurikuler']) {
            $query->where('id_ekstrakurikuler', $filters['ekstrakurikuler']);
        }

        return $query;
    }
}
