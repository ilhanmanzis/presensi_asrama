<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiAlquranSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'presensi_alquran_santriwatis';
    protected $primaryKey = 'id_presensi_alquran_santriwati';
    protected $guarded = [];

    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }
    public function alquranSantriwati()
    {
        return $this->belongsTo(AlquranSantriwatis::class, 'id_alquran_santriwati', 'id_alquran_santriwati');
    }
    public function dataAlquranSantriwati()
    {
        return $this->belongsTo(DataAlquranSantriwatis::class, 'id_data_alquran_santriwati', 'id_data_alquran_santriwati');
    }
}
