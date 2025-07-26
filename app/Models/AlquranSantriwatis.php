<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class AlquranSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'alquran_santriwatis';
    protected $primaryKey = 'id_alquran_santriwati';
    protected $guarded = [];

    public function santriwatis()
    {
        return $this->belongsToMany(Santriwatis::class, 'kelompok_alquran_santriwatis', 'id_alquran_santriwati', 'id_santriwati');
    }

    public function dataAlquranSantriwatis()
    {
        return $this->hasMany(DataAlquranSantriwatis::class, 'id_alquran_santriwati', 'id_alquran_santriwati');
    }
}
