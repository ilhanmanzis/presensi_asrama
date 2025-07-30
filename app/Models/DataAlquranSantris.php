<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlquranSantris extends Model
{
    use HasFactory;
    protected $table = 'data_alquran_santris';
    protected $primaryKey = 'id_data_alquran_santri';
    protected $guarded = [];

    public function presensi()
    {
        return $this->hasMany(PresensiAlquranSantris::class, 'id_data_alquran_santri', 'id_data_alquran_santri');
    }

    public function alquranSantris()
    {
        return $this->belongsTo(AlquranSantris::class, 'id_alquran_santri', 'id_alquran_santri');
    }
    public function scopeTanggal($query, $filters)
    {

        if (isset($filters['tanggal']) && $filters['tanggal']) {
            $query->where('tanggal', $filters['tanggal']);
        }

        return $query;
    }
}
