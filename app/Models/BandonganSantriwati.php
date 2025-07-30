<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandonganSantriwati extends Model
{
    use HasFactory;

    protected $table = 'bandongan_santriwatis';
    protected $primaryKey = 'id_bandongan_santriwati';
    protected $guarded = [];
    public function presensi()
    {
        return $this->hasMany(PresensiBandonganSantriwati::class, 'id_bandongan_santriwati', 'id_bandongan_santriwati');
    }
    public function scopeTanggal($query, $filters)
    {

        if (isset($filters['tanggal']) && $filters['tanggal']) {
            $query->where('tanggal', $filters['tanggal']);
        }

        return $query;
    }
}
