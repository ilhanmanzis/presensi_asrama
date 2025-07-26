<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Ekstrakurikulers extends Model
{
    use HasFactory;
    protected $table = 'ekstrakurikulers';
    protected $primaryKey = 'id_ekstrakurikuler';
    protected $fillable = ['name'];

    public function dataEkstrakurikulers()
    {
        return $this->hasMany(DataEkstrakurikulers::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }
}
