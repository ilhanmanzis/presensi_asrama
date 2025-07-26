<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class JamaahSantris extends Model
{
    use HasFactory;
    protected $table = 'jamaah_santris';
    protected $primaryKey = 'id_jamaah_santri';
    protected $guarded = [];


    public function presensiJamaahSantris()
    {
        return $this->hasMany(PresensiJamaahSantris::class, 'id_jamaah_santri', 'id_jamaah_santri');
    }
}
