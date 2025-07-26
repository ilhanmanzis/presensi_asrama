<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $guarded = [];

    public function santriwatis()
    {
        return $this->hasMany(Santriwatis::class, 'id_kelas', 'id_kelas');
    }

    public function santris()
    {
        return $this->hasMany(Santris::class, 'id_kelas', 'id_kelas');
    }
}
