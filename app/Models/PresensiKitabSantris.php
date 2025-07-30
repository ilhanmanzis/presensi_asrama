<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiKitabSantris extends Model
{
    use HasFactory;
    protected $table = 'presensi_kitab_santris';
    protected $primaryKey = 'id_presensi_kitab_santri';
    protected $guarded = [];

    public function santri()
    {
        return $this->belongsTo(Santris::class, 'id_santri', 'id_santri');
    }
    public function dataKitabSantri()
    {
        return $this->belongsTo(DataKitabSantris::class, 'id_data_kitab_santri', 'id_data_kitab_santri');
    }
}
