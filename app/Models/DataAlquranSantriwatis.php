<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlquranSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'data_alquran_santriwatis';
    protected $primaryKey = 'id_data_alquran_santriwati';
    protected $guarded = [];
    public function presensi()
    {
        return $this->hasMany(PresensiAlquranSantriwatis::class, 'id_data_alquran_santriwati', 'id_data_alquran_santriwati');
    }
    public function alquranSantriwatis()
    {
        return $this->belongsTo(AlquranSantriwatis::class, 'id_alquran_santriwati', 'id_alquran_santriwati');
    }
}
