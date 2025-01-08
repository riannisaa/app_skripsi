<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ruangan',
        'link'
    ];

    public function jadwalSidangs()
    {
        return $this->hasMany(JadwalSidang::class, 'id_ruangan');
    }
}
