<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokKitabSantris extends Model
{
    use HasFactory;

    protected $table = 'kelompok_kitab_santris';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
