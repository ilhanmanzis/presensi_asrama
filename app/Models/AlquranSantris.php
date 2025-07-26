<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlquranSantris extends Model
{
    use HasFactory;
    protected $table = 'alquran_santris';
    protected $primaryKey = 'id_alquran_santri';
    protected $guarded = [];


    public function santris()
    {
        return $this->belongsToMany(Santris::class, 'kelompok_alquran_santris', 'id_alquran_santri', 'id_santri');
    }
    public function dataAlquranSantris()
    {
        return $this->hasMany(DataAlquranSantris::class, 'id_alquran_santri', 'id_alquran_santri');
    }
}
