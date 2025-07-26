<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKitabSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'data_kitab_santriwatis';
    protected $primaryKey = 'id_data_kitab_santriwati';
    protected $guarded = [];

    public function presensi()
    {
        return $this->hasMany(PresensiKitabSantriwatis::class, 'id_data_kitab_santriwati', 'id_data_kitab_santriwati');
    }
    public function kitabSantriwatis()
    {
        return $this->belongsTo(KitabSantriwatis::class, 'id_kitab_santriwati', 'id_kitab_santriwati');
    }
}
