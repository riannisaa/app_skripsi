<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSkripsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_berkas_skripsi',
        'id_jadwal',
        'file_revisi',
        'keterangan',
        'status_revisi',
        'file_pengesahan',
        'file_skripsi',
        'acc_penguji_1',
        'acc_penguji_2',
        'acc_pembimbing_1',
        'acc_pembimbing_2',
        'acc_kaprodi',
        'bebas_pustaka'
    ];

    public function berkasSkripsi()
    {
        return $this->belongsTo(BerkasSidangSkripsi::class, 'id_berkas_skripsi');
    }

    public function jadwalSidang()
    {
        return $this->belongsTo(JadwalSidang::class, 'id_jadwal');
    }
    public function hasilSkripsiPembimbing()
    {
        return $this->hasMany(HasilSkripsiPembimbing::class, 'id_jadwal_skripsi');
    }

    public function hasilSkripsiPenguji()
    {
        return $this->hasMany(HasilSkripsiPenguji::class, 'id_jadwal_skripsi');
    }
}
