<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiBandonganSantri extends Model
{
    use HasFactory;
    protected $table = 'presensi_bandongan_santris';
    protected $primaryKey = 'id_presensi_bandongan_santri';
    protected $guarded = [];

    public function santri()
    {
        return $this->belongsTo(Santris::class, 'id_santri', 'id_santri');
    }
    public function bandonganSantri()
    {
        return $this->belongsTo(BandonganSantri::class, 'id_bandongan_santri', 'id_bandongan_santri');
    }
}
