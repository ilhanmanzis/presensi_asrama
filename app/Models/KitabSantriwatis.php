<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitabSantriwatis extends Model
{
    use HasFactory;

    protected $table = 'kitab_santriwatis';
    protected $primaryKey = 'id_kitab_santriwati';
    protected $guarded = [];

    public function santriwatis()
    {
        return $this->belongsToMany(Santriwatis::class, 'kelompok_kitab_santriwatis', 'id_kitab_santriwati', 'id_santriwati');
    }

    public function dataKitabSantriwatis()
    {
        return $this->hasMany(DataKitabSantriwatis::class, 'id_kitab_santriwati', 'id_kitab_santriwati');
    }
}
