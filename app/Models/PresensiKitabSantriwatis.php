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
    public function kitabSantriwati()
    {
        return $this->belongsTo(KitabSantriwatis::class, 'id_kitab_santriwati', 'id_kitab_santriwati');
    }
}
