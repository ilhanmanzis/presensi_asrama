<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKitabSantris extends Model
{
    use HasFactory;
    protected $table = 'data_kitab_santris';
    protected $primaryKey = 'id_data_kitab_santri';
    protected $guarded = [];

    public function presensi()
    {
        return $this->hasMany(PresensiKitabSantris::class, 'id_data_kitab_santri', 'id_data_kitab_santri');
    }
    public function kitabSantris()
    {
        return $this->belongsTo(KitabSantris::class, 'id_kitab_santri', 'id_kitab_santri');
    }
    public function scopeTanggal($query, $filters)
    {

        if (isset($filters['tanggal']) && $filters['tanggal']) {
            $query->where('tanggal', $filters['tanggal']);
        }

        return $query;
    }
}
