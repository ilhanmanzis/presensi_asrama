<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokAlquranSantris extends Model
{
    use HasFactory;
    protected $table = 'kelompok_alquran_santris';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
