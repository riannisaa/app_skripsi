<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSkripsiPembimbing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jadwal_skripsi',
        'kedisiplinan',
        'kemauan',
        'kemandirian',
        'standarisasi',
        'keutuhan',
        'kerapihan',
        'analisis',
        'solusi',
        'kajian',
        'penguasaan',
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
