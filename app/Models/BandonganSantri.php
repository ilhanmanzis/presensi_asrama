<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandonganSantri extends Model
{
    use HasFactory;
    protected $table = 'bandongan_santris';
    protected $primaryKey = 'id_bandongan_santri';
    protected $guarded = [];

    public function presensi()
    {
        return $this->hasMany(PresensiBandonganSantri::class, 'id_bandongan_santri', 'id_bandongan_santri');
    }
}
