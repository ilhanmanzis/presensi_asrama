<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiJamaahSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'presensi_jamaah_santriwatis';
    protected $primaryKey = 'id_presensi_jamaah_santriwati';
    protected $guarded = [];

    public function jamaahSantriwati()
    {
        return $this->belongsTo(JamaahSantriwatis::class, 'id_jamaah_santriwati', 'id_jamaah_santriwati');
    }

    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }
}
