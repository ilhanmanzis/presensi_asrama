<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asramas extends Model
{
    use HasFactory;
    protected $table = 'asramas';
    protected $primaryKey = 'id_asrama';
    protected $guarded = [];

    public function santriwatis()
    {
        return $this->hasMany(Santriwatis::class, 'id_asrama', 'id_asrama');
    }

    public function santris()
    {
        return $this->hasMany(Santris::class, 'id_asrama', 'id_asrama');
    }
}
