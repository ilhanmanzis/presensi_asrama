<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santriwatis extends Model
{
    use HasFactory;
    protected $table = 'santriwatis';
    protected $primaryKey = 'id_santriwati';
    protected $guarded = [];


    public function asrama()
    {
        return $this->belongsTo(Asramas::class, 'id_asrama', 'id_asrama');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function alquranSantriwatis()
    {
        return $this->belongsToMany(AlquranSantriwatis::class, 'kelompok_alquran_santriwatis', 'id_santriwati', 'id_alquran_santriwati');
    }

    public function kitabSantriwatis()
    {
        return $this->belongsToMany(KitabSantriwatis::class, 'kelompok_kitab_santriwatis', 'id_santriwati', 'id_kitab_santriwati');
    }
}
