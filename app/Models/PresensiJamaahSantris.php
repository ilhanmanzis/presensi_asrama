<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiJamaahSantris extends Model
{
    use HasFactory;
    protected $table = 'presensi_jamaah_santris';
    protected $primaryKey = 'id_presensi_jamaah_santri';
    protected $guarded = [];

    public function jamaahSantri()
    {
        return $this->belongsTo(JamaahSantris::class, 'id_jamaah_santri', 'id_jamaah_santri');
    }
    public function santri()
    {
        return $this->belongsTo(Santris::class, 'id_santri', 'id_santri');
    }
}
