<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiBandonganSantriwati extends Model
{
    use HasFactory;
    protected $table = 'presensi_bandongan_santriwatis';
    protected $primaryKey = 'id_presensi_bandongan_santriwati';
    protected $guarded = [];

    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }

    public function bandonganSantriwati()
    {
        return $this->belongsTo(BandonganSantriwati::class, 'id_bandongan_santriwati', 'id_bandongan_santriwati');
    }
}
