<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitabSantris extends Model
{
    use HasFactory;
    protected $table = 'kitab_santris';
    protected $primaryKey = 'id_kitab_santri';
    protected $guarded = [];

    public function santris()
    {
        return $this->belongsToMany(Santris::class, 'kelompok_kitab_santris', 'id_kitab_santri', 'id_santri');
    }

    public function dataKitabSantris()
    {
        return $this->hasMany(DataKitabSantris::class, 'id_kitab_santri', 'id_kitab_santri');
    }
}
