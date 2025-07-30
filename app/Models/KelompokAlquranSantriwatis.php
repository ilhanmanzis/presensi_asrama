<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokAlquranSantriwatis extends Model
{
    use HasFactory;

    protected $table = 'kelompok_alquran_santriwatis';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function santriwati()
    {
        return $this->belongsTo(Santriwatis::class, 'id_santriwati', 'id_santriwati');
    }
}
