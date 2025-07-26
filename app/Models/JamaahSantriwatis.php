<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamaahSantriwatis extends Model
{
    use HasFactory;
    protected $table = 'jamaah_santriwatis';
    protected $primaryKey = 'id_jamaah_santriwati';
    protected $guarded = [];


    public function presensiJamaahSantriwatis()
    {
        return $this->hasMany(PresensiJamaahSantriwatis::class, 'id_jamaah_santriwati', 'id_jamaah_santriwati');
    }
}
