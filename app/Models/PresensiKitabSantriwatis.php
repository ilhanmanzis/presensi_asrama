<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiKitabSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'presensi_kitab_santriwatis';
    protected $primaryKey = 'id_presensi_kitab_santriwati';
    protected $guarded = [];

    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }
    public function dataKitabSantriwati()
    {
        return $this->belongsTo(DataKitabSantriwatis::class, 'id_data_kitab_santriwati', 'id_data_kitab_santriwati');
    }
}
