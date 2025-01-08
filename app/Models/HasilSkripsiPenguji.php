<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSkripsiPenguji extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jadwal_skripsi',
        'sarana',
        'menjelaskan',
        'standarisasi',
        'keutuhan',
        'kerapihan',
        'pemahaman',
        'pendekatan',
        'menjawab',
        'pertanyaan_pokok',
        'kesimpulan',
        'id_dosen'
    ];

    public function jadwalSkripsi()
    {
        return $this->belongsTo(JadwalSkripsi::class, 'id_jadwal_skripsi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
