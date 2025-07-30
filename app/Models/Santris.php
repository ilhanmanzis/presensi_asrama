<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santris extends Model
{
    use HasFactory;
    protected $table = 'santris';
    protected $primaryKey = 'id_santri';
    protected $guarded = [];



    public function asrama()
    {
        return $this->belongsTo(Asramas::class, 'id_asrama', 'id_asrama');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }


    public function alquranSantris()
    {
        return $this->belongsToMany(AlquranSantris::class, 'kelompok_alquran_santris', 'id_santri', 'id_alquran_santri');
    }

    public function kitabSantris()
    {
        return $this->belongsToMany(KitabSantris::class, 'kelompok_kitab_santris', 'id_santri', 'id_kitab_santri');
    }

    public function scopeFilter($query, $filters)
    {

        if (isset($filters['santri']) && $filters['santri']) {
            $query->where(function ($subQ) use ($filters) {
                $subQ->where('name', 'like', '%' . $filters['santri'] . '%')
                    ->orWhere('nis', 'like', '%' . $filters['santri'] . '%');
            });
        }
    }
}
